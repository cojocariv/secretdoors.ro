<footer class="border-t border-zinc-800 mt-20">
    <div class="max-w-7xl mx-auto px-4 py-12 grid md:grid-cols-3 gap-8 text-sm text-zinc-300">
        <div>
            <p class="font-semibold text-zinc-100">Secret Doors</p>
            <p class="mt-3"><?= e(site_contact('address')) ?></p>
        </div>
        <div>
            <p><a href="tel:<?= e(site_contact('phone')) ?>"><?= e(site_contact('phone_display')) ?></a></p>
            <p><a href="mailto:<?= e(site_contact('email')) ?>"><?= e(site_contact('email')) ?></a></p>
        </div>
        <div class="flex gap-4">
            <a href="<?= e(site_contact('instagram')) ?>" target="_blank" rel="noreferrer">Instagram</a>
            <a href="<?= e(site_contact('tiktok')) ?>" target="_blank" rel="noreferrer">TikTok</a>
        </div>
    </div>
</footer>
