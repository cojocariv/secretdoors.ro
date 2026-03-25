<?php
$hero_slides = [
    'https://cojocaristorage.blob.core.windows.net/secretdoors/usi/IMG_8085.JPG?sp=racwdl&st=2026-03-23T17:46:49Z&se=2026-04-10T01:01:49Z&sv=2024-11-04&sr=c&sig=p%2FEGIMcr6%2BTlfBYLMP6cuEpsCQTEJjUf8FwVc%2BT0n58%3D',
    'https://cojocaristorage.blob.core.windows.net/secretdoors/usi/IMG_8088.JPG?sp=racwdl&st=2026-03-23T17:46:49Z&se=2026-04-10T01:01:49Z&sv=2024-11-04&sr=c&sig=p%2FEGIMcr6%2BTlfBYLMP6cuEpsCQTEJjUf8FwVc%2BT0n58%3D',
    'https://cojocaristorage.blob.core.windows.net/secretdoors/usi/IMG_8112.JPG?sp=racwdl&st=2026-03-23T17:46:49Z&se=2026-04-10T01:01:49Z&sv=2024-11-04&sr=c&sig=p%2FEGIMcr6%2BTlfBYLMP6cuEpsCQTEJjUf8FwVc%2BT0n58%3D',
    'https://cojocaristorage.blob.core.windows.net/secretdoors/usi/IMG_8114.JPG?sp=racwdl&st=2026-03-23T17:46:49Z&se=2026-04-10T01:01:49Z&sv=2024-11-04&sr=c&sig=p%2FEGIMcr6%2BTlfBYLMP6cuEpsCQTEJjUf8FwVc%2BT0n58%3D',
];
?>

<section class="hero-carousel relative min-h-[92vh] flex items-center overflow-hidden">
    <div class="absolute inset-0 -z-10" aria-hidden="true">
        <?php foreach ($hero_slides as $index => $hero_url): ?>
            <img
                src="<?= e($hero_url) ?>"
                alt=""
                width="2400"
                height="1600"
                class="hero-bg-img hero-slide absolute inset-0 h-full w-full object-cover object-[center_28%]"
                loading="<?= $index === 0 ? 'eager' : 'lazy' ?>"
                fetchpriority="<?= $index === 0 ? 'high' : 'auto' ?>"
                decoding="async"
                sizes="100vw"
                style="animation-delay: <?= e((string) ($index * 3)) ?>s;"
            >
        <?php endforeach; ?>
        <div class="absolute inset-0 bg-gradient-to-r from-zinc-950/90 via-zinc-950/55 to-zinc-950/20"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-zinc-950/78 via-zinc-950/30 to-zinc-950/92"></div>
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top_right,_rgba(199,167,106,0.18),_transparent_54%)]"></div>
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_bottom_left,_rgba(49,73,120,0.16),_transparent_55%)]"></div>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto w-full px-4 py-24 md:py-32">
        <p class="text-accent uppercase tracking-[0.38em] text-xs mb-5 drop-shadow-md animate-fadein">Invisible Doors. Perfect Architecture.</p>
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-semibold max-w-3xl leading-[1.05] text-white drop-shadow-[0_4px_32px_rgba(0,0,0,0.45)]">
            Premium filomuro systems for modern interiors.
        </h1>
        <p class="mt-7 text-zinc-100/95 max-w-2xl text-lg leading-relaxed drop-shadow-md">
            Hidden doors that disappear into the wall: uși ascunse, uși invizibile la comandă, balamale ascunse și toc ascuns aluminiu.
        </p>
        <a href="<?= url('/contact') ?>" class="inline-flex items-center gap-2 mt-10 px-7 py-3.5 rounded-sm font-medium shadow-lg bg-accent text-zinc-950 hover:brightness-110 transition duration-300">
            Request a Quote
            <span class="text-sm">→</span>
        </a>
    </div>
</section>

<section class="max-w-7xl mx-auto px-4 py-8">
    <p class="text-zinc-300/95 max-w-4xl text-base leading-7">
        Oferim uși ascunse în perete, uși invizibile cu balamale ascunse și uși filomuro fără pervaz, pentru design interior modern și stil minimalist.
        Producător uși filomuro pentru București / România: preț uși ascunse, uși invizibile la comandă, montaj și instalare plintă ascunsă.
    </p>
</section>

<?php
$category_cards = [
    ['title' => 'Hidden Doors', 'slug' => 'usi-invizibile', 'img' => $hero_slides[1] ?? $hero_slides[0], 'desc' => 'Uși invizibile, cu toc ascuns aluminiu și balamale ascunse.'],
    ['title' => 'Flush / Filomuro', 'slug' => 'usi-filomuro', 'img' => $hero_slides[2] ?? $hero_slides[0], 'desc' => 'Uși filomuro fără pervaz: arhitectură curată și premium.'],
    ['title' => 'Hidden Skirting Boards', 'slug' => 'profile', 'img' => $hero_slides[3] ?? $hero_slides[0], 'desc' => 'Plintă ascunsă și soluții moderne pereți.'],
    ['title' => 'Aluminum Profiles', 'slug' => 'profile', 'img' => $hero_slides[0], 'desc' => 'Profile aluminiu interior, profile LED și detalii constructive.'],
    ['title' => 'Cornices', 'slug' => 'cornisa', 'img' => $hero_slides[0], 'desc' => 'Cornisă modernă, cornișă iluminare indirectă și finishing.'],
];
?>

<section class="max-w-7xl mx-auto px-4 py-16">
    <div class="flex items-end justify-between mb-10">
        <div>
            <h2 class="text-2xl md:text-3xl font-semibold">Category Collection</h2>
            <p class="text-zinc-400 text-sm mt-2">Alege soluția: hidden doors, filomuro, plintă ascunsă, profile aluminiu și cornise.</p>
        </div>
        <a href="<?= url('/produse') ?>" class="text-accent hover:underline text-sm">View all products</a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php foreach ($category_cards as $cat): ?>
            <a
                href="<?= url('/produse?categorie=' . rawurlencode($cat['slug'])) ?>"
                class="group bg-zinc-950/20 border border-zinc-800 rounded-2xl overflow-hidden hover:border-accent/70 hover:shadow-[0_0_0_1px_rgba(199,167,106,0.25),0_18px_60px_rgba(0,0,0,0.5)] transition"
            >
                <div class="relative h-44">
                    <img src="<?= e($cat['img']) ?>" alt="<?= e($cat['title']) ?>" class="h-full w-full object-cover transition duration-500 group-hover:scale-[1.03]" loading="lazy">
                    <div class="absolute inset-0 bg-gradient-to-t from-zinc-950/80 via-zinc-950/35 to-transparent"></div>
                </div>
                <div class="p-5">
                    <h3 class="text-lg font-semibold group-hover:text-accent transition"><?= e($cat['title']) ?></h3>
                    <p class="text-zinc-400 text-sm mt-2 leading-6"><?= e($cat['desc']) ?></p>
                </div>
            </a>
        <?php endforeach; ?>
    </div>

    <div class="mt-12">
        <h2 class="text-xl md:text-2xl font-semibold mb-4">Featured Products</h2>
        <div class="grid md:grid-cols-4 gap-6">
            <?php $show_price = true; ?>
            <?php foreach ($products as $product): ?>
                <?php require __DIR__ . '/../components/product-card.php'; ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="max-w-7xl mx-auto px-4 py-16">
    <div class="flex items-end justify-between mb-6">
        <h2 class="text-2xl md:text-3xl font-semibold">Featured Projects</h2>
        <a href="<?= url('/proiecte') ?>" class="text-zinc-300">Vezi toate</a>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <?php foreach ($projects as $index => $project): ?>
            <?php $show_project_image_carousel = ((int)$index === 0); ?>
            <?php require __DIR__ . '/../components/project-card.php'; ?>
        <?php endforeach; ?>
    </div>
</section>

<section class="max-w-7xl mx-auto px-4 py-16">
    <div class="mb-10">
        <h2 class="text-2xl md:text-3xl font-semibold">Why Secret Doors</h2>
        <p class="text-zinc-400 text-sm mt-2 max-w-3xl">Crafted for architects, designers and premium clients: hidden doors that keep the architecture uninterrupted.</p>
    </div>

    <div class="grid md:grid-cols-4 gap-6">
        <div class="bg-zinc-950/20 border border-zinc-800 rounded-2xl p-6">
            <h3 class="font-semibold">We create doors that disappear</h3>
            <p class="text-zinc-400 text-sm mt-2 leading-6">Flush geometry, hidden hinges and clean edges.</p>
        </div>
        <div class="bg-zinc-950/20 border border-zinc-800 rounded-2xl p-6">
            <h3 class="font-semibold">Custom solutions</h3>
            <p class="text-zinc-400 text-sm mt-2 leading-6">Uși invizibile la comandă, finisaje premium și montaj asistat.</p>
        </div>
        <div class="bg-zinc-950/20 border border-zinc-800 rounded-2xl p-6">
            <h3 class="font-semibold">Modern interior systems</h3>
            <p class="text-zinc-400 text-sm mt-2 leading-6">Plintă ascunsă, profile aluminiu și cornișă pentru lumină indirectă.</p>
        </div>
        <div class="bg-zinc-950/20 border border-zinc-800 rounded-2xl p-6">
            <h3 class="font-semibold">București / România</h3>
            <p class="text-zinc-400 text-sm mt-2 leading-6">Livrare și instalare pentru apartamente și birouri.</p>
        </div>
    </div>

    <div class="mt-12 grid md:grid-cols-3 gap-6">
        <div class="md:col-span-1 bg-zinc-950/20 border border-zinc-800 rounded-2xl p-6">
            <p class="text-zinc-400 text-sm">Client</p>
            <p class="text-white font-semibold mt-2">Architect • București</p>
            <p class="text-zinc-300 mt-4 leading-7">“The hidden doors look effortless. The finish feels like part of the wall.”</p>
        </div>
        <div class="md:col-span-1 bg-zinc-950/20 border border-zinc-800 rounded-2xl p-6">
            <p class="text-zinc-400 text-sm">Client</p>
            <p class="text-white font-semibold mt-2">Designer • Rezidențial</p>
            <p class="text-zinc-300 mt-4 leading-7">“Minimal seams, premium materials, and clean hardware. Exactly what we wanted.”</p>
        </div>
        <div class="md:col-span-1 bg-zinc-950/20 border border-zinc-800 rounded-2xl p-6">
            <p class="text-zinc-400 text-sm">Client</p>
            <p class="text-white font-semibold mt-2">Commercial Office</p>
            <p class="text-zinc-300 mt-4 leading-7">“Fast delivery and installation. The space now feels much more modern.”</p>
        </div>
    </div>
</section>

<section class="max-w-7xl mx-auto px-4 pb-20">
    <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-10 text-center">
        <h3 class="text-2xl md:text-3xl font-semibold">Request your quote</h3>
        <p class="text-zinc-300 mt-3">Free consultation. Custom solutions for hidden doors, filomuro and premium interior systems.</p>
        <div class="mt-6 flex items-center justify-center gap-3 flex-wrap">
            <a href="<?= url('/contact') ?>" class="inline-block px-6 py-3 bg-accent text-zinc-950 rounded-lg hover:brightness-110 transition">Request a Quote</a>
            <a href="<?= url('/proiecte') ?>" class="inline-block px-6 py-3 border border-zinc-700 text-zinc-100 rounded-lg hover:border-accent transition">See Projects</a>
        </div>
    </div>
</section>
