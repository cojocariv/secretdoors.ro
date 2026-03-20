<a href="<?= url('/admin') ?>" class="text-sm">Inapoi</a>
<h1 class="text-2xl font-semibold mt-2 mb-4">Produse</h1>
<form method="post" action="<?= url('/admin/produse/save') ?>" class="grid md:grid-cols-2 gap-3 bg-white p-4 rounded-xl shadow mb-8">
    <select name="categorie_id" class="border rounded px-2 py-2"><?php foreach ($categories as $cat): ?><option value="<?= (int)$cat['id'] ?>"><?= e($cat['name']) ?></option><?php endforeach; ?></select>
    <input name="name" placeholder="Nume" class="border rounded px-2 py-2" required>
    <input name="short_description" placeholder="Descriere scurta" class="border rounded px-2 py-2" required>
    <input name="technical_specs" placeholder="Specificatii" class="border rounded px-2 py-2">
    <input name="price" placeholder="Pret" type="number" class="border rounded px-2 py-2" required>
    <input name="finish" placeholder="Finisaj" class="border rounded px-2 py-2">
    <input name="dimensions" placeholder="Dimensiuni" class="border rounded px-2 py-2">
    <input name="image_url" placeholder="URL imagine" class="border rounded px-2 py-2">
    <button class="bg-zinc-900 text-white px-3 py-2 rounded">Adauga</button>
</form>
<?php foreach ($products as $item): ?>
    <div class="bg-white p-3 rounded shadow mb-3 flex justify-between items-center">
        <div><?= e($item['name']) ?> - <?= number_format((float)$item['price'], 0, ',', '.') ?> RON</div>
        <form method="post" action="<?= url('/admin/produse/delete') ?>"><input type="hidden" name="id" value="<?= (int)$item['id'] ?>"><button class="text-red-600">Sterge</button></form>
    </div>
<?php endforeach; ?>
