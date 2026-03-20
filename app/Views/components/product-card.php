<article class="bg-zinc-900 border border-zinc-800 rounded-2xl overflow-hidden hover:-translate-y-1 transition">
    <img src="<?= e($product['image_url']) ?>" alt="<?= e($product['name']) ?>" loading="lazy" class="h-56 w-full object-cover">
    <div class="p-5">
        <h3 class="text-lg font-semibold"><?= e($product['name']) ?></h3>
        <p class="text-zinc-400 text-sm mt-2"><?= e($product['short_description']) ?></p>
        <div class="mt-4 flex justify-between items-center">
            <span class="text-accent font-semibold"><?= number_format((float)$product['price'], 0, ',', '.') ?> RON</span>
            <a href="<?= url('/shop/produs?id=' . (int)$product['id']) ?>" class="text-sm">Detalii</a>
        </div>
    </div>
</article>
