<?php

namespace App\Middleware;

class PresistDataMiddleware extends Middleware
{

    public function __invoke($req, $res, $next)
    {
        $this->container->view->getEnvironment()->addGlobal('oldData', $_SESSION['oldData']);
        $_SESSION['oldData'] = $req->getParams();
        
        $res = $next($req, $res);
        return $res;
    }
}