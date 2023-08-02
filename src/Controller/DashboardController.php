<?php

namespace App\Controller;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class DashboardController extends Controller
{
    public function default(Request $request, Response $response)
    {
        $user_data = json_decode(file_get_contents(__DIR__ . '/../../data/user_data.json'), true);
        $fatture_emesse = json_decode(file_get_contents(__DIR__ . '/../../data/fatture_emesse.json'), true);
        $fatture_ricevute = json_decode(file_get_contents(__DIR__ . '/../../data/fatture_ricevute.json'), true);
        $clienti = json_decode(file_get_contents(__DIR__ . '/../../data/clienti.json'), true);
        $fornitori = json_decode(file_get_contents(__DIR__ . '/../../data/fornitori.json'), true);
        $prodotti = json_decode(file_get_contents(__DIR__ . '/../../data/prodotti.json'), true);
        $news = json_decode(file_get_contents(__DIR__ . '/../../data/news.json'), true);

        require_once __DIR__ . '/../../helpers/functions.php';

        $twig = $this->ci->get('templating');

        $twig->addFunction(new \Twig\TwigFunction('filter_by_status', 'filter_by_status'));
        $twig->addFunction(new \Twig\TwigFunction('calculate_total_price', 'calculate_total_price'));


        return $this->render($response, 'dashboard/dashboard.twig', [
            'user_data' => $user_data,
            'fatture_emesse' => $fatture_emesse,
            'fatture_ricevute' => $fatture_ricevute,
            'clienti' => count($clienti),
            'fornitori' => count($fornitori),
            'prodotti' => count($prodotti),
            'news' => $news
        ]);
    }
}