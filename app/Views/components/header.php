<?php $cartCount = array_sum($_SESSION['cart'] ?? []); ?>
<header class="sticky top-0 z-50 backdrop-blur bg-zinc-950/80 border-b border-zinc-800">
    <div class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between">
        <a href="<?= url('/') ?>" class="text-xl font-semibold tracking-wide">SECRET DOORS</a>
        <nav class="hidden md:flex gap-6 text-sm text-zinc-300">
            <a href="<?= url('/shop') ?>">Shop</a>
            <a href="<?= url('/produse') ?>">Produse</a>
            <a href="<?= url('/proiecte') ?>">Proiecte</a>
            <a href="<?= url('/despre-noi') ?>">Despre noi</a>
            <a href="<?= url('/noutati') ?>">Noutati</a>
            <a href="<?= url('/contact') ?>">Contact</a>
        </nav>
        <div class="text-sm">Cos: <span class="text-accent"><?= (int) $cartCount ?></span></div>
    </div>
</header>
