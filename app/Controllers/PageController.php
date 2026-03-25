<?php
declare(strict_types=1);

class PageController extends Controller
{
    public function about(): void
    {
        $this->render('pages/about', [
            'title' => 'Despre noi',
            'metaTitle' => 'Despre noi: producător uși filomuro & uși invizibile | Secret Doors Premium',
            'metaDescription' => 'Suntem producător uși filomuro și uși invizibile personalizate pentru apartament și birouri în București. Soluții moderne pereți, montaj uși filomuro, plintă ascunsă și profile aluminiu interior.',
        ]);
    }
}
