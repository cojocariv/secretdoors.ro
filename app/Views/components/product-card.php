<?php
/** @var array $product */
$show_price = $show_price ?? true;
$img_src = normalize_image_url(trim((string) ($product['display_image'] ?? $product['image_url'] ?? '')));
$has_image = $img_src !== '';
?>
<article class="bg-zinc-900 border border-zinc-800 rounded-2xl overflow-hidden hover:-translate-y-1 transition shadow-sm flex flex-col h-full w-full min-w-0">
    <?php if ($has_image): ?>
    <img src="<?= e($img_src) ?>" alt="<?= e($product['name']) ?>" loading="lazy" class="js-lightbox h-56 w-full object-cover cursor-zoom-in flex-shrink-0" tabindex="0" role="button" aria-label="Mărește imaginea">
    <?php else: ?>
    <div class="h-56 w-full grid place-items-center bg-zinc-800 text-zinc-400 text-sm flex-shrink-0">Imagine indisponibilă</div>
    <?php endif; ?>
    <div class="p-5 flex flex-col flex-1">
        <h3 class="text-lg font-semibold"><?= e($product['name']) ?></h3>
        <p class="text-zinc-400 text-sm mt-2"><?= e($product['short_description']) ?></p>
        <div class="mt-auto flex items-center">
            <?php if ($show_price): ?>
                <span class="text-accent font-semibold"><?= number_format((float)$product['price'], 0, ',', '.') ?> RON</span>
            <?php else: ?>
                <span></span>
            <?php endif; ?>
        </div>
    </div>
</article>
