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
