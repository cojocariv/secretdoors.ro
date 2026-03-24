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
            'From: ' . SITE_NAME . ' <no-reply@' . ($_SERVER['HTTP_HOST'] ?? 'localhost') . '>',
        ];
        if ($safeReplyTo !== '') {
            $headers[] = 'Reply-To: ' . $safeReplyTo;
        }
        $headers[] = 'X-Mailer: PHP/' . PHP_VERSION;

        if ($this->sendViaGcpEndpoint($payload, $to)) {
            return true;
        }

        return @mail($to, $subject, $body, implode("\r\n", $headers));
    }

    private function sendViaGcpEndpoint(array $payload, string $to): bool
    {
        if (!defined('GCP_CONTACT_ENDPOINT') || trim((string) GCP_CONTACT_ENDPOINT) === '') {
            return false;
        }
        if (!defined('GCP_API_KEY') || trim((string) GCP_API_KEY) === '') {
            return false;
        }

        $endpoint = trim((string) GCP_CONTACT_ENDPOINT);
        $apiKey = trim((string) GCP_API_KEY);
        $separator = str_contains($endpoint, '?') ? '&' : '?';
        $url = $endpoint . $separator . 'key=' . rawurlencode($apiKey);

        $requestBody = [
            'to' => $to,
            'subject' => 'Mesaj nou din formularul de contact - ' . SITE_NAME,
            'name' => (string) $payload['name'],
            'email' => (string) $payload['email'],
            'phone' => (string) $payload['phone'],
            'message' => (string) $payload['message'],
            'site' => SITE_NAME,
        ];

        $context = stream_context_create([
            'http' => [
                'method' => 'POST',
                'header' => "Content-Type: application/json\r\nAccept: application/json\r\n",
                'content' => json_encode($requestBody, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
                'ignore_errors' => true,
                'timeout' => 8,
            ],
        ]);

        $result = @file_get_contents($url, false, $context);
        if ($result === false) {
            return false;
        }

        $statusLine = $http_response_header[0] ?? '';
        return preg_match('#\s2\d\d\s#', $statusLine) === 1;
    }
}
