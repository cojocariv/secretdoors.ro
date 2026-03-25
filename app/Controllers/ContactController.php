<?php
declare(strict_types=1);

class ContactController extends Controller
{
    private string $mailLastError = '';

    public function index(): void
    {
        $this->render('pages/contact', [
            'title' => 'Contact',
            'metaTitle' => 'Contact: uși ascunse & uși invizibile | Secret Doors Premium',
            'metaDescription' => 'Contact pentru uși ascunse în perete, uși invizibile personalizate și uși filomuro fără pervaz. Ofertă, preț și montaj în București / România.',
        ]);
    }

    public function store(): void
    {
        $payload = [
            'name' => trim($_POST['name'] ?? ''),
            'email' => trim($_POST['email'] ?? ''),
            'phone' => trim($_POST['phone'] ?? ''),
            'message' => trim($_POST['message'] ?? ''),
        ];
        if ($payload['name'] && $payload['email'] && $payload['message']) {
            (new ContactMessage())->create($payload);
            $mailSent = $this->sendContactEmail($payload);
            $_SESSION['flash'] = $mailSent
                ? 'Mesajul a fost trimis cu succes.'
                : 'Mesajul a fost salvat, dar emailul nu a putut fi trimis momentan. ' . $this->mailLastError;
        }
        $this->redirect('/contact');
    }

    private function sendContactEmail(array $payload): bool
    {
        $this->mailLastError = '';
        $to = defined('CONTACT_FORM_TO_EMAIL') && CONTACT_FORM_TO_EMAIL !== ''
            ? CONTACT_FORM_TO_EMAIL
            : site_contact('email');
        $from = defined('CONTACT_FORM_FROM_EMAIL') && CONTACT_FORM_FROM_EMAIL !== ''
            ? CONTACT_FORM_FROM_EMAIL
            : $to;
        if ($to === '') {
            return false;
        }

        $subject = 'Mesaj nou din formularul de contact - ' . SITE_NAME;
        $bodyLines = [
            'Ai primit un mesaj nou din formularul de contact.',
            '',
            'Nume: ' . $payload['name'],
            'Email: ' . $payload['email'],
            'Telefon: ' . ($payload['phone'] !== '' ? $payload['phone'] : '-'),
            '',
            'Mesaj:',
            $payload['message'],
            '',
            '---',
            'Trimis de pe: ' . SITE_NAME,
        ];
        $body = implode(PHP_EOL, $bodyLines);

        $safeReplyTo = filter_var($payload['email'], FILTER_VALIDATE_EMAIL) ? $payload['email'] : '';
        $headers = [
            'MIME-Version: 1.0',
            'Content-Type: text/plain; charset=UTF-8',
            'From: ' . SITE_NAME . ' <' . $from . '>',
        ];
        if ($safeReplyTo !== '') {
            $headers[] = 'Reply-To: ' . $safeReplyTo;
        }
        $headers[] = 'X-Mailer: PHP/' . PHP_VERSION;

        if ($this->sendViaSmtp($from, $to, $subject, $body, $safeReplyTo)) {
            return true;
        }

        $mailOk = @mail($to, $subject, $body, implode("\r\n", $headers));
        if (!$mailOk && $this->mailLastError === '') {
            $this->mailLastError = '(fallback mail() a eșuat)';
        }
        return $mailOk;
    }

    private function sendViaSmtp(string $from, string $to, string $subject, string $body, string $replyTo): bool
    {
        $host = $this->smtpConfigString('SMTP_HOST');
        $username = $this->smtpConfigString('SMTP_USERNAME');
        $password = $this->smtpConfigString('SMTP_PASSWORD');

        if ($host === '') {
            $this->mailLastError = '(SMTP_HOST lipsă — completează config/config.php sau variabila de mediu SMTP_HOST)';
            return false;
        }
        if ($username === '') {
            $this->mailLastError = '(SMTP_USERNAME lipsă)';
            return false;
        }
        if ($password === '') {
            $this->mailLastError = '(SMTP_PASSWORD lipsă)';
            return false;
        }

        $port = defined('SMTP_PORT') ? (int) SMTP_PORT : 587;
        $portEnv = getenv('SMTP_PORT');
        if ($portEnv !== false && trim((string) $portEnv) !== '') {
            $port = (int) trim((string) $portEnv);
        }

        $encryption = defined('SMTP_ENCRYPTION') ? strtolower(trim((string) SMTP_ENCRYPTION)) : 'tls';
        $encEnv = getenv('SMTP_ENCRYPTION');
        if ($encEnv !== false && trim((string) $encEnv) !== '') {
            $encryption = strtolower(trim((string) $encEnv));
        }

        $timeout = defined('SMTP_TIMEOUT') ? (int) SMTP_TIMEOUT : 12;

        $strategies = [
            ['encryption' => $encryption, 'port' => $port],
        ];
        if ($encryption === 'tls') {
            $strategies[] = ['encryption' => 'ssl', 'port' => 465];
        }
        if ($encryption === 'ssl' && $port !== 587) {
            $strategies[] = ['encryption' => 'tls', 'port' => 587];
        }

        $hostCandidates = $this->smtpHostCandidates($host);
        $lastError = '(SMTP: toate încercările au eșuat — verifică în cPanel «Email Routing / Manual Settings» host și port)';
        foreach ($hostCandidates as $tryHost) {
            foreach ($strategies as $strategy) {
                $err = '';
                if (
                    $this->smtpRunSession(
                        $from,
                        $to,
                        $subject,
                        $body,
                        $replyTo,
                        $tryHost,
                        $username,
                        $password,
                        $timeout,
                        $strategy['encryption'],
                        (int) $strategy['port'],
                        $err
                    )
                ) {
                    return true;
                }
                $lastError = $err;
            }
        }

        $this->mailLastError = $lastError;
        return false;
    }

    /**
     * Încearcă mai multe hostname-uri uzuale dacă SMTP_HOST e incomplet (ex. doar domeniul).
     *
     * @return list<string>
     */
    private function smtpHostCandidates(string $primary): array
    {
        $out = [];
        $p = trim($primary);
        if ($p !== '') {
            $out[] = $p;
        }

        $domain = '';
        if (defined('CONTACT_FORM_FROM_EMAIL') && str_contains((string) CONTACT_FORM_FROM_EMAIL, '@')) {
            $parts = explode('@', (string) CONTACT_FORM_FROM_EMAIL, 2);
            $domain = trim($parts[1] ?? '');
        }

        if ($domain !== '') {
            $mailH = 'mail.' . $domain;
            if (!in_array($mailH, $out, true)) {
                $out[] = $mailH;
            }
            if ($domain !== $p && !in_array($domain, $out, true)) {
                $out[] = $domain;
            }
        }

        return array_values(array_unique($out));
    }

    /**
     * @return array{0: resource|null, 1: string} socket sau null + detaliu eroare
     */
    private function smtpOpenStreamSocket(string $host, string $encryption, int $port, int $timeout): array
    {
        $encryption = strtolower($encryption);
        $prefix = $encryption === 'ssl' ? 'ssl://' : '';
        $target = $prefix . $host . ':' . $port;

        $context = stream_context_create([
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true,
            ],
        ]);

        $errno = 0;
        $errstr = '';
        $socket = @stream_socket_client(
            $target,
            $errno,
            $errstr,
            $timeout,
            STREAM_CLIENT_CONNECT,
            $context
        );

        if (is_resource($socket)) {
            return [$socket, ''];
        }

        $detail = trim((string) $errstr);
        if ($detail === '' && $errno === 0) {
            $last = error_get_last();
            if (is_array($last) && isset($last['message']) && is_string($last['message'])) {
                $detail = trim($last['message']);
            }
        }

        if ($detail === '') {
            $detail = 'fără mesaj — posibil port ' . $port . ' blocat la ieșire de host, DNS greșit sau extensia OpenSSL';
        }

        $line = $detail . ' (errno ' . $errno . ') la ' . $host;

        // Dacă ssl:// nu dă detaliu, încearcă tcp:// + detectare rapidă.
        if ($encryption === 'ssl' && $errno === 0 && trim((string) $errstr) === '') {
            $probe = @stream_socket_client(
                'tcp://' . $host . ':' . $port,
                $e2,
                $s2,
                min($timeout, 5),
                STREAM_CLIENT_CONNECT
            );
            if (!is_resource($probe)) {
                $line .= ' | probă TCP: ' . (trim((string) $s2) !== '' ? $s2 : 'fără mesaj') . ' (errno ' . $e2 . ')';
            } else {
                fclose($probe);
                $line .= ' | probă TCP: conexiunea TCP reușește — verifică SSL/OpenSSL pentru ssl://';
            }
        }

        return [null, $line];
    }

    /**
     * O sesiune SMTP completă (o conexiune + trimitere mesaj).
     */
    private function smtpRunSession(
        string $from,
        string $to,
        string $subject,
        string $body,
        string $replyTo,
        string $host,
        string $username,
        string $password,
        int $timeout,
        string $encryption,
        int $port,
        string &$errorOut
    ): bool {
        $encryption = strtolower($encryption);
        $ehloId = $this->smtpEhloHost();

        [$socket, $connErr] = $this->smtpOpenStreamSocket($host, $encryption, $port, $timeout);
        if (!is_resource($socket)) {
            $errorOut = '(conexiune SMTP eșuată [' . $host . ' ' . $encryption . ':' . $port . '] ' . $connErr . ')';
            return false;
        }

        stream_set_timeout($socket, $timeout);
        $this->mailLastError = '';

        try {
            if (!$this->smtpOpenAndTls($socket, $encryption, $ehloId, $errorOut)) {
                return false;
            }

            if (!$this->smtpAuthenticate($socket, $username, $password)) {
                $errorOut = $this->mailLastError !== '' ? $this->mailLastError : '(autentificare SMTP eșuată)';
                return false;
            }

            if (
                !$this->smtpSend($socket, 'MAIL FROM:<' . $from . '>') ||
                !$this->smtpExpect($socket, [250], $response) ||
                !$this->smtpSend($socket, 'RCPT TO:<' . $to . '>') ||
                !$this->smtpExpect($socket, [250, 251], $response) ||
                !$this->smtpSend($socket, 'DATA') ||
                !$this->smtpExpect($socket, [354], $response)
            ) {
                $errorOut = '(SMTP envelope eșuat: ' . $response . ')';
                return false;
            }

            $headers = [
                'Date: ' . date(DATE_RFC2822),
                'From: ' . SITE_NAME . ' <' . $from . '>',
                'To: <' . $to . '>',
                'Subject: ' . $subject,
                'MIME-Version: 1.0',
                'Content-Type: text/plain; charset=UTF-8',
                'Content-Transfer-Encoding: 8bit',
            ];
            if ($replyTo !== '') {
                $headers[] = 'Reply-To: ' . $replyTo;
            }

            $messageData = implode("\r\n", $headers) . "\r\n\r\n" . $body;
            $messageData = str_replace(["\r\n.", "\n."], ["\r\n..", "\n.."], $messageData);
            if (!$this->smtpSendRaw($socket, $messageData . "\r\n.\r\n")) {
                $errorOut = '(SMTP DATA write failed)';
                return false;
            }
            if (!$this->smtpExpect($socket, [250], $response)) {
                $errorOut = '(SMTP DATA respins: ' . $response . ')';
                return false;
            }

            $this->smtpSend($socket, 'QUIT');
            return true;
        } finally {
            fclose($socket);
        }
    }

    private function smtpOpenAndTls($socket, string $encryption, string $ehloId, string &$errorOut): bool
    {
        if (!$this->smtpExpect($socket, [220], $response)) {
            $errorOut = '(SMTP banner invalid: ' . $response . ')';
            return false;
        }
        if (!$this->smtpSend($socket, 'EHLO ' . $ehloId)) {
            $errorOut = '(EHLO write failed)';
            return false;
        }
        if (!$this->smtpExpect($socket, [250], $response)) {
            $errorOut = '(EHLO respins: ' . $response . ')';
            return false;
        }

        if ($encryption === 'tls') {
            if (!$this->smtpSend($socket, 'STARTTLS')) {
                $errorOut = '(STARTTLS write failed)';
                return false;
            }
            if (!$this->smtpExpect($socket, [220], $response)) {
                $errorOut = '(STARTTLS respins: ' . $response . ')';
                return false;
            }
            if (!@stream_socket_enable_crypto($socket, true, $this->smtpTlsClientCryptoMethods())) {
                $errorOut = '(TLS handshake eșuat pe STARTTLS — urmează automat ssl:465)';
                return false;
            }
            if (!$this->smtpSend($socket, 'EHLO ' . $ehloId)) {
                $errorOut = '(EHLO post-TLS write failed)';
                return false;
            }
            if (!$this->smtpExpect($socket, [250], $response)) {
                $errorOut = '(EHLO post-TLS respins: ' . $response . ')';
                return false;
            }
        }

        return true;
    }

    private function smtpEhloHost(): string
    {
        $http = $_SERVER['HTTP_HOST'] ?? '';
        $http = preg_replace('/:\d+$/', '', (string) $http) ?? '';
        if ($http !== '' && !preg_match('/^\d{1,3}(\.\d{1,3}){3}$/', $http)) {
            return $http;
        }
        if (defined('CONTACT_FORM_FROM_EMAIL') && CONTACT_FORM_FROM_EMAIL !== '' && str_contains((string) CONTACT_FORM_FROM_EMAIL, '@')) {
            $parts = explode('@', (string) CONTACT_FORM_FROM_EMAIL, 2);
            return $parts[1] ?? 'localhost';
        }
        return 'localhost';
    }

    private function smtpTlsClientCryptoMethods(): int
    {
        $m = STREAM_CRYPTO_METHOD_TLS_CLIENT;
        if (defined('STREAM_CRYPTO_METHOD_TLSv1_2_CLIENT')) {
            $m |= (int) STREAM_CRYPTO_METHOD_TLSv1_2_CLIENT;
        }
        if (defined('STREAM_CRYPTO_METHOD_TLSv1_3_CLIENT')) {
            $m |= (int) STREAM_CRYPTO_METHOD_TLSv1_3_CLIENT;
        }
        return $m;
    }

    private function smtpSend($socket, string $line): bool
    {
        return $this->smtpSendRaw($socket, $line . "\r\n");
    }

    private function smtpSendRaw($socket, string $data): bool
    {
        $written = @fwrite($socket, $data);
        return $written !== false;
    }

    /**
     * Citește setarea SMTP din constantă (config) sau din mediu (ex. cPanel «Environment Variables»).
     */
    private function smtpConfigString(string $name): string
    {
        if (defined($name)) {
            $c = constant($name);
            $s = is_string($c) ? trim($c) : (string) $c;
            if ($s !== '') {
                return $s;
            }
        }

        $v = getenv($name);
        if ($v !== false && trim((string) $v) !== '') {
            return trim((string) $v);
        }

        return '';
    }

    private function smtpAuthenticate($socket, string $username, string $password): bool
    {
        // Try AUTH LOGIN first (most common shared-hosting option).
        if (
            $this->smtpSend($socket, 'AUTH LOGIN') &&
            $this->smtpExpect($socket, [334], $response) &&
            $this->smtpSend($socket, base64_encode($username)) &&
            $this->smtpExpect($socket, [334], $response) &&
            $this->smtpSend($socket, base64_encode($password)) &&
            $this->smtpExpect($socket, [235], $response)
        ) {
            return true;
        }

        // Fallback: AUTH PLAIN for servers that do not support LOGIN.
        $plain = base64_encode("\0" . $username . "\0" . $password);
        if (
            $this->smtpSend($socket, 'AUTH PLAIN ' . $plain) &&
            $this->smtpExpect($socket, [235], $response)
        ) {
            return true;
        }

        $this->mailLastError = '(AUTH LOGIN/PLAIN respins)';
        return false;
    }

    private function smtpExpect($socket, array $expectedCodes, ?string &$responseLine = null): bool
    {
        $line = '';
        do {
            $chunk = @fgets($socket, 515);
            if ($chunk === false) {
                $responseLine = 'no response';
                return false;
            }
            $line = $chunk;
        } while (isset($line[3]) && $line[3] === '-');

        $responseLine = trim($line);
        $code = (int) substr($line, 0, 3);
        return in_array($code, $expectedCodes, true);
    }
}
