<?php

namespace App\Controllers;

use Slim\Http\UploadedFile;
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
        // GET FILE DATA
        $frmData = $req->getParams();

        
        // GET ATTACHEMENT NAMED 'attach'
        $uploadedFiles = $req->getUploadedFiles();
        $newFile = $uploadedFiles['attach'];

        $validation = $this->validator->validate($req, [
            'firstName' => v::notEmpty()->alpha(),
            'lastName' => v::notEmpty()->alpha(),
            'email' => v::noWhitespace()->notEmpty()->email(),
            'contactNumber' => v::optional(v::intVal()),
            'orderNumber' => v::optional(v::intVal()),
            'subject' => v::notEmpty(),
            'message' => v::notEmpty(),
            // 'attach' => v::optional(v::file()->validate(__FILE__)),
            // 'attach' => v::optional(v::size('5B', '15MB')->validate($req->getUploadedFiles()['attach']))
        ]);

        if($validation->validationFailed()){
            return $res->withRedirect($this->router->pathFor('contact-us'));
        }


        if($newFile->getError() === UPLOAD_ERR_OK){
            $uploadDir = __DIR__ . '/../../public/frontEnd/uploads/images/emails/' . $newFile->getClientFilename();
            $tempFile = $_FILES["attach"]["tmp_name"];
            
            $filename = move_uploaded_file($tempFile, $uploadDir);
            if($filename){
                $frmData["attach"] = $newFile->getClientFilename();
            }else {
                $frmData["attach"] = null;
            }

        }else{
            var_dump($frmData->getError());
        }
        
        
        $result = mailHelper::sendEmail($frmData);

        if($result === 'Success'){
            $this->flash->addMessage('info', 'Your message has been sent, we will get back to you with in 24 -48 hours.');
        }else{
            $this->flash->addMessage('error', $result . " Please try again later, or send an email to help@bigdiscount.com.au.");
        }
        
        return $res->withRedirect($this->router->pathFor('contact-us'));
        
    }

    
}