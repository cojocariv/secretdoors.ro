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

// SEO keywords (meta "keywords" ajută mai puțin azi, dar le includem conform cerinței).
// Listă curată, fără emoji și cu focus principal pe România/București.
const SEO_KEYWORDS = 'uși ascunse, uși invizibile, uși filomuro, uși fără toc vizibil, uși moderne interior, uși minimaliste, uși premium interior, uși la comandă, producător uși filomuro, producător uși invizibile București, cumpără uși ascunse, comandă uși filomuro, uși invizibile la comandă, magazin uși filomuro, ofertă uși invizibile, preț uși ascunse, preț uși invizibile, uși filomuro livrare rapidă, instalare uși invizibile, uși ascunse în perete, uși invizibile cu balamale ascunse, uși filomuro fără pervaz, uși invizibile pentru design modern, uși ascunse pentru apartament, uși filomuro vopsite, uși invizibile personalizate, uși ascunse pentru birouri, uși filomuro cu finisaj MDF, uși invizibile cu toc ascuns aluminiu, plintă ascunsă, plintă filomuro, plintă invizibilă, plintă aluminiu, plintă modernă interior, plintă ascunsă București, plintă invizibilă București, profile decorative perete, profile aluminiu interior, profile aluminiu București, profile LED perete, profile LED perete București, cornișă ascunsă, cornișă modernă tavan, cornișă iluminare indirectă, cornișă iluminare indirectă București, profile pentru iluminare LED, design interior modern, stil minimalist interior, soluții moderne pereți, arhitectură modernă interior, finisaje premium interior, design pereți fără întreruperi, interior luxury modern, uși integrate în perete, sistem filomuro, toc ascuns aluminiu, balamale ascunse uși, sisteme uși invizibile, montaj uși filomuro, montaj uși invizibile București, instalare plintă ascunsă, instalare plintă ascunsă București, profile aluminiu anodizat, soluții constructive pereți, uși moderne România, uși filomuro România';

// Cache-busting pentru fișierele CSS/JS (important la unele browsere care păstrează vechiul bundle).
const ASSET_VERSION = '20260325-3';

$GLOBALS['site_contact'] = [
    'phone' => '0740992551',
    'phone_display' => '+40 740 992 551',
    'email' => 'sales@secretdoors.ro',
    'address' => 'București, Sector 2 / Intrarea Calității nr. 20',
    'instagram' => 'https://www.instagram.com/secret_doors_premium/',
    'tiktok' => 'https://www.tiktok.com/@secret.doors.prem',
    'google_maps_embed' => 'https://www.google.com/maps?q=Intrarea%20Calitatii%2020%2C%20Bucuresti&output=embed',
];
