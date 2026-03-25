<!doctype html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    $computedTitle = $metaTitle ?? (($title ?? SITE_NAME) . ' | ' . SITE_NAME);
    $computedDescription = $metaDescription ?? 'Secret Doors — uși filomuro premium, uși ascunse și uși invizibile la comandă.';
    $computedKeywords = $metaKeywords ?? (defined('SEO_KEYWORDS') ? SEO_KEYWORDS : '');
    ?>
    <title><?= e($computedTitle) ?></title>
    <meta name="description" content="<?= e($computedDescription) ?>">
    <?php if ($computedKeywords !== ''): ?>
        <meta name="keywords" content="<?= e($computedKeywords) ?>">
    <?php endif; ?>
    <?php
    // Canonical + OpenGraph (SEO). Preferăm domeniul din config, ca să nu depindem de hostul de pe local.
    $requestPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?? '/';
    $canonical = rtrim(SITE_DOMAIN, '/') . $requestPath;

    $ogTitle = $metaTitle ?? ($title ?? SITE_NAME);
    $ogDescription = $computedDescription;
    $ogImage = $ogImage ?? hero_background_url();

    $robotsMeta = $robotsMeta ?? 'index,follow';
    ?>
    <link rel="canonical" href="<?= e($canonical) ?>">
    <meta name="robots" content="<?= e($robotsMeta) ?>">
    <meta property="og:site_name" content="<?= e(SITE_NAME) ?>">
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?= e($ogTitle) ?>">
    <meta property="og:description" content="<?= e($ogDescription) ?>">
    <meta property="og:url" content="<?= e($canonical) ?>">
    <meta property="og:image" content="<?= e($ogImage) ?>">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= e($ogTitle) ?>">
    <meta name="twitter:description" content="<?= e($ogDescription) ?>">
    <meta name="twitter:image" content="<?= e($ogImage) ?>">
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
    <link rel="stylesheet" href="<?= url('/assets/css/app.css') ?>?v=<?= e(ASSET_VERSION) ?>">
</head>
<body class="bg-zinc-950 text-zinc-100 font-sans">
<?php require __DIR__ . '/../components/header.php'; ?>
<main class="min-h-screen main-site-enter">
    <?php require $viewPath; ?>
</main>

<a
    href="<?= url('/contact') ?>"
    class="fixed bottom-5 right-5 md:bottom-8 md:right-8 z-50 inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-accent text-zinc-950 shadow-[0_10px_40px_rgba(0,0,0,0.55)] hover:brightness-110 transition"
    aria-label="Solicită ofertă"
>
    <span class="font-semibold">Solicită ofertă</span>
    <span aria-hidden="true">→</span>
</a>

<?php require __DIR__ . '/../components/footer.php'; ?>
<?php
$contactEmail = site_contact('email');
$contactPhone = site_contact('phone_display') ?: site_contact('phone');
$contactAddress = site_contact('address');
$schema = [
    '@context' => 'https://schema.org',
    '@type' => 'LocalBusiness',
    'name' => SITE_NAME,
    'url' => SITE_DOMAIN,
    'email' => $contactEmail,
    'telephone' => $contactPhone,
    'address' => [
        '@type' => 'PostalAddress',
        'streetAddress' => $contactAddress,
    ],
];
?>
<script type="application/ld+json">
<?= json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) ?>
</script>
<script src="<?= url('/assets/js/app.js') ?>?v=<?= e(ASSET_VERSION) ?>"></script>
</body>
</html>
