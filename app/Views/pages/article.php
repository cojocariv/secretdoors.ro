<article class="max-w-4xl mx-auto px-4 py-12">
    <img src="<?= e($article['cover_image']) ?>" alt="<?= e($article['title']) ?>" class="w-full h-96 object-cover rounded-2xl" loading="lazy">
    <h1 class="text-4xl font-semibold mt-8"><?= e($article['title']) ?></h1>
    <p class="mt-6 text-zinc-300 leading-7"><?= nl2br(e($article['body'])) ?></p>
</article>
