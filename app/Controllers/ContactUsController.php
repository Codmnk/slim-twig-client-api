<?php

namespace App\Controllers;

use Respect\Validation\Validator as v;
use App\config\Smtp;

class ContactUsController extends Controller
{
    
    public function index($req, $res)
    {
        return $this->view->render($res, 'contents/contact-forms/contact-us.twig');        
    }

    public function sendMail($req, $res)
    {
        $frmData = $req->getParams();

        $validation = $this->validator->validate($req, [
            'firstName' => v::notEmpty()->alpha(),
            'lastName' => v::notEmpty()->alpha(),
            'email' => v::noWhitespace()->notEmpty()->email(),
            'contactNumber' => v::optional(v::intVal()),
            'orderNumber' => v::optional(v::intVal()),
            'subject' => v::notEmpty(),
            'message' => v::notEmpty()
        ]);

        if($validation->validationFailed()){
            return $res->withRedirect($this->router->pathFor('contact-us'));
        }

        // // GET ATTACHEMENT NAMED 'attach'
        // $attach = $req->getUploadedFiles();
        // $newFile = $attach['attach'];

        // if($newFile->getError() === UPLOAD_ERR_OK){
        //     //VALIDATE THE IMAGE AND PROCESS
        // }else{
        //     array_push($formData, array('attachment' => false));
        // }
        
        // $smtp = new Smtp();
    
    // $result = $smtp->sendMail($formData);
    // echo $result;

        // if(!$mail->send()) {
        //     $app->flash("error", "We're having trouble with our mail servers at the moment.  Please try again later, or contact us directly by phone.");
        //     error_log('Mailer Error: ' . $mail->errorMessage());
        //     $app->halt(500);
        // } 

        
        $this->flash->addMessage('info', 'Your message has been sent, we will get back to you with in 24 -48 hours.');

        return $res->withRedirect($this->router->pathFor('contact-us'));
        
    }

    
}