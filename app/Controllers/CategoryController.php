<?php

namespace App\Controllers;


use App\config\Smtp;

class CategoryController extends Controller
{
    

    public function index($req, $res, $args)
    {

        $slug = $args["uri"];
        

        // GET BANNER IMAGE URI
         echo $catInfo = $this->fetch->getThumbnail($slug);
        
        $catData = $this->fetch->getQNA($slug);

        return $this->view->render($res, 'contents/category.twig', array(
            'qnaData' => $catData,
            'catInfo' => $catInfo
        ));
    }
}