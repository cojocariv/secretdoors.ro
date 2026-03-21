<!doctype html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e(($title ?? SITE_NAME) . ' | ' . SITE_NAME) ?></title>
    <meta name="description" content="<?= e($metaDescription ?? 'Secret Doors — uși filomuro premium.') ?>">
<?php render_favicon_tags(); ?>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'sans-serif'] },
                    colors: { accent: '#c7a76a' }
                }
            }
        };
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Syne:wght@600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= url('/assets/css/app.css') ?>">
</head>
<body class="bg-zinc-950 text-zinc-100 font-sans">
<?php require __DIR__ . '/../components/header.php'; ?>
<main class="min-h-screen main-site-enter">
    <?php require $viewPath; ?>
</main>
<?php require __DIR__ . '/../components/footer.php'; ?>
<script src="<?= url('/assets/js/app.js') ?>"></script>
</body>
</html>
