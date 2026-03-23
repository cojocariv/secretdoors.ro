<a href="<?= url('/admin') ?>" class="text-sm">Inapoi</a>
<h1 class="text-2xl font-semibold mt-2 mb-4">Cabinet personal - Proiecte recente</h1>
<form method="post" action="<?= url('/admin/proiecte/save') ?>" class="grid md:grid-cols-2 gap-3 bg-white p-4 rounded-xl shadow mb-8">
    <input type="hidden" name="id" value="">
    <input name="title" placeholder="Titlu proiect" class="border rounded px-2 py-2" required>
    <select name="project_type" class="border rounded px-2 py-2" required>
        <option value="rezidential">rezidential</option>
        <option value="comercial">comercial</option>
    </select>
    <input name="summary" placeholder="Descriere proiect" class="border rounded px-2 py-2" required>
    <input name="position" placeholder="Pozitie (ordine afisare)" type="number" min="0" class="border rounded px-2 py-2" value="0">
    <input name="image_url" placeholder="URL imagine" class="border rounded px-2 py-2 md:col-span-2">
    <button class="bg-zinc-900 text-white px-3 py-2 rounded">Adauga proiect</button>
</form>

<h2 class="text-lg font-semibold mb-3">Proiecte existente</h2>
<?php foreach ($projects as $item): ?>
    <div class="bg-white p-4 rounded shadow mb-4">
        <form method="post" action="<?= url('/admin/proiecte/save') ?>" class="grid md:grid-cols-2 gap-3">
            <input type="hidden" name="id" value="<?= (int) $item['id'] ?>">
            <input name="title" value="<?= e($item['title']) ?>" class="border rounded px-2 py-2" required>
            <select name="project_type" class="border rounded px-2 py-2" required>
                <option value="rezidential" <?= ($item['project_type'] === 'rezidential') ? 'selected' : '' ?>>rezidential</option>
                <option value="comercial" <?= ($item['project_type'] === 'comercial') ? 'selected' : '' ?>>comercial</option>
            </select>
            <input name="summary" value="<?= e($item['summary']) ?>" class="border rounded px-2 py-2" required>
            <input name="position" value="<?= (int) ($item['position'] ?? 0) ?>" type="number" min="0" class="border rounded px-2 py-2">
            <input name="image_url" value="<?= e((string) ($item['image_url'] ?? '')) ?>" class="border rounded px-2 py-2 md:col-span-2">
            <div class="flex gap-4 items-center">
                <button class="bg-zinc-900 text-white px-3 py-2 rounded">Salveaza modificari</button>
            </div>
        </form>
        <form method="post" action="<?= url('/admin/proiecte/delete') ?>" class="mt-3">
            <input type="hidden" name="id" value="<?= (int) $item['id'] ?>">
            <button class="text-red-600 text-sm">Sterge proiectul</button>
        </form>
    </div>
<?php endforeach; ?>
