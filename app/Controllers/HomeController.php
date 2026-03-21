<?php
declare(strict_types=1);

class HomeController extends Controller
{
    public function index(): void
    {
        $products = (new Product())->featured(4);
        $usiUrls = asset_gallery_images('usi');
        $n = count($usiUrls);
        $i = 0;
        foreach ($products as &$p) {
            if ($n > 0) {
                $p['display_image'] = $usiUrls[$i % $n];
            }
            $i++;
        }
        unset($p);

        $projects = array_slice((new Project())->all(), 0, 6);
        $this->render('pages/home', [
            'title' => 'Acasă',
            'metaDescription' => 'Uși filomuro premium, proiecte moderne și soluții minimaliste.',
            'products' => $products,
            'projects' => $projects,
        ]);
    }
}
