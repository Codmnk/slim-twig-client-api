<?php

namespace App\Controllers;


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

    
        // echo "<pre>";
        // var_dump($frmData);

        // FORM DATA AS BELOW
        // array(7) {
        //     ["firstName"]=>
        //     string(4) "PREM"
        //     ["lastName"]=>
        //     string(7) "ACHARYA"
        //     ["email"]=>
        //     string(22) "made_4_youuu@yahoo.com"
        //     ["contactNumber"]=>
        //     string(9) "450533936"
        //     ["orderNumber"]=>
        //     string(4) "9754"
        //     ["subject"]=>
        //     string(15) "General Enquiry"
        //     ["message"]=>
        //     string(11) "kjlfasjlfas"
        //   }
        

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
        
    }
}