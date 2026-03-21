<header class="sticky top-0 z-50 backdrop-blur bg-zinc-950/80 border-b border-zinc-800">
    <div class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between">
        <a href="<?= url('/') ?>" class="flex items-center gap-3 min-h-[40px]">
            <?php $logoUrl = logo_asset_url(); ?>
            <?php if ($logoUrl): ?>
                <img src="<?= e($logoUrl) ?>" alt="<?= e(SITE_NAME) ?>" class="h-9 w-auto max-w-[200px] object-contain object-left" width="200" height="36" decoding="async">
            <?php else: ?>
                <span class="text-xl font-semibold tracking-wide">SECRET DOORS</span>
            <?php endif; ?>
        </a>
        <nav class="hidden md:flex gap-6 text-sm text-zinc-300">
            <a href="<?= url('/shop') ?>">Shop</a>
            <a href="<?= url('/produse') ?>">Produse</a>
            <a href="<?= url('/proiecte') ?>">Proiecte</a>
            <a href="<?= url('/despre-noi') ?>">Despre noi</a>
            <a href="<?= url('/noutati') ?>">Noutati</a>
            <a href="<?= url('/contact') ?>">Contact</a>
        </nav>
    </div>
</header>
