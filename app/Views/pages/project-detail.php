<section class="max-w-5xl mx-auto px-4 py-12">
    <img src="<?= e($project['image_url']) ?>" alt="<?= e($project['title']) ?>" class="w-full h-[480px] object-cover rounded-2xl" loading="lazy">
    <p class="text-accent text-xs uppercase mt-6"><?= e($project['project_type']) ?></p>
    <h1 class="text-3xl font-semibold mt-2"><?= e($project['title']) ?></h1>
    <p class="text-zinc-300 mt-4"><?= e($project['summary']) ?></p>
</section>
