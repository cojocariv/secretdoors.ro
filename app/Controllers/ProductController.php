<?php
declare(strict_types=1);

class ProductController extends Controller
{
    public function index(): void
    {
        $this->render('pages/products', [
            'title' => 'Produse',
            'categories' => (new Category())->all(),
            'products' => (new Product())->all(),
        ]);
    }

    public function category(): void
    {
        $slug = $_GET['slug'] ?? '';
        $this->render('pages/products', [
            'title' => 'Categoria ' . $slug,
            'categories' => (new Category())->all(),
            'products' => (new Product())->all(['categorie' => $slug]),
        ]);
    }
}
