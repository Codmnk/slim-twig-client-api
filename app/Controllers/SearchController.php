<?php

namespace App\Controllers;


class SearchController extends Controller
{
    

    public function index($req, $res)
    {
       $str = $req->getParam('searchString');
       $str = strip_tags($str);
       $str = htmlentities($str);

       $result = $this->fetch->getSearchResult($str);

       return $this->view->render($res, 'contents/category.twig', array(
            'qnaData' => $result,
        ));
    }

   
}