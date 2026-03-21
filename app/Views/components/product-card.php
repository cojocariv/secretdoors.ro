<?php
/** @var array $product */
$show_price = $show_price ?? true;
$img_src = $product['display_image'] ?? $product['image_url'];
?>
<article class="bg-zinc-900 border border-zinc-800 rounded-2xl overflow-hidden hover:-translate-y-1 transition">
    <img src="<?= e($img_src) ?>" alt="<?= e($product['name']) ?>" loading="lazy" class="js-lightbox h-56 w-full object-cover cursor-zoom-in" tabindex="0" role="button" aria-label="Mareste imaginea">
    <div class="p-5">
        <h3 class="text-lg font-semibold"><?= e($product['name']) ?></h3>
        <p class="text-zinc-400 text-sm mt-2"><?= e($product['short_description']) ?></p>
        <div class="mt-4 flex justify-between items-center">
            <?php if ($show_price): ?>
                <span class="text-accent font-semibold"><?= number_format((float)$product['price'], 0, ',', '.') ?> RON</span>
            <?php else: ?>
                <span></span>
            <?php endif; ?>
            <a href="<?= url('/shop/produs?id=' . (int)$product['id']) ?>" class="text-sm">Detalii</a>
        </div>
    </div>
</article>
