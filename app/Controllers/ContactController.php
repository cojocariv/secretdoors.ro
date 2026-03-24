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

        return @mail($to, $subject, $body, implode("\r\n", $headers));
    }
}
