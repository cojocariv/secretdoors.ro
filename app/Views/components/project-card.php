<article class="break-inside-avoid mb-6 bg-zinc-900 rounded-2xl overflow-hidden border border-zinc-800">
    <img src="<?= e($project['image_url']) ?>" alt="<?= e($project['title']) ?>" loading="lazy" class="js-lightbox w-full object-cover cursor-zoom-in" tabindex="0" role="button" aria-label="Mărește imaginea">
    <div class="p-4">
        <p class="text-xs uppercase text-accent"><?= e($project['project_type']) ?></p>
        <h3 class="font-semibold mt-1"><?= e($project['title']) ?></h3>
        <a href="<?= url('/proiecte/detaliu?id=' . (int)$project['id']) ?>" class="text-sm text-zinc-300">Vezi proiect</a>
    </div>
</article>
