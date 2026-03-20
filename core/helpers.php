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
