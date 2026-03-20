<div class="max-w-md mx-auto mt-20 bg-white rounded-xl p-6 shadow">
    <h1 class="text-2xl font-semibold mb-4">Admin Login</h1>
    <?php if (!empty($_SESSION['flash'])): ?><p class="text-red-600 mb-4"><?= e($_SESSION['flash']); unset($_SESSION['flash']); ?></p><?php endif; ?>
    <form method="post" action="<?= url('/admin/login') ?>" class="space-y-4">
        <input name="username" class="w-full border rounded-lg px-3 py-2" placeholder="Username">
        <input name="password" type="password" class="w-full border rounded-lg px-3 py-2" placeholder="Parola">
        <button class="w-full bg-zinc-900 text-white py-2 rounded-lg">Autentificare</button>
    </form>
</div>
