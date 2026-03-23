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
 * Rădăcină proiect (compatibil dacă ROOT_PATH e definit în config).
 */
function project_root(): string
{
    return defined('ROOT_PATH') ? ROOT_PATH : dirname(__DIR__);
}

/**
 * Foldere posibile pentru assets/logo (rădăcină proiect și /public pentru deploy).
 */
function assets_logo_directories(): array
{
    $root = project_root();
    return [
        $root . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'logo',
        $root . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'logo',
    ];
}

/**
 * Căi posibile pentru logo.svg plasat direct în assets/ (ex. temp/assets/logo.svg).
 */
function assets_logo_flat_paths(): array
{
    $root = project_root();

    return [
        $root . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'logo.svg',
        $root . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'logo.svg',
    ];
}

/**
 * URL public pentru logo header (primul fișier găsit pe disc).
 * Prioritate: assets/logo.svg (la rădăina assets), apoi assets/logo/*.
 */
function logo_asset_url(): string
{
    if (defined('LOGO_URL') && LOGO_URL !== '') {
        return LOGO_URL;
    }

    foreach (assets_logo_flat_paths() as $path) {
        if (is_file($path)) {
            return url('/assets/logo.svg');
        }
    }

    $files = ['logo.png', 'logo.webp', 'logo.svg', 'logo@2x.png'];
    foreach (assets_logo_directories() as $dir) {
        if (!is_dir($dir)) {
            continue;
        }
        foreach ($files as $file) {
            $path = $dir . DIRECTORY_SEPARATOR . $file;
            if (is_file($path)) {
                return url('/assets/logo/' . rawurlencode($file));
            }
        }
        // Variante de nume pe sisteme case-sensitive (ex. Logo.PNG)
        foreach (glob($dir . DIRECTORY_SEPARATOR . 'logo.*') ?: [] as $path) {
            if (is_file($path)) {
                $base = basename($path);
                $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
                if (in_array($ext, ['png', 'webp', 'svg', 'jpg', 'jpeg', 'gif'], true)) {
                    return url('/assets/logo/' . rawurlencode($base));
                }
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
    // Fallback robust dacă lipsesc favicon.* pe server:
    // browserele moderne pot folosi SVG-ul principal de brand.
    echo '    <link rel="icon" href="' . e(url('/assets/logo/logo.svg')) . '" type="image/svg+xml">' . "\n";
    echo '    <link rel="shortcut icon" href="' . e(url('/assets/logo/logo.svg')) . '">' . "\n";

    foreach (assets_logo_directories() as $dir) {
        if (is_file($dir . DIRECTORY_SEPARATOR . 'apple-touch-icon.png')) {
            echo '    <link rel="apple-touch-icon" href="' . e(url('/assets/logo/apple-touch-icon.png')) . '">' . "\n";
            break;
        }
    }
}

/**
 * Căi posibile pentru un subfolder din assets/ (ex: usi, profile, cornise).
 */
function assets_folder_paths(string $relativeFolder): array
{
    $relativeFolder = trim(str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $relativeFolder), DIRECTORY_SEPARATOR);
    $root = project_root();
    return [
        $root . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . $relativeFolder,
        $root . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . $relativeFolder,
    ];
}

/**
 * Listează URL-uri publice pentru imagini din assets/{folder} (jpg, png, webp, gif).
 *
 * @return list<string>
 */
function asset_gallery_images(string $folder): array
{
    $extensions = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
    $found = [];
    foreach (assets_folder_paths($folder) as $dir) {
        if (!is_dir($dir)) {
            continue;
        }
        foreach ($extensions as $ext) {
            foreach (glob($dir . DIRECTORY_SEPARATOR . '*.' . $ext) ?: [] as $path) {
                $found[] = basename($path);
            }
        }
        if ($found !== []) {
            break;
        }
    }
    $found = array_values(array_unique($found));
    sort($found, SORT_NATURAL | SORT_FLAG_CASE);

    return array_map(static function (string $file) use ($folder) {
        return url('/assets/' . $folder . '/' . rawurlencode($file));
    }, $found);
}

/**
 * Fundal hero (homepage): imagine din assets/hero (hero.webp / hero.jpg …) sau fallback Unsplash HD.
 */
function hero_background_url(): string
{
    $priority = ['hero.webp', 'hero.jpg', 'hero.jpeg', 'hero.png'];
    foreach (assets_folder_paths('hero') as $dir) {
        if (!is_dir($dir)) {
            continue;
        }
        foreach ($priority as $file) {
            $path = $dir . DIRECTORY_SEPARATOR . $file;
            if (is_file($path)) {
                return url('/assets/hero/' . rawurlencode($file));
            }
        }
    }

    // Interior modern, spațiu aerisit, linii curate — potrivit pentru uși filomuro (Unsplash, 2400px)
    return 'https://images.unsplash.com/photo-1600607687644-c7171b42498f?auto=format&fit=crop&w=2400&q=85';
}

/**
 * URL public pentru catalog PDF în Profile (nume fișier cu spații acceptat).
 */
function asset_profile_catalog_pdf_url(): ?string
{
    $filename = 'catalog profile.pdf';
    foreach (assets_folder_paths('profile') as $dir) {
        $path = $dir . DIRECTORY_SEPARATOR . $filename;
        if (is_file($path)) {
            return url('/assets/profile/' . rawurlencode($filename));
        }
    }
    return null;
}

/**
 * Normalizează URL-uri de imagine (ex: Google Drive share link -> direct image URL).
 */
function normalize_image_url(string $rawUrl): string
{
    $rawUrl = trim($rawUrl);
    if ($rawUrl === '') {
        return '';
    }

    $parts = parse_url($rawUrl);
    if ($parts === false) {
        return $rawUrl;
    }

    $host = strtolower($parts['host'] ?? '');
    if (!str_contains($host, 'drive.google.com')) {
        return $rawUrl;
    }

    $path = $parts['path'] ?? '';
    $query = $parts['query'] ?? '';
    $fileId = '';

    if ($query !== '') {
        parse_str($query, $queryParams);
        $fileId = (string) ($queryParams['id'] ?? '');
    }

    if ($fileId === '' && preg_match('#/file/d/([^/]+)#', $path, $matches) === 1) {
        $fileId = $matches[1];
    }

    if ($fileId === '') {
        return $rawUrl;
    }

    return 'https://drive.google.com/uc?export=view&id=' . rawurlencode($fileId);
}
