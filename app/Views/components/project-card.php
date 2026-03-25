<?php
// Setat din home.php doar pentru primul card "Proiecte recente"
$show_project_image_carousel = $show_project_image_carousel ?? false;

$carouselImages = [
    'https://cojocaristorage.blob.core.windows.net/secretdoors/usi/IMG_7929.JPG?sp=racwdl&st=2026-03-23T17:46:49Z&se=2026-04-10T01:01:49Z&sv=2024-11-04&sr=c&sig=p%2FEGIMcr6%2BTlfBYLMP6cuEpsCQTEJjUf8FwVc%2BT0n58%3D',
    'https://cojocaristorage.blob.core.windows.net/secretdoors/usi/IMG_8019.JPG?sp=racwdl&st=2026-03-23T17:46:49Z&se=2026-04-10T01:01:49Z&sv=2024-11-04&sr=c&sig=p%2FEGIMcr6%2BTlfBYLMP6cuEpsCQTEJjUf8FwVc%2BT0n58%3D',
    'https://cojocaristorage.blob.core.windows.net/secretdoors/usi/IMG_8072.JPG?sp=racwdl&st=2026-03-23T17:46:49Z&se=2026-04-10T01:01:49Z&sv=2024-11-04&sr=c&sig=p%2FEGIMcr6%2BTlfBYLMP6cuEpsCQTEJjUf8FwVc%2BT0n58%3D',
    'https://cojocaristorage.blob.core.windows.net/secretdoors/usi/IMG_8073.JPG?sp=racwdl&st=2026-03-23T17:46:49Z&se=2026-04-10T01:01:49Z&sv=2024-11-04&sr=c&sig=p%2FEGIMcr6%2BTlfBYLMP6cuEpsCQTEJjUf8FwVc%2BT0n58%3D',
    'https://cojocaristorage.blob.core.windows.net/secretdoors/usi/IMG_8074.JPG?sp=racwdl&st=2026-03-23T17:46:49Z&se=2026-04-10T01:01:49Z&sv=2024-11-04&sr=c&sig=p%2FEGIMcr6%2BTlfBYLMP6cuEpsCQTEJjUf8FwVc%2BT0n58%3D',
];
?>

<article class="bg-zinc-900 rounded-2xl overflow-hidden border border-zinc-800 flex flex-col h-full w-full min-w-0">
    <?php if ($show_project_image_carousel): ?>
        <div class="relative h-56 w-full overflow-hidden" data-project-carousel data-interval="3000">
            <?php foreach ($carouselImages as $i => $imgUrl): ?>
                <img
                    src="<?= e($imgUrl) ?>"
                    alt="<?= e($project['title'] ?? 'Proiect') ?>"
                    loading="<?= $i === 0 ? 'eager' : 'lazy' ?>"
                    class="js-lightbox project-carousel-slide absolute inset-0 h-56 w-full object-cover cursor-zoom-in transition-opacity duration-700 ease-in-out <?= $i === 0 ? 'opacity-100' : 'opacity-0' ?>"
                    data-project-carousel-slide
                    tabindex="0"
                    role="button"
                    aria-label="Mărește imaginea"
                >
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <img
            src="<?= e(normalize_image_url((string) ($project['image_url'] ?? ''))) ?>"
            alt="<?= e($project['title']) ?>"
            loading="lazy"
            class="js-lightbox h-56 w-full object-cover cursor-zoom-in"
            tabindex="0"
            role="button"
            aria-label="Mărește imaginea"
        >
    <?php endif; ?>

    <div class="p-4 flex flex-col flex-1">
        <p class="text-xs uppercase text-accent"><?= e($project['project_type']) ?></p>
        <h3 class="font-semibold mt-1"><?= e($project['title']) ?></h3>
        <a href="<?= url('/proiecte/detaliu?id=' . (int)$project['id']) ?>" class="text-sm text-zinc-300 mt-auto">Vezi proiect</a>
    </div>
</article>
