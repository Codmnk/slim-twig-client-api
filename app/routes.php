<?php
// use App\Models\Fetch;
use App\config\Smtp;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true); 

// HOME PAGE WITH THE CATEGORIES CARDS
$app->get('/', 'HomeController:index');

// SINGLE CATEGORY PAGE WITH LIST OF QUESTI AND ANSWERS
$app->get('/category/[{uri}]', 'CategoryController:index');

// CONTACT US PAGE
$app->get('/contact-us', 'ContactUsController:index')->setName('contact-us');

// GET FORM DATA AND SEND EMAIL
$app->post('/sendmail', 'ContactUsController:sendMail');


//HANDLE THE SEAERCH FORM REQUEST
$app->post('/search', 'SearchController:index')->setName('search');