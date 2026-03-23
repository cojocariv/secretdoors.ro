<section class="max-w-7xl mx-auto px-4 py-12" data-produse-tabs>
    <h1 class="text-3xl font-semibold mb-2">Produse</h1>
    <p class="text-zinc-400 text-sm mb-8">Galerii foto pe categorii. Poți închide imaginile mărite cu tasta Esc sau click în afara lor.</p>

    <div class="flex flex-wrap gap-2 mb-10 border-b border-zinc-800 pb-4" role="tablist" aria-label="Categorii produse">
        <button type="button" role="tab" data-tab="toate" aria-selected="true" class="produse-tab px-4 py-2 rounded-full text-sm border transition hover:border-accent/60 border-accent text-accent bg-zinc-900">
            Toate
        </button>
        <button type="button" role="tab" data-tab="usi" aria-selected="false" class="produse-tab px-4 py-2 rounded-full text-sm border transition hover:border-accent/60 border-zinc-700 text-zinc-300 bg-zinc-950">
            Uși ascunse
        </button>
        <button type="button" role="tab" data-tab="profile" aria-selected="false" class="produse-tab px-4 py-2 rounded-full text-sm border transition hover:border-accent/60 border-zinc-700 text-zinc-300 bg-zinc-950">
            Profile
        </button>
        <button type="button" role="tab" data-tab="cornise" aria-selected="false" class="produse-tab px-4 py-2 rounded-full text-sm border transition hover:border-accent/60 border-zinc-700 text-zinc-300 bg-zinc-950">
            Cornișă
        </button>
    </div>

    <div data-panel="toate" class="produse-panel">
        <h2 class="sr-only">Toate categoriile</h2>
        <?php if (empty($gallery_toate)): ?>
            <p class="text-zinc-500">Adaugă imagini în folderele <code class="text-zinc-400">assets/usi</code>, <code class="text-zinc-400">assets/profile</code>, <code class="text-zinc-400">assets/cornise</code>.</p>
        <?php else: ?>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                <?php foreach ($gallery_toate as $imgUrl): ?>
                    <img src="<?= e($imgUrl) ?>" alt="" loading="lazy" class="js-lightbox w-full aspect-video object-cover rounded-xl border border-zinc-800 cursor-zoom-in">
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <div data-panel="usi" class="produse-panel hidden">
        <h2 class="text-lg font-medium text-accent mb-4">Uși ascunse</h2>
        <?php if (empty($gallery_usi)): ?>
            <p class="text-zinc-500">Folderul <code class="text-zinc-400">assets/usi</code> este gol.</p>
        <?php else: ?>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                <?php foreach ($gallery_usi as $imgUrl): ?>
                    <img src="<?= e($imgUrl) ?>" alt="Ușă ascunsă" loading="lazy" class="js-lightbox w-full aspect-video object-cover rounded-xl border border-zinc-800 cursor-zoom-in">
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <div data-panel="profile" class="produse-panel hidden">
        <h2 class="text-lg font-medium text-accent mb-4">Profile</h2>
        <?php if (!empty($profile_catalog_pdf)): ?>
            <div class="mb-6 p-4 rounded-xl border border-zinc-800 bg-zinc-900/50 flex flex-wrap items-center gap-4">
                <span class="text-zinc-300">Catalog profile (PDF)</span>
                <a href="<?= e($profile_catalog_pdf) ?>" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-accent text-zinc-950 font-medium hover:opacity-90 transition">
                    Deschide catalogul
                </a>
                <a href="<?= e($profile_catalog_pdf) ?>" download class="text-sm text-zinc-400 underline hover:text-accent">Descarcă</a>
            </div>
        <?php else: ?>
            <p class="text-zinc-500 text-sm mb-4">Plasează fișierul <code class="text-zinc-400">catalog profile.pdf</code> în <code class="text-zinc-400">assets/profile</code> pentru descărcare.</p>
        <?php endif; ?>
        <?php if (empty($gallery_profile)): ?>
            <p class="text-zinc-500">Folderul <code class="text-zinc-400">assets/profile</code> nu conține imagini.</p>
        <?php else: ?>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                <?php foreach ($gallery_profile as $imgUrl): ?>
                    <img src="<?= e($imgUrl) ?>" alt="Profil" loading="lazy" class="js-lightbox w-full aspect-video object-cover rounded-xl border border-zinc-800 cursor-zoom-in">
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <div data-panel="cornise" class="produse-panel hidden">
        <h2 class="text-lg font-medium text-accent mb-4">Cornișă</h2>
        <?php if (empty($gallery_cornise)): ?>
            <p class="text-zinc-500">Folderul <code class="text-zinc-400">assets/cornise</code> este gol.</p>
        <?php else: ?>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                <?php foreach ($gallery_cornise as $imgUrl): ?>
                    <img src="<?= e($imgUrl) ?>" alt="Cornișă" loading="lazy" class="js-lightbox w-full aspect-video object-cover rounded-xl border border-zinc-800 cursor-zoom-in">
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<section class="max-w-7xl mx-auto px-4 pb-16">
    <h2 class="text-2xl font-semibold mb-2">Catalog produse</h2>
    <p class="text-zinc-400 text-sm mb-8">Fiecare produs include denumire, descriere și preț.</p>
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
