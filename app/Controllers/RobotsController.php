<?php
declare(strict_types=1);

class RobotsController extends Controller
{
    public function index(): void
    {
        header('Content-Type: text/plain; charset=UTF-8');

        $sitemap = defined('SITE_DOMAIN') ? rtrim(SITE_DOMAIN, '/') . '/sitemap.xml' : '';

        $out = [];
        $out[] = 'User-agent: *';
        $out[] = 'Allow: /';
        $out[] = '';
        $out[] = '# Nu indexam zona admin';
        $out[] = 'Disallow: /admin/';
        $out[] = '';
        if ($sitemap !== '') {
            $out[] = 'Sitemap: ' . $sitemap;
        }

        echo implode("\n", $out) . "\n";
    }
}

