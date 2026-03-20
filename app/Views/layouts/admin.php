<!doctype html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($title ?? 'Admin') ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-zinc-100 text-zinc-900">
<main class="max-w-6xl mx-auto p-6">
    <?php require $viewPath; ?>
</main>
</body>
</html>
