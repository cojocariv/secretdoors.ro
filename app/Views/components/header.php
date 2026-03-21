<header class="sticky top-0 z-50 backdrop-blur bg-zinc-950/80 border-b border-zinc-800">
    <div class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between">
        <a href="<?= url('/') ?>" class="brand-logo-wrap group flex items-center gap-3 sm:gap-4 md:gap-5 min-h-[52px] md:min-h-[64px]" title="<?= e(SITE_NAME) ?>">
            <?php
            $logoUrl = logo_asset_url();
            $logoSvgFallback = url('/assets/logo/logo.svg');
            ?>
            <img
                src="<?= e($logoUrl) ?>"
                alt=""
                aria-hidden="true"
                class="brand-logo-img h-14 w-auto sm:h-[3.75rem] md:h-16 max-w-[min(100%,340px)] object-contain object-left shrink-0"
                width="340"
                height="68"
                decoding="async"
                fetchpriority="high"
                data-fallback-svg="<?= e($logoSvgFallback) ?>"
                onerror="if(!this.dataset.tried){this.dataset.tried='1';this.src=this.dataset.fallbackSvg;return;}this.style.display='none';"
            >
            <span class="brand-wordmark flex flex-col justify-center leading-none">
                <span class="brand-wordmark-inner tracking-tight">SECRET<span class="text-accent">DOORS</span></span>
            </span>
            <span class="sr-only"><?= e(SITE_NAME) ?></span>
        </a>
        <nav class="hidden md:flex gap-6 text-sm text-zinc-300 nav-reveal">
            <a href="<?= url('/produse') ?>">Produse</a>
            <a href="<?= url('/proiecte') ?>">Proiecte</a>
            <a href="<?= url('/despre-noi') ?>">Despre noi</a>
            <a href="<?= url('/noutati') ?>">Noutăți</a>
            <a href="<?= url('/contact') ?>">Contact</a>
        </nav>
    </div>
</header>
