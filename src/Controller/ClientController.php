<?php

namespace App\Controller;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Container\ContainerInterface;

class ClientController extends Controller
{
    public function __construct(ContainerInterface $ci)
    {
        parent::__construct($ci);
    }

    public function clients(Request $request, Response $response)
    {
        $clients_data = json_decode(file_get_contents(__DIR__ . '/../../data/clienti.json'), true);
        
        require_once __DIR__ . '/../../helpers/functions.php';

        $twig = $this->ci->get('templating');

        $twig->addFunction(new \Twig\TwigFunction('filter_by_status', 'filter_by_status'));
        $twig->addFunction(new \Twig\TwigFunction('calculate_total_price', 'calculate_total_price'));
        $twig->addFunction(new \Twig\TwigFunction('filtered_data', 'filtered_data'));

        return $this->render($response, 'clients/clients.twig', [
            'clients_data' => $clients_data,
        ]);
    }

    public function new_client(Request $request, Response $response)
    {
        $clients_data = json_decode(file_get_contents(__DIR__ . '/../../data/clienti.json'), true);
        
        require_once __DIR__ . '/../../helpers/functions.php';

        $twig = $this->ci->get('templating');

        $twig->addFunction(new \Twig\TwigFunction('filter_by_status', 'filter_by_status'));
        $twig->addFunction(new \Twig\TwigFunction('calculate_total_price', 'calculate_total_price'));
        $twig->addFunction(new \Twig\TwigFunction('filtered_data', 'filtered_data'));

        return $this->render($response, 'clients/clients.twig', [
            'clients_data' => $clients_data,
        ]);
    }
}
