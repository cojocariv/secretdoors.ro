<section class="max-w-7xl mx-auto px-4 py-12">
    <h1 class="text-3xl font-semibold mb-4">Produse</h1>
    <div class="flex flex-wrap gap-3 mb-8">
        <a class="px-4 py-2 border border-zinc-700 rounded-full text-sm" href="<?= url('/produse') ?>">Toate</a>
        <?php foreach ($categories as $category): ?>
            <a class="px-4 py-2 border border-zinc-700 rounded-full text-sm" href="<?= url('/produse/categorie?slug=' . $category['slug']) ?>"><?= e($category['name']) ?></a>
        <?php endforeach; ?>
    </div>
    <div class="grid md:grid-cols-3 gap-6">
        <?php foreach ($products as $product): ?>
            <?php require __DIR__ . '/../components/product-card.php'; ?>
        <?php endforeach; ?>
    </div>
</section>
