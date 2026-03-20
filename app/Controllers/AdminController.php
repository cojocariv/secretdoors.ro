<?php
declare(strict_types=1);

class AdminController extends Controller
{
    private function guard(): void
    {
        if (!is_admin()) {
            $this->redirect('/admin/login');
        }
    }

    public function loginForm(): void
    {
        $this->render('admin/login', ['title' => 'Admin Login'], 'admin');
    }

    public function login(): void
    {
        if (($_POST['username'] ?? '') === ADMIN_USER && ($_POST['password'] ?? '') === ADMIN_PASS) {
            $_SESSION['admin_logged'] = true;
            $this->redirect('/admin');
        }
        $_SESSION['flash'] = 'Credentiale invalide.';
        $this->redirect('/admin/login');
    }

    public function logout(): void
    {
        unset($_SESSION['admin_logged']);
        $this->redirect('/admin/login');
    }

    public function dashboard(): void
    {
        $this->guard();
        $this->render('admin/dashboard', ['title' => 'Dashboard'], 'admin');
    }

    public function products(): void
    {
        $this->guard();
        $this->render('admin/products', [
            'title' => 'Admin Produse',
            'products' => (new Product())->all(),
            'categories' => (new Category())->all(),
        ], 'admin');
    }

    public function projects(): void
    {
        $this->guard();
        $this->render('admin/projects', ['title' => 'Admin Proiecte', 'projects' => (new Project())->all()], 'admin');
    }

    public function articles(): void
    {
        $this->guard();
        $this->render('admin/articles', ['title' => 'Admin Articole', 'articles' => (new Article())->all()], 'admin');
    }

    public function saveProduct(): void
    {
        $this->guard();
        $db = Database::getInstance();
        $stmt = $db->prepare("INSERT INTO produse (categorie_id, name, slug, short_description, technical_specs, price, finish, dimensions, image_url) VALUES (:categorie_id, :name, :slug, :short_description, :technical_specs, :price, :finish, :dimensions, :image_url)");
        $stmt->execute([
            'categorie_id' => (int) $_POST['categorie_id'],
            'name' => $_POST['name'],
            'slug' => strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $_POST['name']))),
            'short_description' => $_POST['short_description'],
            'technical_specs' => $_POST['technical_specs'],
            'price' => (float) $_POST['price'],
            'finish' => $_POST['finish'],
            'dimensions' => $_POST['dimensions'],
            'image_url' => $_POST['image_url'],
        ]);
        $this->redirect('/admin/produse');
    }

    public function deleteProduct(): void
    {
        $this->guard();
        $stmt = Database::getInstance()->prepare("DELETE FROM produse WHERE id = :id");
        $stmt->execute(['id' => (int) $_POST['id']]);
        $this->redirect('/admin/produse');
    }

    public function saveProject(): void
    {
        $this->guard();
        $stmt = Database::getInstance()->prepare("INSERT INTO proiecte (title, slug, summary, project_type, image_url, gallery_json) VALUES (:title, :slug, :summary, :project_type, :image_url, :gallery_json)");
        $stmt->execute([
            'title' => $_POST['title'],
            'slug' => strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $_POST['title']))),
            'summary' => $_POST['summary'],
            'project_type' => $_POST['project_type'],
            'image_url' => $_POST['image_url'],
            'gallery_json' => json_encode([$_POST['image_url']], JSON_THROW_ON_ERROR),
        ]);
        $this->redirect('/admin/proiecte');
    }

    public function deleteProject(): void
    {
        $this->guard();
        $stmt = Database::getInstance()->prepare("DELETE FROM proiecte WHERE id = :id");
        $stmt->execute(['id' => (int) $_POST['id']]);
        $this->redirect('/admin/proiecte');
    }

    public function saveArticle(): void
    {
        $this->guard();
        $title = $_POST['title'];
        $stmt = Database::getInstance()->prepare("INSERT INTO articole (title, slug, excerpt, body, cover_image) VALUES (:title, :slug, :excerpt, :body, :cover_image)");
        $stmt->execute([
            'title' => $title,
            'slug' => strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title))),
            'excerpt' => $_POST['excerpt'],
            'body' => $_POST['body'],
            'cover_image' => $_POST['cover_image'],
        ]);
        $this->redirect('/admin/articole');
    }

    public function deleteArticle(): void
    {
        $this->guard();
        $stmt = Database::getInstance()->prepare("DELETE FROM articole WHERE id = :id");
        $stmt->execute(['id' => (int) $_POST['id']]);
        $this->redirect('/admin/articole');
    }
}
