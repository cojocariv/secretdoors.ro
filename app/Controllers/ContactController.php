<?php
declare(strict_types=1);

class ContactController extends Controller
{
    public function index(): void
    {
        $this->render('pages/contact', ['title' => 'Contact']);
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
                : 'Mesajul a fost salvat, dar emailul nu a putut fi trimis momentan.';
        }
        $this->redirect('/contact');
    }

    private function sendContactEmail(array $payload): bool
    {
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

        return @mail($to, $subject, $body, implode("\r\n", $headers));
    }

    private function sendViaSmtp(string $from, string $to, string $subject, string $body, string $replyTo): bool
    {
        if (!defined('SMTP_HOST') || trim((string) SMTP_HOST) === '') {
            return false;
        }
        if (!defined('SMTP_USERNAME') || trim((string) SMTP_USERNAME) === '') {
            return false;
        }
        if (!defined('SMTP_PASSWORD') || trim((string) SMTP_PASSWORD) === '') {
            return false;
        }

        $host = trim((string) SMTP_HOST);
        $port = defined('SMTP_PORT') ? (int) SMTP_PORT : 587;
        $username = trim((string) SMTP_USERNAME);
        $password = (string) SMTP_PASSWORD;
        $encryption = defined('SMTP_ENCRYPTION') ? strtolower(trim((string) SMTP_ENCRYPTION)) : 'tls';
        $timeout = defined('SMTP_TIMEOUT') ? (int) SMTP_TIMEOUT : 12;

        $transportHost = $encryption === 'ssl' ? 'ssl://' . $host : $host;
        $socket = @stream_socket_client(
            $transportHost . ':' . $port,
            $errno,
            $errstr,
            $timeout,
            STREAM_CLIENT_CONNECT
        );
        if (!is_resource($socket)) {
            return false;
        }

        stream_set_timeout($socket, $timeout);

        try {
            if (!$this->smtpExpect($socket, [220])) {
                return false;
            }
            if (!$this->smtpSend($socket, 'EHLO ' . ($_SERVER['HTTP_HOST'] ?? 'localhost'))) {
                return false;
            }
            if (!$this->smtpExpect($socket, [250])) {
                return false;
            }

            if ($encryption === 'tls') {
                if (!$this->smtpSend($socket, 'STARTTLS')) {
                    return false;
                }
                if (!$this->smtpExpect($socket, [220])) {
                    return false;
                }
                if (!@stream_socket_enable_crypto($socket, true, STREAM_CRYPTO_METHOD_TLS_CLIENT)) {
                    return false;
                }
                if (!$this->smtpSend($socket, 'EHLO ' . ($_SERVER['HTTP_HOST'] ?? 'localhost'))) {
                    return false;
                }
                if (!$this->smtpExpect($socket, [250])) {
                    return false;
                }
            }

            if (
                !$this->smtpSend($socket, 'AUTH LOGIN') ||
                !$this->smtpExpect($socket, [334]) ||
                !$this->smtpSend($socket, base64_encode($username)) ||
                !$this->smtpExpect($socket, [334]) ||
                !$this->smtpSend($socket, base64_encode($password)) ||
                !$this->smtpExpect($socket, [235])
            ) {
                return false;
            }

            if (
                !$this->smtpSend($socket, 'MAIL FROM:<' . $from . '>') ||
                !$this->smtpExpect($socket, [250]) ||
                !$this->smtpSend($socket, 'RCPT TO:<' . $to . '>') ||
                !$this->smtpExpect($socket, [250, 251]) ||
                !$this->smtpSend($socket, 'DATA') ||
                !$this->smtpExpect($socket, [354])
            ) {
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
                return false;
            }
            if (!$this->smtpExpect($socket, [250])) {
                return false;
            }

            $this->smtpSend($socket, 'QUIT');
            return true;
        } finally {
            fclose($socket);
        }
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

    private function smtpExpect($socket, array $expectedCodes): bool
    {
        $line = '';
        do {
            $chunk = @fgets($socket, 515);
            if ($chunk === false) {
                return false;
            }
            $line = $chunk;
        } while (isset($line[3]) && $line[3] === '-');

        $code = (int) substr($line, 0, 3);
        return in_array($code, $expectedCodes, true);
    }
}
