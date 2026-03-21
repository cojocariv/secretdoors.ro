<section class="relative min-h-[92vh] flex items-center overflow-hidden">
    <div class="absolute inset-0 -z-10" aria-hidden="true">
        <img
            src="<?= e(hero_background_url()) ?>"
            alt=""
            width="2400"
            height="1600"
            class="hero-bg-img absolute inset-0 h-full w-full object-cover object-[center_28%]"
            loading="eager"
            fetchpriority="high"
            decoding="async"
            sizes="100vw"
        >
        <!-- Contrast pentru text: întunecare spre stânga + jos -->
        <div class="absolute inset-0 bg-gradient-to-r from-zinc-950 via-zinc-950/80 to-zinc-950/25"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-zinc-950/70 via-transparent to-zinc-950/90"></div>
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top_right,_rgba(199,167,106,0.12),_transparent_55%)]"></div>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto w-full px-4 py-24 md:py-32">
        <p class="text-accent uppercase tracking-[0.35em] text-xs mb-5 drop-shadow-md animate-fadein">Premium Filomuro</p>
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-semibold max-w-3xl leading-[1.12] text-white drop-shadow-[0_4px_32px_rgba(0,0,0,0.45)]">
            Uși ascunse care definesc arhitectura modernă.
        </h1>
        <p class="mt-7 text-zinc-100/95 max-w-2xl text-lg leading-relaxed drop-shadow-md">
            Design minimalist, producție precisă și finisaje premium pentru spații rezidențiale și comerciale.
        </p>
        <a href="<?= url('/produse') ?>" class="inline-block mt-10 px-7 py-3.5 border border-accent text-accent bg-zinc-950/40 backdrop-blur-sm hover:bg-accent hover:text-zinc-950 transition duration-300 rounded-sm font-medium shadow-lg">
            Explorează colecția
        </a>
    </div>
</section>

<section class="max-w-7xl mx-auto px-4 py-16">
        <h2 class="text-2xl font-semibold mb-6">Produse în evidență</h2>
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
        <h3 class="text-2xl font-semibold">Solicită o ofertă personalizată</h3>
        <p class="text-zinc-300 mt-3">Consultanță tehnică gratuită pentru proiectul tău.</p>
        <a href="<?= url('/contact') ?>" class="inline-block mt-6 px-6 py-3 bg-accent text-zinc-950 rounded-lg">Contactează-ne</a>
    </div>
</section>
