<header class="sticky top-0 z-50 backdrop-blur bg-zinc-950/80 border-b border-zinc-800">
    <div class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between">
        <a href="<?= url('/') ?>" class="flex items-center gap-3 min-h-[40px]" title="<?= e(SITE_NAME) ?>">
            <?php
            $logoUrl = logo_asset_url();
            $logoSvgFallback = url('/assets/logo/logo.svg');
            ?>
            <img
                src="<?= e($logoUrl) ?>"
                alt="<?= e(SITE_NAME) ?>"
                class="h-10 w-auto max-h-12 max-w-[min(100%,240px)] object-contain object-left"
                width="240"
                height="48"
                decoding="async"
                fetchpriority="high"
                data-fallback-svg="<?= e($logoSvgFallback) ?>"
                onerror="if(!this.dataset.tried){this.dataset.tried='1';this.src=this.dataset.fallbackSvg;return;}this.style.display='none';var s=this.nextElementSibling;if(s)s.classList.remove('hidden');"
            >
            <span class="text-xl font-semibold tracking-wide hidden leading-none border-b border-accent/80 pb-0.5">SECRET DOORS</span>
        </a>
        <nav class="hidden md:flex gap-6 text-sm text-zinc-300">
            <a href="<?= url('/shop') ?>">Shop</a>
            <a href="<?= url('/produse') ?>">Produse</a>
            <a href="<?= url('/proiecte') ?>">Proiecte</a>
            <a href="<?= url('/despre-noi') ?>">Despre noi</a>
            <a href="<?= url('/noutati') ?>">Noutăți</a>
            <a href="<?= url('/contact') ?>">Contact</a>
        </nav>
    </div>
</header>
