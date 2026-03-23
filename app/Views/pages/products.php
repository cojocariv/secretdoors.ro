<section class="max-w-7xl mx-auto px-4 py-12">
    <h1 class="text-3xl font-semibold mb-2">Produse</h1>
    <p class="text-zinc-400 text-sm mb-8">Pozițiile afișate pe această pagină se gestionează din cabinetul personal (denumire, descriere, preț, imagine, poziție).</p>
    <?php if (empty($products)): ?>
        <p class="text-zinc-500">Nu există produse configurate în cabinetul personal.</p>
    <?php else: ?>
        <div class="grid md:grid-cols-3 lg:grid-cols-4 gap-6">
            <?php $show_price = true; ?>
            <?php foreach ($products as $product): ?>
                <?php require __DIR__ . '/../components/product-card.php'; ?>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>
