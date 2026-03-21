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
 * Cale absolută către folderul assets/logo (rădăcină proiect).
 */
function assets_logo_dir(): string
{
    return dirname(__DIR__) . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'logo';
}

/**
 * URL public pentru logo header (primul fișier găsit: svg, png, webp).
 */
function logo_asset_url(): ?string
{
    $dir = assets_logo_dir();
    foreach (['logo.svg', 'logo.png', 'logo.webp', 'logo@2x.png'] as $file) {
        $path = $dir . DIRECTORY_SEPARATOR . $file;
        if (is_file($path)) {
            return url('/assets/logo/' . $file);
        }
    }
    return null;
}

/**
 * Afișează tag-uri <link> pentru favicon / apple-touch din assets/logo.
 */
function render_favicon_tags(): void
{
    $dir = assets_logo_dir();
    $pairs = [
        ['favicon.svg', 'image/svg+xml'],
        ['favicon.ico', 'image/x-icon'],
        ['favicon.png', 'image/png'],
    ];
    foreach ($pairs as [$file, $type]) {
        if (is_file($dir . DIRECTORY_SEPARATOR . $file)) {
            echo '    <link rel="icon" href="' . e(url('/assets/logo/' . $file)) . '" type="' . e($type) . '">' . "\n";
        }
    }
    if (is_file($dir . DIRECTORY_SEPARATOR . 'apple-touch-icon.png')) {
        echo '    <link rel="apple-touch-icon" href="' . e(url('/assets/logo/apple-touch-icon.png')) . '">' . "\n";
    }
}
