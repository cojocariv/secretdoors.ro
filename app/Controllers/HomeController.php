<?php
declare(strict_types=1);

class HomeController extends Controller
{
    public function index(): void
    {
        $products = (new Product())->featured(4);
        $projects = array_slice((new Project())->all(), 0, 6);
        $this->render('pages/home', [
            'title' => 'Home',
            'metaDescription' => 'Usi filomuro premium, proiecte moderne si solutii minimaliste.',
            'products' => $products,
            'projects' => $projects,
        ]);
    }
}
