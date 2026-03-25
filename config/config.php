<?php
declare(strict_types=1);

/**
 * Rădăcină proiect (folderul care conține app/, assets/, config/, core/).
 * Folosit pentru căi către assets pe disc.
 */
if (!defined('ROOT_PATH')) {
    define('ROOT_PATH', dirname(__DIR__));
}

/**
 * Opțional: URL absolut către logo (ex. '/temp/assets/logo.svg').
 * Lasă gol ca să se detecteze automat: întâi assets/logo.svg, apoi assets/logo/*.
 */
const LOGO_URL = '';

const DB_HOST = 'localhost';
const DB_PORT = '5432';
const DB_NAME = 'secretdo_';
const DB_USER = 'admin1234';
const DB_PASS = 'xr$W3!Un5Rjusnj6';
const DB_DRIVER = 'mysql';

const BASE_URL = '';
const SITE_NAME = 'Secret Doors Premium';
const SITE_DOMAIN = 'https://secretdoors.ro';
const ADMIN_USER = 'admin';
const ADMIN_PASS = 'AAD1sup@$$';
const CONTACT_FORM_FROM_EMAIL = 'contact@secretdoors.ro';
const CONTACT_FORM_TO_EMAIL = 'sales@secretdoors.ro';
// SMTP: folosește host-ul din cPanel (ex. mail.secretdoors.ro), nu neapărat domeniul gol.
// Alternativ: variabile de mediu SMTP_HOST, SMTP_USERNAME, SMTP_PASSWORD pe server.
const SMTP_HOST = '';
const SMTP_PORT = 587;
const SMTP_USERNAME = '';
const SMTP_PASSWORD = '';
const SMTP_ENCRYPTION = 'tls'; // tls | ssl | none
const SMTP_TIMEOUT = 12;

$GLOBALS['site_contact'] = [
    'phone' => '0740992551',
    'phone_display' => '+40 740 992 551',
    'email' => 'sales@secretdoors.ro',
    'address' => 'București, Sector 2 / Intrarea Calității nr. 20',
    'instagram' => 'https://www.instagram.com/secret_doors_premium/',
    'tiktok' => 'https://www.tiktok.com/@secret.doors.prem',
    'google_maps_embed' => 'https://www.google.com/maps?q=Intrarea%20Calitatii%2020%2C%20Bucuresti&output=embed',
];
