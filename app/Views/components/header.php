<header class="sticky top-0 z-50 backdrop-blur bg-zinc-950/80 border-b border-zinc-800">
    <div class="border-b border-zinc-900/80 bg-zinc-950/70">
        <div class="max-w-7xl mx-auto px-4 py-2 flex flex-wrap items-center gap-x-5 gap-y-1 text-[11px] sm:text-xs text-zinc-400">
            <span class="truncate max-w-full"><?= e(site_contact('address')) ?></span>
            <a href="mailto:<?= e(site_contact('email')) ?>" class="hover:text-accent transition-colors"><?= e(site_contact('email')) ?></a>
            <a href="tel:<?= e(site_contact('phone')) ?>" class="hover:text-accent transition-colors"><?= e(site_contact('phone_display')) ?></a>
        </div>
    </div>
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
        <div class="flex items-center gap-3 sm:gap-4 md:gap-6">
            <nav class="hidden md:flex gap-6 text-sm text-zinc-300 nav-reveal">
                <a href="<?= url('/produse') ?>">Produse</a>
                <a href="<?= url('/proiecte') ?>">Proiecte</a>
                <a href="<?= url('/despre-noi') ?>">Despre noi</a>
                <a href="<?= url('/noutati') ?>">Noutăți</a>
                <a href="<?= url('/contact') ?>">Contact</a>
            </nav>
            <div class="flex items-center gap-1 nav-reveal" aria-label="Rețele sociale">
                <a
                    href="<?= e(site_contact('instagram')) ?>"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="p-2 rounded-lg text-zinc-400 hover:text-accent transition-colors focus:outline-none focus-visible:ring-2 focus-visible:ring-accent/60"
                    aria-label="Instagram — Secret Doors Premium"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5" aria-hidden="true">
                        <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                    </svg>
                </a>
                <a
                    href="<?= e(site_contact('tiktok')) ?>"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="p-2 rounded-lg text-zinc-400 hover:text-accent transition-colors focus:outline-none focus-visible:ring-2 focus-visible:ring-accent/60"
                    aria-label="TikTok — Secret Doors Premium"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5" aria-hidden="true">
                        <path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.01-1.01-.02-1.51 1.89 1.09 4.23 1.49 6.36.89 1.09-.29 2.1-.88 2.9-1.67-.01-3.89 0-7.78-.02-11.67-.02-1.31-.42-2.63-1.26-3.65-.89-1.08-2.2-1.76-3.59-2.04-.5-.1-1.01-.15-1.52-.14z"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</header>
