<?php
declare(strict_types=1);

class ProductController extends Controller
{
    public function index(): void
    {
        $categoryFilters = [
            'profile' => 'Profile',
            'sisteme-glisante' => 'Sisteme glisante',
            'usi-filomuro' => 'Usi filomuro',
            'usi-invizibile' => 'Usi invizibile',
            'cornisa' => 'Cornisa',
        ];

        $selectedCategory = (string) ($_GET['categorie'] ?? '');
        if (!array_key_exists($selectedCategory, $categoryFilters)) {
            $selectedCategory = '';
        }

        $filters = [];
        if ($selectedCategory !== '') {
            $filters['categorie'] = $selectedCategory;
        }

        $products = (new Product())->all($filters);

        $this->render('pages/products', [
            'title' => 'Produse',
            'metaTitle' => 'Produse: uși ascunse & uși invizibile | Secret Doors Premium',
            'metaDescription' => 'Catalog uși ascunse, uși invizibile cu toc ascuns aluminiu și uși filomuro fără pervaz. Preț uși invizibile, montaj și livrare în România / București. Plintă ascunsă și cornișă iluminare indirectă.',
            'products' => $products,
            'categoryFilters' => $categoryFilters,
            'selectedCategory' => $selectedCategory,
        ]);
    }

    public function category(): void
    {
        $this->redirect('/produse');
    }
}
