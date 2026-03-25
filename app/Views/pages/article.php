<?php
$slug = (string) ($article['slug'] ?? '');
$shareUrl = $slug !== ''
    ? url('/noutati/articol?slug=' . rawurlencode($slug))
    : '';
$body = (string) ($article['body'] ?? '');
$paragraphs = preg_split("/\R\R+/", trim($body)) ?: [];
?>

<article class="max-w-5xl mx-auto px-4 py-12">
    <a href="<?= url('/noutati') ?>" class="inline-block text-accent text-sm mb-6 hover:underline">
        ← Înapoi la Noutăți
    </a>

    <img
        src="<?= e((string) ($article['cover_image'] ?? '')) ?>"
        alt="<?= e($article['title'] ?? '') ?>"
        class="w-full h-96 object-cover rounded-2xl"
        loading="lazy"
    >

    <h1 class="text-4xl font-semibold mt-8"><?= e($article['title'] ?? '') ?></h1>

    <?php if (!empty($article['excerpt'])): ?>
        <p class="mt-4 text-zinc-300 leading-7 max-w-3xl">
            <?= e((string) $article['excerpt']) ?>
        </p>
    <?php endif; ?>

    <div class="mt-6 text-zinc-300 leading-7 max-w-3xl">
        <?php foreach ($paragraphs as $p): ?>
            <?php $p = trim((string) $p); ?>
            <?php if ($p === '') continue; ?>
            <p class="mt-5"><?= nl2br(e($p)) ?></p>
        <?php endforeach; ?>
    </div>

    <?php if ($shareUrl !== ''): ?>
        <div class="mt-10 pt-6 border-t border-zinc-800">
            <p class="text-zinc-400 text-sm mb-2">Share</p>
            <a
                href="<?= e($shareUrl) ?>"
                target="_blank"
                rel="noopener noreferrer"
                class="text-accent hover:underline text-sm inline-block"
            >
                Copiază link articol
            </a>
        </div>
    <?php endif; ?>
</article>
