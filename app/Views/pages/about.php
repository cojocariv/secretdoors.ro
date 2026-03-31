<section class="max-w-6xl mx-auto px-4 py-16">
    <?php
    $googleReviews = is_array($googleReviews ?? null) ? $googleReviews : [];
    $googleRating = isset($googleRating) ? (float) $googleRating : null;
    $googleRatingTotal = isset($googleRatingTotal) ? (int) $googleRatingTotal : 0;
    $googlePlaceName = trim((string) ($googlePlaceName ?? 'Secret Doors Premium'));
    $googleReviewsEnabled = !empty($googleReviewsEnabled);
    $googleReviewsError = trim((string) ($googleReviewsError ?? ''));
    ?>

    <h1 class="text-4xl font-semibold">Despre noi</h1>
    <p class="mt-6 text-zinc-300 max-w-3xl">
        Secret Doors produce uși filomuro și sisteme uși invizibile la comandă, pentru design interior modern.
        Punem accent pe uși ascunse în perete, uși invizibile cu balamale ascunse și toc ascuns aluminiu, potrivite atât pentru apartamente, cât și pentru birouri în București / România.
    </p>

    <div class="grid md:grid-cols-3 gap-6 mt-10">
        <div class="bg-zinc-900 border border-zinc-800 rounded-xl p-6">
            <h3 class="font-semibold">Avantaje competitive</h3>
            <p class="text-zinc-400 mt-2">Producție locală, uși premium interior la comandă, montaj uși filomuro asistat.</p>
        </div>
        <div class="bg-zinc-900 border border-zinc-800 rounded-xl p-6">
            <h3 class="font-semibold">Proces de producție</h3>
            <p class="text-zinc-400 mt-2">Consultanță, proiectare, fabricație, livrare și instalare plintă ascunsă / profile LED perete.</p>
        </div>
        <div class="bg-zinc-900 border border-zinc-800 rounded-xl p-6">
            <h3 class="font-semibold">Calitate premium</h3>
            <p class="text-zinc-400 mt-2">Materiale verificate, uși filomuro fără pervaz și finisaje MDF, cornișă ascunsă.</p>
        </div>
    </div>

    <div class="mt-14">
        <div class="flex items-center justify-between gap-4 flex-wrap">
            <h2 class="text-2xl font-semibold">Recenzii Google</h2>
            <?php if ($googleRating !== null): ?>
                <p class="text-zinc-300 text-sm">
                    <span class="text-white font-semibold"><?= e(number_format($googleRating, 1, ',', '.')) ?></span>
                    / 5 (<?= e((string) $googleRatingTotal) ?> recenzii)
                </p>
            <?php endif; ?>
        </div>

        <?php if (!empty($googleReviews)): ?>
            <?php
            $shownReviewsCount = count($googleReviews);
            $allReviewsUrl = 'https://www.google.com/search?tbm=lcl&q=' . rawurlencode($googlePlaceName . ' recenzii');
            ?>
            <div class="mt-2 flex items-center justify-between gap-3 flex-wrap">
                <p class="text-zinc-400 text-sm">
                    Sincronizat automat din Google pentru <?= e($googlePlaceName) ?>.
                    <?php if ($googleRatingTotal > $shownReviewsCount): ?>
                        API-ul Google afișează aici doar recenziile principale (<?= e((string) $shownReviewsCount) ?> din <?= e((string) $googleRatingTotal) ?>).
                    <?php endif; ?>
                </p>
                <?php if ($googleRatingTotal > $shownReviewsCount): ?>
                    <a
                        href="<?= e($allReviewsUrl) ?>"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="inline-flex items-center gap-2 text-sm px-3 py-1.5 rounded-lg border border-zinc-700 text-zinc-200 hover:border-accent/60 hover:text-accent transition"
                    >
                        Vezi toate recenziile pe Google
                    </a>
                <?php endif; ?>
            </div>
            <div class="grid md:grid-cols-3 gap-6 mt-6">
                <?php foreach ($googleReviews as $review): ?>
                    <?php
                    $author = trim((string) ($review['author_name'] ?? 'Client'));
                    $rating = max(1, min(5, (int) ($review['rating'] ?? 5)));
                    $reviewText = trim((string) ($review['text'] ?? ''));
                    $timeLabel = trim((string) ($review['relative_time_description'] ?? ''));
                    ?>
                    <article class="bg-zinc-900 border border-zinc-800 rounded-xl p-6 h-full">
                        <div class="flex items-center justify-between gap-3">
                            <h3 class="font-semibold text-zinc-100"><?= e($author) ?></h3>
                            <span class="text-accent text-sm" aria-label="<?= e((string) $rating) ?> stele"><?= str_repeat('★', $rating) ?></span>
                        </div>
                        <?php if ($timeLabel !== ''): ?>
                            <p class="text-zinc-500 text-xs mt-1"><?= e($timeLabel) ?></p>
                        <?php endif; ?>
                        <?php if ($reviewText !== ''): ?>
                            <p class="text-zinc-300 mt-4 leading-7"><?= e($reviewText) ?></p>
                        <?php else: ?>
                            <p class="text-zinc-500 mt-4 leading-7">Recenzie fără text.</p>
                        <?php endif; ?>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="mt-6 bg-zinc-900 border border-zinc-800 rounded-xl p-6">
                <p class="text-zinc-300">
                    Recenziile Google nu pot fi încărcate momentan.
                    <?php if ($googleReviewsError !== ''): ?>
                        <span class="text-zinc-500 text-sm block mt-2"><?= e($googleReviewsError) ?></span>
                    <?php endif; ?>
                </p>
            </div>
        <?php endif; ?>
    </div>
</section>
