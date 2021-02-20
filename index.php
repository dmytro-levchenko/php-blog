<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require __DIR__ . '/vendor/autoload.php';

// include twig
$loader = new FilesystemLoader('templates');
$view = new Environment($loader);
// include twig

$app = AppFactory::create();
$app->setBasePath("/php-blog");

$app->get('/', function (Request $request, Response $response, $args) use ($view) {
    $body = $view->render('index.twig');
    $response->getBody()->write($body);
    return $response;
});

$app->get('/about', function (Request $request, Response $response, $args) use ($view) {
    $body = $view->render('about.twig', [
        'name' => 'Dima'
    ]);
    $response->getBody()->write($body);
    return $response;
});

$app->get('/{url_key}', function (Request $request, Response $response, $args) use ($view) {
    $body = $view->render('post.twig', [
        'url_key' => $args['url_key']
    ]);
    $response->getBody()->write($body);
    return $response;
});



$app->run();