<a href="<?= url('/admin') ?>" class="text-sm">Inapoi</a>
<h1 class="text-2xl font-semibold mt-2 mb-4">Articole</h1>
<form method="post" action="<?= url('/admin/articole/save') ?>" class="grid md:grid-cols-2 gap-3 bg-white p-4 rounded-xl shadow mb-8">
    <input name="title" placeholder="Titlu" class="border rounded px-2 py-2" required>
    <input name="excerpt" placeholder="Excerpt" class="border rounded px-2 py-2" required>
    <textarea name="body" placeholder="Continut" class="border rounded px-2 py-2 md:col-span-2" rows="4" required></textarea>
    <input name="cover_image" placeholder="URL imagine" class="border rounded px-2 py-2 md:col-span-2">
    <button class="bg-zinc-900 text-white px-3 py-2 rounded">Adauga</button>
</form>
<?php foreach ($articles as $item): ?>
    <div class="bg-white p-3 rounded shadow mb-3 flex justify-between items-center">
        <div><?= e($item['title']) ?></div>
        <form method="post" action="<?= url('/admin/articole/delete') ?>"><input type="hidden" name="id" value="<?= (int)$item['id'] ?>"><button class="text-red-600">Sterge</button></form>
    </div>
<?php endforeach; ?>
