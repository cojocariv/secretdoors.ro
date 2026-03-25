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
            'metaTitle' => 'Uși filomuro & uși invizibile | Secret Doors Premium',
            'metaDescription' => 'Uși ascunse în perete, uși invizibile și uși filomuro la comandă. Producător uși filomuro Moldova/Chișinău și București. Preț & montaj.',
            'products' => $products,
            'projects' => $projects,
        ]);
    }
}
