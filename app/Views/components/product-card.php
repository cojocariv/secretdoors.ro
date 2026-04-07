<?php
/** @var array $product */
$show_price = $show_price ?? true;
$img_src = normalize_image_url(trim((string) ($product['display_image'] ?? $product['image_url'] ?? '')));
$has_image = $img_src !== '';
?>
<article class="bg-zinc-950/25 border border-zinc-800/70 rounded-2xl overflow-hidden hover:border-accent/70 hover:shadow-[0_0_0_1px_rgba(199,167,106,0.22),0_30px_90px_rgba(0,0,0,0.55)] hover:-translate-y-0.5 transition shadow-sm flex flex-col h-full w-full min-w-0 backdrop-blur-[2px]">
    <?php if ($has_image): ?>
    <img src="<?= e($img_src) ?>" alt="<?= e($product['name']) ?>" loading="lazy" class="js-lightbox h-56 w-full object-cover cursor-zoom-in flex-shrink-0" tabindex="0" role="button" aria-label="Mărește imaginea">
    <?php else: ?>
    <div class="h-56 w-full grid place-items-center bg-zinc-800 text-zinc-400 text-sm flex-shrink-0">Imagine indisponibilă</div>
    <?php endif; ?>
    <div class="p-5 flex flex-col flex-1">
        <h3 class="text-lg font-semibold"><?= e($product['name']) ?></h3>
        <p class="text-zinc-400 text-sm mt-2"><?= e($product['short_description']) ?></p>
        <?php
        $orderQuery = http_build_query([
            'pid' => (int) ($product['id'] ?? 0),
            'produs' => (string) ($product['name'] ?? ''),
        ], '', '&', PHP_QUERY_RFC3986);
        $orderHref = url('/contact') . ($orderQuery !== '' ? '?' . $orderQuery : '') . '#formular-contact';
        ?>
        <div class="mt-auto pt-4 flex flex-col gap-3">
            <?php if ($show_price): ?>
                <span class="text-accent font-semibold"><?= number_format((float)$product['price'], 0, ',', '.') ?> RON</span>
            <?php endif; ?>
            <a
                href="<?= e($orderHref) ?>"
                class="inline-flex items-center justify-center w-full px-4 py-2.5 rounded-lg bg-accent text-zinc-950 font-medium text-sm hover:brightness-110 transition border border-accent/80"
            >
                Comandă
            </a>
        </div>
    </div>
</article>
