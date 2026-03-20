<a href="<?= url('/admin') ?>" class="text-sm">Inapoi</a>
<h1 class="text-2xl font-semibold mt-2 mb-4">Proiecte</h1>
<form method="post" action="<?= url('/admin/proiecte/save') ?>" class="grid md:grid-cols-2 gap-3 bg-white p-4 rounded-xl shadow mb-8">
    <input name="title" placeholder="Titlu" class="border rounded px-2 py-2" required>
    <input name="project_type" placeholder="rezidential/comercial" class="border rounded px-2 py-2" required>
    <input name="summary" placeholder="Descriere" class="border rounded px-2 py-2" required>
    <input name="image_url" placeholder="URL imagine" class="border rounded px-2 py-2">
    <button class="bg-zinc-900 text-white px-3 py-2 rounded">Adauga</button>
</form>
<?php foreach ($projects as $item): ?>
    <div class="bg-white p-3 rounded shadow mb-3 flex justify-between items-center">
        <div><?= e($item['title']) ?></div>
        <form method="post" action="<?= url('/admin/proiecte/delete') ?>"><input type="hidden" name="id" value="<?= (int)$item['id'] ?>"><button class="text-red-600">Sterge</button></form>
    </div>
<?php endforeach; ?>
