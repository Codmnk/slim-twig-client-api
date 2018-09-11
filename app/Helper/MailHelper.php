<?php

namespace App\Helper;

use App\config\Smtp;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;



class MailHelper
{
    protected $emailDat;

    public function sendEmail($data)
    {
        $emailData = $data;

        $smtp = new Smtp();
		
        $mail = new PHPMailer(true);

      
    try {
        //Server settings
         $mail->SMTPDebug = 0;           // Enable verbose debug output
        $mail->isSMTP();                  // Set mailer to use SMTP
        $mail->Host = $smtp->SMTP['host'];  // Specify main and backup SMTP servers
        $mail->SMTPAuth = false;               // Enable SMTP authentication
        $mail->Username = $smtp->SMTP['username'];    // SMTP username
        $mail->Password = $smtp->SMTP['password'];        // SMTP password
        $mail->SMTPSecure = 'tsl';    // Enable TLS encryption, `ssl` also accepted
        $mail->Port = $smtp->SMTP['port']; // TCP port to connect to
     
        //Recipients
        $mail->setFrom($smtp->SMTP['username'], 'Web Form');
        $mail->addAddress($smtp->SMTP['username'], 'Customer Service');     // Add a recipient
        // $mail->addAddress('ellen@example.com');               // Name is optional
        $mail->addReplyTo($emailData['email'], $emailData['firstName'] . " " . $emailData['lastName']);
        //$mail->addReplyTo("help@bigdiscount.com.au", "Premo");
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');

        //Attachments
        // if($args->attach){
        //     // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        //     // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
        // }

        //Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $emailData['subject'];
        //$mail->Body    = $emailData['message'];
        $mail->Body    = $emailData['message'];
        $mail->AltBody = strip_tags($emailData['message']);
		
        $mail->send();
        
        return 'Success';
    } catch (Exception $e) {
        return "Message could not be sent. Mailer Error:  $mail->ErrorInfo";
        
    }
}
}
