<section class="max-w-7xl mx-auto px-4 py-12">
    <h1 class="text-3xl font-semibold mb-6">Proiecte</h1>
    <div class="flex gap-3 mb-8">
        <a class="px-4 py-2 border border-zinc-700 rounded-full text-sm" href="<?= url('/proiecte') ?>">Toate</a>
        <a class="px-4 py-2 border border-zinc-700 rounded-full text-sm" href="<?= url('/proiecte?type=rezidential') ?>">Rezidențial</a>
        <a class="px-4 py-2 border border-zinc-700 rounded-full text-sm" href="<?= url('/proiecte?type=comercial') ?>">Comercial</a>
    </div>
    <div class="columns-1 md:columns-3 gap-6">
        <?php foreach ($projects as $project): ?>
            <?php require __DIR__ . '/../components/project-card.php'; ?>
        <?php endforeach; ?>
    </div>
</section>
