<div class="flex justify-between items-center mb-8">
    <h1 class="text-3xl font-semibold">Cabinet personal</h1>
    <form method="post" action="<?= url('/admin/logout') ?>"><button class="text-sm text-red-600">Logout</button></form>
</div>
<div class="grid md:grid-cols-4 gap-4">
    <a href="<?= url('/admin/produse') ?>" class="bg-white p-5 rounded-xl shadow">Produse</a>
    <a href="<?= url('/admin/produse') ?>" class="bg-white p-5 rounded-xl shadow">Poziții pagina Produse (/produse): adăugare, modificare, ordonare</a>
    <a href="<?= url('/admin/produse#featured-home') ?>" class="bg-white p-5 rounded-xl shadow">Alege produse pentru Home (Produse în evidență)</a>
    <a href="<?= url('/admin/proiecte') ?>" class="bg-white p-5 rounded-xl shadow">Proiecte recente: adăugare, modificare, poziții</a>
    <a href="<?= url('/admin/articole') ?>" class="bg-white p-5 rounded-xl shadow">Noutăți / Articole</a>
</div>
