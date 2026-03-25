<section class="max-w-6xl mx-auto px-4 py-12">
    <h1 class="text-3xl font-semibold mb-3">Noutăți</h1>
    <p class="text-zinc-400 text-sm mb-8 max-w-3xl leading-6">
        Articole utile despre uși filomuro, uși invizibile cu toc ascuns aluminiu, balamale ascunse și soluții constructive pentru un interior modern.
        Focus: București / România.
    </p>
    <div class="grid md:grid-cols-3 gap-6">
        <?php foreach ($articles as $article): ?>
            <article class="bg-zinc-900 border border-zinc-800 rounded-2xl overflow-hidden">
                <img src="<?= e($article['cover_image']) ?>" alt="<?= e($article['title']) ?>" loading="lazy" class="h-52 w-full object-cover">
                <div class="p-5">
                    <h2 class="font-semibold"><?= e($article['title']) ?></h2>
                    <p class="text-zinc-400 text-sm mt-2"><?= e($article['excerpt']) ?></p>
                    <a href="<?= url('/noutati/articol?slug=' . $article['slug']) ?>" class="text-accent text-sm mt-3 inline-block hover:underline">Mai multe detalii</a>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
</section>
