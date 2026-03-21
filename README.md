# Secret Doors — site corporate

Stack: PHP (MVC simplu), MySQL/MariaDB, HTML5, Tailwind CSS (CDN), JavaScript ES6.

## Setup rapid

1. Importă `database/schema.sql` și `database/seeds/mock_data.sql` în MySQL.
2. Configurează conexiunea în `config/config.php`.
3. Setează document root către `public/` (sau rădăcina proiectului, varianta B).
4. Activează `mod_rewrite` (Apache) pentru URL-uri curate.

## URL-uri principale

- `/` — Acasă
- `/produse` — Galerii (Uși ascunse, Profile, Cornișă)
- `/proiecte` — Proiecte
- `/noutati` — Blog
- `/contact` — Formular + salvare în DB

## Admin

- `/admin/login`
- User: `admin`
- Parola: vezi `config/config.php`

Pagini CRUD:

- `/admin/produse`
- `/admin/proiecte`
- `/admin/articole`
