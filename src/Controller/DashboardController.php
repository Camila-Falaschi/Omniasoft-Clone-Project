<?php

namespace App\Controller;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class DashboardController extends Controller
{
    public function default(Request $request, Response $response)
    {
        $html = $this->ci->get('templating')->render('dashboard.twig');
        $response->getBody()->write($html);
        return $response;
    }
}