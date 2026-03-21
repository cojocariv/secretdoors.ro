<section class="relative min-h-[80vh] flex items-center px-4">
    <div class="max-w-7xl mx-auto w-full">
        <p class="text-accent uppercase tracking-[0.3em] text-xs mb-4 animate-fadein">Premium Filomuro</p>
        <h1 class="text-4xl md:text-6xl font-semibold max-w-3xl leading-tight">Usi ascunse care definesc arhitectura moderna.</h1>
        <p class="mt-6 text-zinc-300 max-w-2xl">Design minimalist, productie precisa si finisaje premium pentru spatii rezidentiale si comerciale.</p>
        <a href="<?= url('/shop') ?>" class="inline-block mt-8 px-6 py-3 border border-accent text-accent hover:bg-accent hover:text-zinc-950 transition">Exploreaza colectia</a>
    </div>
    <div class="absolute inset-0 -z-10 bg-[radial-gradient(circle_at_top_right,_rgba(199,167,106,0.2),_transparent_45%)]"></div>
</section>

<section class="max-w-7xl mx-auto px-4 py-16">
    <h2 class="text-2xl font-semibold mb-6">Produse highlight</h2>
    <div class="grid md:grid-cols-4 gap-6">
        <?php $show_price = false; ?>
        <?php foreach ($products as $product): ?>
            <?php require __DIR__ . '/../components/product-card.php'; ?>
        <?php endforeach; ?>
    </div>
</section>

<section class="max-w-7xl mx-auto px-4 py-16">
    <div class="flex items-end justify-between mb-6">
        <h2 class="text-2xl font-semibold">Proiecte recente</h2>
        <a href="<?= url('/proiecte') ?>" class="text-zinc-300">Vezi toate</a>
    </div>
    <div class="columns-1 md:columns-3 gap-6">
        <?php foreach ($projects as $project): ?>
            <?php require __DIR__ . '/../components/project-card.php'; ?>
        <?php endforeach; ?>
    </div>
</section>

<section class="max-w-7xl mx-auto px-4 pb-20">
    <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-10 text-center">
        <h3 class="text-2xl font-semibold">Solicita o oferta personalizata</h3>
        <p class="text-zinc-300 mt-3">Consultanta tehnica gratuita pentru proiectul tau.</p>
        <a href="<?= url('/contact') ?>" class="inline-block mt-6 px-6 py-3 bg-accent text-zinc-950 rounded-lg">Contacteaza-ne</a>
    </div>
</section>
