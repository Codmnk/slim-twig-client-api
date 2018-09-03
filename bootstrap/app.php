<?php
session_start();

require '../vendor/autoload.php';

$app = new \Slim\App([
    'settings' => [
        'displayErrorDetails' => true,
    ]
]);


$container = $app->getContainer();

$container['flash'] = function ($container) {
    return new \Slim\Flash\Messages();
};

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

    $view->getEnvironment()->addGlobal('flash', $container->flash);
    

    return $view;
};


$container['validator'] = function($container){
     return new App\Validation\Validator;
};

$container['HomeController'] = function($container){
    return new \App\Controllers\HomeController($container);
};

$container['CategoryController'] = function($container){
    return new \App\Controllers\CategoryController($container);
};

$container['ContactUsController'] = function($container){
    return new \App\Controllers\ContactUsController($container);
};

$container['csrf'] = function($container){
    return new \Slim\Csrf\Guard;
};

$app->add(new \App\Middleware\validationErrorsMiddleware($container));
$app->add(new \App\Middleware\PresistDataMiddleware($container));
$app->add(new \App\Middleware\CsrfViewMiddleware($container));

$app->add($container->csrf);



require '../app/routes.php';
