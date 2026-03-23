<?php
declare(strict_types=1);

class ProductController extends Controller
{
    public function index(): void
    {
        $products = (new Product())->all();
        $usi = asset_gallery_images('usi');
        $profile = asset_gallery_images('profile');
        $cornise = asset_gallery_images('cornise');

        $toate = array_merge($usi, $profile, $cornise);

        $this->render('pages/products', [
            'title' => 'Produse',
            'metaDescription' => 'Uși ascunse, profile și cornișe — galerii foto și catalog.',
            'gallery_toate' => $toate,
            'gallery_usi' => $usi,
            'gallery_profile' => $profile,
            'gallery_cornise' => $cornise,
            'profile_catalog_pdf' => asset_profile_catalog_pdf_url(),
            'products' => $products,
        ]);
    }

    public function category(): void
    {
        $this->redirect('/produse');
    }
}
