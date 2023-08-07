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
        
        return $this->render($response, 'clients/clients.twig', [
            'clients_data' => $clients_data,
        ]);
    }

    public function new_client(Request $request, Response $response)
    {
        $json_path = __DIR__ . '/../../data/clienti.json';
        $clients_data = json_decode(file_get_contents($json_path), true);

        if ($request->getMethod() === 'POST') {
            $new_client_data = [
                'name' => $request->getParsedBody('paramName'),
                'email' => $request->getParsedBody('paramName'),
            ];
    
            $clients_data[] = $new_client_data;
    
            file_put_contents($json_path, json_encode($clients_data, JSON_PRETTY_PRINT));
    
            return $this->render($response, 'clients/clients.twig', [
                'message' => 'Novo cliente adicionado com sucesso!',
            ]);
        }
    
        return $this->render($response, 'clients/new_client.twig');
    }

    public function client_details(Request $request, Response $response)
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
