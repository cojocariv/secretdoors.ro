<article class="bg-zinc-900 rounded-2xl overflow-hidden border border-zinc-800 flex flex-col h-full w-full min-w-0">
    <img src="<?= e(normalize_image_url((string) ($project['image_url'] ?? ''))) ?>" alt="<?= e($project['title']) ?>" loading="lazy" class="js-lightbox h-56 w-full object-cover cursor-zoom-in" tabindex="0" role="button" aria-label="Mărește imaginea">
    <div class="p-4 flex flex-col flex-1">
        <p class="text-xs uppercase text-accent"><?= e($project['project_type']) ?></p>
        <h3 class="font-semibold mt-1"><?= e($project['title']) ?></h3>
        <a href="<?= url('/proiecte/detaliu?id=' . (int)$project['id']) ?>" class="text-sm text-zinc-300 mt-auto">Vezi proiect</a>
    </div>
</article>
