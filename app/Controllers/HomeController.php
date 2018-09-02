<?php

namespace App\Controllers;


use App\config\Smtp;

class HomeController extends Controller
{
    

    public function index($req, $res)
    {
        $categories = $this->fetch->getCategories();

        return $this->view->render($res, 'contents/index.twig', array(
            'catData' => $categories
        ));
    }

   
}