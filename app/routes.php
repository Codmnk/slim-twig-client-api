<?php
use App\Models\Fetch;


// HOME PAGE WITH THE CATEGORIES CARD
$app->get('/', function($req, $res){
    $fetch = new Fetch();
   $categories = $fetch->getCategories();
//    $categories = json_decode($categories);
   
   return $this->view->render($res, 'contents/index.twig', array(
       'catData' => $categories
   ));
});


$app->get('/category/{s}', function($req, $res){
    $slug = $req->getAttribute('s');

    $fetch = new Fetch();

    // GET BANNER IMAGE URI
    $catInfo = $fetch->getThumbnail($slug);
    
    $catData = $fetch->getQNA($slug);

    return $this->view->render($res, 'contents/category.twig', array(
      'qnaData' => $catData,
      'catInfo' => $catInfo
    ));
});

// CONTACT US PAGE
$app->get('/contact-us', function($req, $res){
    return $this->view->render($res, 'contents/contact-forms/contact-us.twig');
});

// GET FORM DATA AND SEND EMAIL
$app->post('/sendmail', function($req, $res){
    return "form received";
});
