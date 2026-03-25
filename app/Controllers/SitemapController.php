<?php
declare(strict_types=1);

class SitemapController extends Controller
{
    public function index(): void
    {
        header('Content-Type: application/xml; charset=UTF-8');
        $base = rtrim(SITE_DOMAIN, '/');

        $urls = [];
        $add = static function (string $path, ?string $lastmod = null) use (&$urls, $base): void {
            $loc = $base . $path;
            $urls[] = ['loc' => $loc, 'lastmod' => $lastmod];
        };

        // Pagini principale
        $add('/', null);
        $add('/produse', null);
        $add('/proiecte', null);
        $add('/despre-noi', null);
        $add('/noutati', null);
        $add('/contact', null);

        // Liste filtrate (query params)
        $productCategories = [
            'profile',
            'sisteme-glisante',
            'usi-filomuro',
            'usi-invizibile',
            'cornisa',
        ];
        foreach ($productCategories as $cat) {
            $add('/produse?categorie=' . rawurlencode($cat), null);
        }

        $projectTypes = ['rezidential', 'comercial'];
        foreach ($projectTypes as $type) {
            $add('/proiecte?type=' . rawurlencode($type), null);
        }

        // Proiecte — detaliu pe query id
        $projects = (new Project())->all();
        foreach ($projects as $p) {
            $id = (int) ($p['id'] ?? 0);
            if ($id <= 0) continue;
            $lastmod = isset($p['created_at']) ? (string) $p['created_at'] : null;
            $add('/proiecte/detaliu?id=' . $id, $lastmod);
        }

        // Articole — detaliu pe query slug
        $articles = (new Article())->all();
        foreach ($articles as $a) {
            $slug = (string) ($a['slug'] ?? '');
            if ($slug === '') continue;
            $lastmod = isset($a['created_at']) ? (string) $a['created_at'] : null;
            $add('/noutati/articol?slug=' . rawurlencode($slug), $lastmod);
        }

        // Deduplicare
        $seen = [];
        $final = [];
        foreach ($urls as $u) {
            if (isset($seen[$u['loc']])) continue;
            $seen[$u['loc']] = true;
            $final[] = $u;
        }

        $now = date('c');
        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
        foreach ($final as $u) {
            $xml .= "  <url>\n";
            $xml .= '    <loc>' . htmlspecialchars($u['loc'], ENT_XML1 | ENT_QUOTES, 'UTF-8') . "</loc>\n";
            $lastmod = $u['lastmod'] ?: $now;
            $xml .= '    <lastmod>' . htmlspecialchars((string) $lastmod, ENT_XML1 | ENT_QUOTES, 'UTF-8') . "</lastmod>\n";
            $xml .= "  </url>\n";
        }
        $xml .= '</urlset>';

        echo $xml;
    }
}

