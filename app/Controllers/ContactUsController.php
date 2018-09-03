<?php

namespace App\Controllers;

use Respect\Validation\Validator as v;
use App\Helper\MailHelper as mailHelper; 

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
        
        
        $result = mailHelper::sendEmail($frmData);

        if($result === 'Success'){
            $this->flash->addMessage('info', 'Your message has been sent, we will get back to you with in 24 -48 hours.');
        }else{
            $this->flash->addMessage('error', $result . " Please try again later, or send an email to help@bigdiscount.com.au.");
        }
        
        return $res->withRedirect($this->router->pathFor('contact-us'));
        
    }

    
}