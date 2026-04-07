<section class="max-w-7xl mx-auto px-4 py-12 grid md:grid-cols-2 gap-10">
    <div>
        <h1 class="text-3xl font-semibold">Contact</h1>
        <p class="text-zinc-300 mt-4 leading-7">
            Pentru ofertă și preț uși invizibile / uși ascunse: uși filomuro fără pervaz, uși invizibile cu toc ascuns aluminiu și balamale ascunse uși în București, România.
        </p>
        <p class="text-zinc-300 mt-4"><?= e(site_contact('address')) ?></p>
        <p class="mt-2"><a href="tel:<?= e(site_contact('phone')) ?>"><?= e(site_contact('phone_display')) ?></a></p>
        <p><a href="mailto:<?= e(site_contact('email')) ?>"><?= e(site_contact('email')) ?></a></p>
        <div class="mt-6 aspect-video rounded-xl overflow-hidden border border-zinc-700">
            <iframe class="w-full h-full" loading="lazy" src="<?= e(site_contact('google_maps_embed')) ?>"></iframe>
        </div>
    </div>
    <div id="formular-contact" class="bg-zinc-900 p-6 rounded-2xl border border-zinc-800 scroll-mt-24">
        <?php if (!empty($_SESSION['flash'])): ?><p class="text-accent mb-4"><?= e($_SESSION['flash']); unset($_SESSION['flash']); ?></p><?php endif; ?>
        <?php $prefillContactMessage = $prefillContactMessage ?? ''; ?>
        <form method="post" action="<?= url('/contact') ?>" class="space-y-4">
            <input required name="name" placeholder="Nume" class="w-full bg-zinc-800 border border-zinc-700 rounded-lg px-3 py-2">
            <input required type="email" name="email" placeholder="Email" class="w-full bg-zinc-800 border border-zinc-700 rounded-lg px-3 py-2">
            <input name="phone" placeholder="Telefon" class="w-full bg-zinc-800 border border-zinc-700 rounded-lg px-3 py-2">
            <textarea required name="message" placeholder="Mesaj" rows="5" class="w-full bg-zinc-800 border border-zinc-700 rounded-lg px-3 py-2"><?= e($prefillContactMessage) ?></textarea>
            <button class="bg-accent text-zinc-950 px-5 py-3 rounded-lg">Trimite mesaj</button>
        </form>
    </div>
</section>
