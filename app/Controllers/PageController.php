<?php
declare(strict_types=1);

class PageController extends Controller
{
    public function about(): void
    {
        $this->render('pages/about', ['title' => 'Despre noi']);
    }
}
