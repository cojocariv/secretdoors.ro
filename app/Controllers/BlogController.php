<?php
declare(strict_types=1);

class BlogController extends Controller
{
    public function index(): void
    {
        $this->render('pages/blog', [
            'title' => 'Noutati',
            'articles' => (new Article())->all(),
        ]);
    }

    public function show(): void
    {
        $slug = $_GET['slug'] ?? '';
        $article = (new Article())->findBySlug($slug);
        if (!$article) {
            $this->redirect('/noutati');
        }
        $this->render('pages/article', ['title' => $article['title'], 'article' => $article]);
    }
}
