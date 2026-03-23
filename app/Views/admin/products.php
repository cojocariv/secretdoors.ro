<a href="<?= url('/admin') ?>" class="text-sm">Inapoi</a>
<h1 class="text-2xl font-semibold mt-2 mb-4">Cabinet personal - Produse</h1>
<form method="post" action="<?= url('/admin/produse/save') ?>" class="grid md:grid-cols-2 gap-3 bg-white p-4 rounded-xl shadow mb-8">
    <input type="hidden" name="id" value="">
    <select name="categorie_id" class="border rounded px-2 py-2" required>
        <?php foreach ($categories as $cat): ?>
            <option value="<?= (int) $cat['id'] ?>"><?= e($cat['name']) ?></option>
        <?php endforeach; ?>
    </select>
    <input name="name" placeholder="Denumire produs" class="border rounded px-2 py-2" required>
    <input name="short_description" placeholder="Descriere" class="border rounded px-2 py-2" required>
    <input name="price" placeholder="Pret" type="number" step="0.01" min="0" class="border rounded px-2 py-2" required>
    <input name="position" placeholder="Pozitie (ordine afisare)" type="number" min="0" class="border rounded px-2 py-2" value="0">
    <input name="technical_specs" placeholder="Specificatii" class="border rounded px-2 py-2">
    <input name="finish" placeholder="Finisaj" class="border rounded px-2 py-2">
    <input name="dimensions" placeholder="Dimensiuni" class="border rounded px-2 py-2">
    <input name="image_url" placeholder="URL imagine" class="border rounded px-2 py-2">
    <button class="bg-zinc-900 text-white px-3 py-2 rounded">Adauga produs</button>
</form>

<h2 class="text-lg font-semibold mb-3">Pozitii existente</h2>
<?php foreach ($products as $item): ?>
    <div class="bg-white p-4 rounded shadow mb-4">
        <form method="post" action="<?= url('/admin/produse/save') ?>" class="grid md:grid-cols-2 gap-3">
            <input type="hidden" name="id" value="<?= (int) $item['id'] ?>">
            <select name="categorie_id" class="border rounded px-2 py-2" required>
                <?php foreach ($categories as $cat): ?>
                    <option value="<?= (int) $cat['id'] ?>" <?= ((int) $item['categorie_id'] === (int) $cat['id']) ? 'selected' : '' ?>><?= e($cat['name']) ?></option>
                <?php endforeach; ?>
            </select>
            <input name="name" value="<?= e($item['name']) ?>" class="border rounded px-2 py-2" required>
            <input name="short_description" value="<?= e($item['short_description']) ?>" class="border rounded px-2 py-2" required>
            <input name="price" value="<?= e((string) $item['price']) ?>" type="number" step="0.01" min="0" class="border rounded px-2 py-2" required>
            <input name="position" value="<?= (int) ($item['position'] ?? 0) ?>" type="number" min="0" class="border rounded px-2 py-2">
            <input name="technical_specs" value="<?= e((string) ($item['technical_specs'] ?? '')) ?>" class="border rounded px-2 py-2">
            <input name="finish" value="<?= e((string) ($item['finish'] ?? '')) ?>" class="border rounded px-2 py-2">
            <input name="dimensions" value="<?= e((string) ($item['dimensions'] ?? '')) ?>" class="border rounded px-2 py-2">
            <input name="image_url" value="<?= e((string) ($item['image_url'] ?? '')) ?>" class="border rounded px-2 py-2">
            <div class="flex gap-4 items-center">
                <button class="bg-zinc-900 text-white px-3 py-2 rounded">Salveaza modificari</button>
            </div>
        </form>
        <form method="post" action="<?= url('/admin/produse/delete') ?>" class="mt-3">
            <input type="hidden" name="id" value="<?= (int) $item['id'] ?>">
            <button class="text-red-600 text-sm">Sterge pozitia</button>
        </form>
    </div>
<?php endforeach; ?>
