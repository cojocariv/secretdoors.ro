<?php
declare(strict_types=1);

class ProjectController extends Controller
{
    public function index(): void
    {
        $type = $_GET['type'] ?? null;
        $this->render('pages/projects', [
            'title' => 'Proiecte',
            'projects' => (new Project())->all($type),
            'type' => $type,
        ]);
    }

    public function show(): void
    {
        $project = (new Project())->find((int) ($_GET['id'] ?? 0));
        if (!$project) {
            $this->redirect('/proiecte');
        }
        $this->render('pages/project-detail', ['title' => $project['title'], 'project' => $project]);
    }
}
