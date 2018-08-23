<?php

$app->get('/home', function($req, $res){
    return $this->view->render($res, 'contents/category.twig', array(postdata =>[ a => 'sfasf']));
});