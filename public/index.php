<?php
declare(strict_types=1);

session_start();

$rootPath = dirname(__DIR__);

require_once $rootPath . '/config/config.php';
require_once $rootPath . '/core/Database.php';
require_once $rootPath . '/core/Model.php';
require_once $rootPath . '/core/Controller.php';
require_once $rootPath . '/core/Router.php';
require_once $rootPath . '/core/helpers.php';

// SEO: robots.txt must be available even if routes/static files are not deployed correctly.
// (Google fetch for robots.txt expects HTTP 200, not a routed 404.)
$requestPathForRobots = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?? '/';
if ($_SERVER['REQUEST_METHOD'] === 'GET' && $requestPathForRobots === '/robots.txt') {
    header('Content-Type: text/plain; charset=UTF-8');
    $sitemapUrl = defined('SITE_DOMAIN') ? rtrim(SITE_DOMAIN, '/') . '/sitemap.xml' : '';
    echo "User-agent: *\n";
    echo "Allow: /\n\n";
    echo "# Nu indexăm zona admin\n";
    echo "Disallow: /admin/\n";
    echo "\n";
    if ($sitemapUrl !== '') {
        echo "Sitemap: {$sitemapUrl}\n";
    }
    exit;
}

// SEO: sitemap.xml fallback direct (evită dependența de controller/routare în timpul deploy-ului).
if ($_SERVER['REQUEST_METHOD'] === 'GET' && $requestPathForRobots === '/sitemap.xml') {
    header('Content-Type: application/xml; charset=UTF-8');
    $base = defined('SITE_DOMAIN') ? rtrim(SITE_DOMAIN, '/') : '';
    if ($base === '') {
        echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
        echo "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\"></urlset>";
        exit;
    }
    // Variantă minimă; versiunea completă e în SitemapController.
    $now = date('c');
    $xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
    $xml .= "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";
    foreach (['/', '/produse', '/proiecte', '/despre-noi', '/noutati', '/contact'] as $path) {
        $xml .= "  <url>\n";
        $xml .= '    <loc>' . htmlspecialchars($base . $path, ENT_XML1 | ENT_QUOTES, 'UTF-8') . "</loc>\n";
        $xml .= "    <lastmod>{$now}</lastmod>\n";
        $xml .= "  </url>\n";
    }
    $xml .= "</urlset>";
    echo $xml;
    exit;
}

spl_autoload_register(static function (string $class) use ($rootPath): void {
    $paths = [
        $rootPath . '/app/Controllers/' . $class . '.php',
        $rootPath . '/app/Models/' . $class . '.php',
    ];

    foreach ($paths as $path) {
        if (file_exists($path)) {
            require_once $path;
            return;
        }
    }
});

$router = new Router();

$router->get('/', [HomeController::class, 'index']);
$router->get('/produse', [ProductController::class, 'index']);
$router->get('/produse/categorie', [ProductController::class, 'category']);
$router->get('/proiecte', [ProjectController::class, 'index']);
$router->get('/proiecte/detaliu', [ProjectController::class, 'show']);
$router->get('/despre-noi', [PageController::class, 'about']);
$router->get('/noutati', [BlogController::class, 'index']);
$router->get('/noutati/articol', [BlogController::class, 'show']);
$router->get('/contact', [ContactController::class, 'index']);
$router->post('/contact', [ContactController::class, 'store']);
$router->get('/robots.txt', [RobotsController::class, 'index']);
$router->get('/sitemap.xml', [SitemapController::class, 'index']);

$router->get('/admin/login', [AdminController::class, 'loginForm']);
$router->post('/admin/login', [AdminController::class, 'login']);
$router->post('/admin/logout', [AdminController::class, 'logout']);
$router->get('/admin', [AdminController::class, 'dashboard']);
$router->get('/admin/produse', [AdminController::class, 'products']);
$router->post('/admin/produse/save', [AdminController::class, 'saveProduct']);
$router->post('/admin/produse/delete', [AdminController::class, 'deleteProduct']);
$router->get('/admin/proiecte', [AdminController::class, 'projects']);
$router->post('/admin/proiecte/save', [AdminController::class, 'saveProject']);
$router->post('/admin/proiecte/delete', [AdminController::class, 'deleteProject']);
$router->get('/admin/articole', [AdminController::class, 'articles']);
$router->post('/admin/articole/save', [AdminController::class, 'saveArticle']);
$router->post('/admin/articole/delete', [AdminController::class, 'deleteArticle']);

$requestPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? '/';
$basePath = rtrim(BASE_URL, '/');
if ($basePath !== '' && str_starts_with($requestPath, $basePath)) {
    $requestPath = substr($requestPath, strlen($basePath)) ?: '/';
}
$router->dispatch($_SERVER['REQUEST_METHOD'], $requestPath);
