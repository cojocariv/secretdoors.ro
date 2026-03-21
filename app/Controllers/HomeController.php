<?php
declare(strict_types=1);

class HomeController extends Controller
{
    public function index(): void
    {
        $products = (new Product())->featured(4);
        // Imagini locale din assets/usi (dacă există fișiere), mapate pe carduri în ordine
        $usiDir = dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'usi';
        $usiFiles = [];
        if (is_dir($usiDir)) {
            foreach (['jpg', 'jpeg', 'png', 'webp', 'gif'] as $ext) {
                foreach (glob($usiDir . DIRECTORY_SEPARATOR . '*.' . $ext) ?: [] as $path) {
                    $usiFiles[] = basename($path);
                }
            }
            $usiFiles = array_values(array_unique($usiFiles));
            sort($usiFiles, SORT_NATURAL | SORT_FLAG_CASE);
        }
        $n = count($usiFiles);
        $i = 0;
        foreach ($products as &$p) {
            if ($n > 0) {
                $p['display_image'] = url('/assets/usi/' . $usiFiles[$i % $n]);
            }
            $i++;
        }
        unset($p);

        $projects = array_slice((new Project())->all(), 0, 6);
        $this->render('pages/home', [
            'title' => 'Home',
            'metaDescription' => 'Usi filomuro premium, proiecte moderne si solutii minimaliste.',
            'products' => $products,
            'projects' => $projects,
        ]);
    }
}
