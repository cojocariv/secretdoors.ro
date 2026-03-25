<?php
declare(strict_types=1);

class BlogController extends Controller
{
    public function index(): void
    {
        $this->render('pages/blog', [
            'title' => 'Noutati',
            'metaTitle' => 'Noutăți: uși filomuro, uși invizibile & proiecte premium | Secret Doors Premium',
            'metaDescription' => 'Articole și noutăți despre sistem filomuro, balamale ascunse uși, toc ascuns aluminiu, plintă ascunsă și design interior modern.',
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
        $excerpt = (string) ($article['excerpt'] ?? '');
        $this->render('pages/article', [
            'title' => $article['title'],
            'article' => $article,
            'metaTitle' => ($article['title'] ?? 'Articol') . ' | Secret Doors Premium',
            'metaDescription' => $excerpt !== '' ? $excerpt : 'Articol despre uși ascunse, uși invizibile și soluții moderne pereți.',
        ]);
    }
}
