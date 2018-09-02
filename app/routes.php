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
$app->get('/contact-us', function($req, $res){
    return $this->view->render($res, 'contents/contact-forms/contact-us.twig');
});

// GET FORM DATA AND SEND EMAIL
$app->post('/sendmail', function($req, $res){
    // GET FORM DATAT
    $formData = $req->getParsedBody();
    
   
    // GET ATTACHEMENT NAMED 'attach'
    $attach = $req->getUploadedFiles();
    $newFile = $attach['attach'];

    if($newFile->getError() === UPLOAD_ERR_OK){
        //VALIDATE THE IMAGE AND PROCESS
    }else{
        array_push($formData, array('attachment' => false));
    }


    // $smtp = new Smtp();
    
    // $result = $smtp->sendMail($formData);
    // echo $result;

        // if(!$mail->send()) {
        //     $app->flash("error", "We're having trouble with our mail servers at the moment.  Please try again later, or contact us directly by phone.");
        //     error_log('Mailer Error: ' . $mail->errorMessage());
        //     $app->halt(500);
        // } 

});
