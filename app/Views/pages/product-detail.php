<section class="max-w-6xl mx-auto px-4 py-12 grid md:grid-cols-2 gap-10">
    <img src="<?= e($product['image_url']) ?>" alt="<?= e($product['name']) ?>" class="w-full rounded-2xl object-cover" loading="lazy">
    <div>
        <h1 class="text-3xl font-semibold"><?= e($product['name']) ?></h1>
        <p class="text-zinc-300 mt-4"><?= e($product['short_description']) ?></p>
        <p class="mt-3">Dimensiuni: <?= e($product['dimensions']) ?></p>
        <p>Finisaj: <?= e($product['finish']) ?></p>
        <p class="text-accent text-2xl font-semibold mt-4"><?= number_format((float)$product['price'], 0, ',', '.') ?> RON</p>
        <p class="mt-6 text-zinc-400 text-sm"><?= e($product['technical_specs']) ?></p>
        <form method="post" action="<?= url('/cart/add') ?>" class="mt-6">
            <input type="hidden" name="product_id" value="<?= (int)$product['id'] ?>">
            <button class="px-6 py-3 bg-accent text-zinc-950 rounded-lg">Adauga in cos</button>
        </form>
    </div>
</section>
