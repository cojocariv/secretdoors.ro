<?php
declare(strict_types=1);

class BlogController extends Controller
{
    /**
     * Înlocuiește textul și imaginile cu “galeria noastră” (poze Azure) pentru paginile Noutăți.
     */
    private function decorateArticle(array $article): array
    {
        $galleryImages = [
            'https://cojocaristorage.blob.core.windows.net/secretdoors/usi/IMG_7929.JPG?sp=racwdl&st=2026-03-23T17:46:49Z&se=2026-04-10T01:01:49Z&sv=2024-11-04&sr=c&sig=p%2FEGIMcr6%2BTlfBYLMP6cuEpsCQTEJjUf8FwVc%2BT0n58%3D',
            'https://cojocaristorage.blob.core.windows.net/secretdoors/usi/IMG_8019.JPG?sp=racwdl&st=2026-03-23T17:46:49Z&se=2026-04-10T01:01:49Z&sv=2024-11-04&sr=c&sig=p%2FEGIMcr6%2BTlfBYLMP6cuEpsCQTEJjUf8FwVc%2BT0n58%3D',
            'https://cojocaristorage.blob.core.windows.net/secretdoors/usi/IMG_8072.JPG?sp=racwdl&st=2026-03-23T17:46:49Z&se=2026-04-10T01:01:49Z&sv=2024-11-04&sr=c&sig=p%2FEGIMcr6%2BTlfBYLMP6cuEpsCQTEJjUf8FwVc%2BT0n58%3D',
            'https://cojocaristorage.blob.core.windows.net/secretdoors/usi/IMG_8073.JPG?sp=racwdl&st=2026-03-23T17:46:49Z&se=2026-04-10T01:01:49Z&sv=2024-11-04&sr=c&sig=p%2FEGIMcr6%2BTlfBYLMP6cuEpsCQTEJjUf8FwVc%2BT0n58%3D',
            'https://cojocaristorage.blob.core.windows.net/secretdoors/usi/IMG_8074.JPG?sp=racwdl&st=2026-03-23T17:46:49Z&se=2026-04-10T01:01:49Z&sv=2024-11-04&sr=c&sig=p%2FEGIMcr6%2BTlfBYLMP6cuEpsCQTEJjUf8FwVc%2BT0n58%3D',
        ];

        $slug = (string) ($article['slug'] ?? '');

        $bySlug = [
            'trenduri-2026-usi-filomuro' => [
                'excerpt' => 'Trenduri 2026 în uși filomuro și uși invizibile: linii continue, finisaje premium și soluții constructive cu toc ascuns aluminiu. Ideal pentru design interior modern din București / România.',
                'body' => "În 2026, ușile integrate în perete devin punctul de “wow” pentru orice arhitectură modernă.\n\nLa Secret Doors, focusul este pe:\n- uși ascunse în perete (filomuro) fără întreruperi vizuale\n- uși invizibile cu balamale ascunse și toc ascuns aluminiu\n- finisaje premium și montaj uși filomuro cu atenție la detaliu\n\nDacă pregătești un proiect în București, putem recomanda combinația potrivită de sistem filomuro, profile și plintă ascunsă pentru un interior luxury modern.",
                'cover_image' => $galleryImages[0],
            ],
            'cum-alegi-sistemul-glisant-potrivit' => [
                'excerpt' => 'Cum alegi corect sistemul glisant: uși invizibile la comandă, pentru pereți cu soluții moderne și instalare plintă ascunsă. Ghid rapid pentru București / România.',
                'body' => "Alegerea sistemului glisant nu înseamnă doar estetica.\n\nPentru uși invizibile și uși ascunse, contează:\n- grosimea peretelui și spațiul necesar (toc ascuns aluminiu)\n- frecvența de utilizare și nivelul de izolare acustică\n- soluțiile constructive pentru profile LED perete și cornișă iluminare indirectă\n\nPe scurt: potrivim sistemul cu designul tău modern și cu planul de montaj, ca să obții un interior fără întreruperi vizuale.",
                'cover_image' => $galleryImages[1],
            ],
        ];

        if ($slug !== '' && isset($bySlug[$slug])) {
            $article['excerpt'] = $bySlug[$slug]['excerpt'];
            $article['body'] = $bySlug[$slug]['body'];
            $article['cover_image'] = $bySlug[$slug]['cover_image'];
        }

        return $article;
    }

    public function index(): void
    {
        $articles = (new Article())->all();
        $articles = array_map(fn ($a) => $this->decorateArticle($a), $articles);

        $this->render('pages/blog', [
            'title' => 'Noutati',
            'metaTitle' => 'Noutăți: uși filomuro, uși invizibile & proiecte premium | Secret Doors Premium',
            'metaDescription' => 'Articole și noutăți despre sistem filomuro, balamale ascunse uși, toc ascuns aluminiu, plintă ascunsă și design interior modern din București.',
            'articles' => $articles,
        ]);
    }

    public function show(): void
    {
        $slug = $_GET['slug'] ?? '';
        $article = (new Article())->findBySlug($slug);
        if (!$article) {
            $this->redirect('/noutati');
        }
        $article = $this->decorateArticle($article);
        $excerpt = (string) ($article['excerpt'] ?? '');
        $this->render('pages/article', [
            'title' => $article['title'],
            'article' => $article,
            'metaTitle' => ($article['title'] ?? 'Articol') . ' | Secret Doors Premium',
            'metaDescription' => $excerpt !== '' ? $excerpt : 'Articol despre uși ascunse, uși invizibile și soluții moderne pereți.',
        ]);
    }
}
