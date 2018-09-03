<?php

namespace App\Middleware;

class ValidationErrorsMiddleware extends Middleware
{

    public function __invoke($req, $res, $next)
    {
        
        $this->container->view->getEnvironment()->addGlobal('errors', $_SESSION['errors']);
        $_SESSION['errors'] = [];
        // unset($_SESSION['errors']);
        
        $res = $next($req, $res);
        return $res;
    }
}