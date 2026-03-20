<section class="max-w-7xl mx-auto px-4 py-12">
    <h1 class="text-3xl font-semibold mb-8">Shop</h1>
    <form method="get" action="<?= url('/shop') ?>" class="grid md:grid-cols-4 gap-4 mb-8">
        <select name="categorie" class="bg-zinc-900 border border-zinc-700 rounded-lg px-3 py-2">
            <option value="">Tip usa</option>
            <?php foreach ($categories as $category): ?>
                <option value="<?= e($category['slug']) ?>" <?= ($filters['categorie'] ?? '') === $category['slug'] ? 'selected' : '' ?>><?= e($category['name']) ?></option>
            <?php endforeach; ?>
        </select>
        <input name="finish" placeholder="Finisaj" value="<?= e((string)($filters['finish'] ?? '')) ?>" class="bg-zinc-900 border border-zinc-700 rounded-lg px-3 py-2">
        <input name="max_price" type="number" placeholder="Pret maxim" value="<?= e((string)($filters['max_price'] ?? '')) ?>" class="bg-zinc-900 border border-zinc-700 rounded-lg px-3 py-2">
        <button class="bg-accent text-zinc-950 rounded-lg px-3 py-2">Filtreaza</button>
    </form>

    <div class="grid md:grid-cols-3 gap-6">
        <?php foreach ($products as $product): ?>
            <?php require __DIR__ . '/../components/product-card.php'; ?>
        <?php endforeach; ?>
    </div>
</section>
