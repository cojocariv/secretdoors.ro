<?php
declare(strict_types=1);

abstract class Controller
{
    protected function render(string $view, array $data = [], string $layout = 'main'): void
    {
        extract($data, EXTR_SKIP);
        $viewPath = __DIR__ . '/../app/Views/' . $view . '.php';
        $layoutPath = __DIR__ . '/../app/Views/layouts/' . $layout . '.php';
        require $layoutPath;
    }

    protected function redirect(string $path): void
    {
        header('Location: ' . url($path));
        exit;
    }
}
