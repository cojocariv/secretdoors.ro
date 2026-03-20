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
            $_SESSION['flash'] = 'Mesajul a fost trimis cu succes.';
        }
        $this->redirect('/contact');
    }
}
