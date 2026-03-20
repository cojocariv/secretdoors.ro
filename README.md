# Secret Doors - Corporate + eCommerce

Stack: PHP (MVC simplu), MySQL, HTML5, Tailwind CSS (CDN), JavaScript ES6.

## Setup rapid

1. Importa `database/schema.sql` si `database/seeds/mock_data.sql` in MySQL.
2. Configureaza conexiunea in `config/config.php`.
3. Seteaza document root catre `public/`.
4. Activeaza `mod_rewrite` (Apache) pentru URL-uri curate.

## URL-uri principale

- `/` Home
- `/shop` Shop + filtre + cart in session
- `/shop/produs?id=1` Detaliu produs
- `/produse` Produse pe categorii
- `/proiecte` Proiecte + filtru tip
- `/noutati` Blog
- `/contact` Formular + salvare DB

## Admin

- `/admin/login`
- User: `admin`
- Parola: `admin123`

Pagini CRUD:
- `/admin/produse`
- `/admin/proiecte`
- `/admin/articole`
