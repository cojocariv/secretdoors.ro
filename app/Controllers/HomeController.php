<?php
declare(strict_types=1);

class HomeController extends Controller
{
    public function index(): void
    {
        $productModel = new Product();
        $products = $productModel->featuredForHome(4);
        if ($products === []) {
            $products = $productModel->featured(4);
        }

        $projects = array_slice((new Project())->all(), 0, 6);
        $this->render('pages/home', [
            'title' => 'Acasă',
            'metaDescription' => 'Uși filomuro premium, proiecte moderne și soluții minimaliste.',
            'products' => $products,
            'projects' => $projects,
        ]);
    }
}
