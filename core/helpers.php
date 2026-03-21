<?php
declare(strict_types=1);

function url(string $path = ''): string
{
    return rtrim(BASE_URL, '/') . $path;
}

function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

function site_contact(string $key): string
{
    return $GLOBALS['site_contact'][$key] ?? '';
}

function is_admin(): bool
{
    return !empty($_SESSION['admin_logged']);
}

/**
 * Foldere posibile pentru assets/logo (rădăcină proiect și /public pentru deploy).
 */
function assets_logo_directories(): array
{
    $root = dirname(__DIR__);
    return [
        $root . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'logo',
        $root . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'logo',
    ];
}

/**
 * URL public pentru logo header (primul fișier găsit pe disc: svg, png, webp).
 * Dacă nu e găsit pe disc (ex. structură atipică), folosește URL-ul standard spre logo.svg
 * (browserul încarcă din DocumentRoot: /assets/logo/...).
 */
function logo_asset_url(): string
{
    $files = ['logo.svg', 'logo.png', 'logo.webp', 'logo@2x.png'];
    foreach (assets_logo_directories() as $dir) {
        foreach ($files as $file) {
            $path = $dir . DIRECTORY_SEPARATOR . $file;
            if (is_file($path)) {
                return url('/assets/logo/' . $file);
            }
        }
    }
    return url('/assets/logo/logo.svg');
}

/**
 * Afișează tag-uri <link> pentru favicon / apple-touch din assets/logo.
 */
function render_favicon_tags(): void
{
    $pairs = [
        ['favicon.svg', 'image/svg+xml'],
        ['favicon.ico', 'image/x-icon'],
        ['favicon.png', 'image/png'],
    ];
    foreach ($pairs as [$file, $type]) {
        foreach (assets_logo_directories() as $dir) {
            if (is_file($dir . DIRECTORY_SEPARATOR . $file)) {
                echo '    <link rel="icon" href="' . e(url('/assets/logo/' . $file)) . '" type="' . e($type) . '">' . "\n";
                continue 2;
            }
        }
    }
    foreach (assets_logo_directories() as $dir) {
        if (is_file($dir . DIRECTORY_SEPARATOR . 'apple-touch-icon.png')) {
            echo '    <link rel="apple-touch-icon" href="' . e(url('/assets/logo/apple-touch-icon.png')) . '">' . "\n";
            break;
        }
    }
}
