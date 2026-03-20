<?php
declare(strict_types=1);

class ShopController extends Controller
{
    public function index(): void
    {
        $filters = [
            'categorie' => $_GET['categorie'] ?? null,
            'finish' => $_GET['finish'] ?? null,
            'max_price' => $_GET['max_price'] ?? null,
        ];
        $this->render('pages/shop', [
            'title' => 'Shop',
            'products' => (new Product())->all($filters),
            'categories' => (new Category())->all(),
            'filters' => $filters,
        ]);
    }

    public function show(): void
    {
        $id = (int) ($_GET['id'] ?? 0);
        $product = (new Product())->find($id);
        if (!$product) {
            $this->redirect('/shop');
        }
        $this->render('pages/product-detail', ['title' => $product['name'], 'product' => $product]);
    }

    public function addToCart(): void
    {
        $id = (int) ($_POST['product_id'] ?? 0);
        if ($id > 0) {
            $_SESSION['cart'][$id] = ($_SESSION['cart'][$id] ?? 0) + 1;
        }
        $this->redirect('/shop');
    }

    public function removeFromCart(): void
    {
        $id = (int) ($_POST['product_id'] ?? 0);
        unset($_SESSION['cart'][$id]);
        $this->redirect('/shop');
    }
}
