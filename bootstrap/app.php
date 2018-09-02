<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

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

    $twigEnv = $view->getEnvironment();
    $twigEnv->addFilter($filter);
    

    return $view;
};


$container['HomeController'] = function($container){
    return new \App\Controllers\HomeController($container);
};

$container['CategoryController'] = function($container){
    return new \App\Controllers\CategoryController($container);
};

require '../app/routes.php';
