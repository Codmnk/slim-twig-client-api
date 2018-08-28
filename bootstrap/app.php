<?php


require '../vendor/autoload.php';

$app = new \Slim\App([
    'settings' => [
        'displayErrorDetails' => true,
    ]
]);


$container = $app->getContainer();

$container['view'] = function($container) {
    $view = new \Slim\Views\Twig(__DIR__ . '/../resources/views', [
        'cache' => false,
    ]);

    $view->addExtension(new \Slim\Views\TwigExtension(
        $container->router,
        $container->request->getUri()
    ));

    $filter = new Twig_SimpleFilter('htmlDecode', function ($string) {
        return html_entity_decode($string);
    });

    // $view = new Twig_Environment($view);
    // $view->addFilter($filter);
    

    return $view;
};

require '../app/routes.php';
