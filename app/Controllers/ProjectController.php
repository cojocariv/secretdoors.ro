<?php
declare(strict_types=1);

class ProjectController extends Controller
{
    public function index(): void
    {
        $type = $_GET['type'] ?? null;
        $metaTitle = 'Proiecte moderne: uși ascunse & uși invizibile | Secret Doors Premium';
        $metaDescription = 'Proiecte cu design interior modern pentru București: uși integrate în perete, soluții moderne pereți și montaj uși filomuro. Arhitectură modernă interior.';
        $this->render('pages/projects', [
            'title' => 'Proiecte',
            'metaTitle' => $metaTitle,
            'metaDescription' => $metaDescription,
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
        $summary = (string) ($project['summary'] ?? '');
        $this->render('pages/project-detail', [
            'title' => $project['title'],
            'project' => $project,
            'metaTitle' => $project['title'] . ' | Secret Doors Premium',
            'metaDescription' => $summary !== ''
                ? $summary
                : 'Proiect modern cu uși ascunse, uși invizibile și sisteme filomuro.',
        ]);
    }
}
