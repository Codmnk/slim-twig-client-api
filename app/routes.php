<?php
use App\Models\Fetch;



$app->get('/', function($req, $res){
    $fetch = new Fetch();
   $categories = $fetch->getCategories();
   $categories = json_decode($categories);
   
   return $this->view->render($res, 'contents/index.twig', array(
       'catData' => $categories
   ));
});

$app->get('/home', function($req, $res){
    $fetch = new Fetch();
    $catData = $fetch->getCategories();
    
    $catData = json_decode($catData);
    

    return $this->view->render($res, 'contents/category.twig', array(
      'qnaData' => $catData
    ));
});