<section class="max-w-7xl mx-auto px-4 py-12">
    <h1 class="text-3xl font-semibold mb-2">Produse</h1>
    <p class="text-zinc-400 text-sm mb-8">
        Pozițiile afișate pe această pagină se gestionează din cabinetul personal (denumire, descriere, preț, imagine, poziție).
        Oferim uși ascunse, uși invizibile și uși filomuro fără pervaz, cu toc ascuns aluminiu, balamale ascunse uși și montaj pentru un interior premium.
        Pentru design modern și soluții moderne pereți: plintă ascunsă, plintă filomuro, profile aluminiu interior și cornișă iluminare indirectă.
        Livrare și instalare în România / București.
    </p>

    <div class="flex flex-wrap gap-2 mb-8" role="tablist" aria-label="Filtru categorii produse">
        <a
            href="<?= url('/produse') ?>"
            class="px-4 py-2 rounded-full text-sm border transition <?= $selectedCategory === '' ? 'border-accent text-accent bg-zinc-900' : 'border-zinc-700 text-zinc-300 bg-zinc-950 hover:border-accent/60' ?>"
        >
            Toate
        </a>
        <?php foreach ($categoryFilters as $slug => $label): ?>
            <a
                href="<?= url('/produse?categorie=' . rawurlencode($slug)) ?>"
                class="px-4 py-2 rounded-full text-sm border transition <?= $selectedCategory === $slug ? 'border-accent text-accent bg-zinc-900' : 'border-zinc-700 text-zinc-300 bg-zinc-950 hover:border-accent/60' ?>"
            >
                <?= e($label) ?>
            </a>
        <?php endforeach; ?>
    </div>

    <?php if (empty($products)): ?>
        <p class="text-zinc-500">Nu există produse pentru filtrul selectat.</p>
    <?php else: ?>
        <div class="grid md:grid-cols-3 lg:grid-cols-4 gap-6">
            <?php $show_price = true; ?>
            <?php foreach ($products as $product): ?>
                <?php require __DIR__ . '/../components/product-card.php'; ?>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>
