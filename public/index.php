<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use DI\Container;

require __dir__ . '/../vendor/autoload.php';

$container = new Container();

$container->set('templating', function() {
    return new Twig\Environment(
        new Twig\Loader\FilesystemLoader(__DIR__ . '/../templates')
    );
});

AppFactory::setContainer($container);

$app = AppFactory::create();

$app->get('/', '\App\Controller\DashboardController:default');
$app->get('/clients', '\App\Controller\ClientController:clients');
$app->get('/clients/new', '\App\Controller\ClientController:new_client');
$app->get('/clients/{id:[0-9]+}', '\App\Controller\ClientController:client_details');

$app->run();