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
        $emailDat = $data;

        $smtp = new Smtp();
        $mail = new PHPMailer(true);

        
    try {
        //Server settings
        $mail->SMTPDebug = 2;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = $smtp->SMTP['host'];  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = $smtp->SMTP['Username'];                 // SMTP username
        $mail->Password = $smtp->SMTP['Password'];                           // SMTP password
        $mail->SMTPSecure = 'tsl';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = $smtp->SMTP['port']; // TCP port to connect to

        //Recipients
        $mail->setFrom($smtp->SMTP['Username'], $emailDat['firstName']);
        // $mail->setFrom($emailDat['email'], $emailDat['firstName'] . " " . $emailDat['lastName']);
        $mail->addAddress($smtp->SMTP['Username'], 'Web Form');     // Add a recipient
        // $mail->addAddress('ellen@example.com');               // Name is optional
        $mail->addReplyTo($emailDat['email'], $emailDat['firstName'] . " " . $emailDat['lastName']);
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');

        //Attachments
        // if($args->attach){
        //     // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        //     // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
        // }

        //Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $emailDat['subject'];
        $mail->Body    = $emailDat['message'];
        // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        // echo "<pre>";
        // var_dump($result);
        // die();

        return 'Success';
    } catch (Exception $e) {
        return "Message could not be sent. Mailer Error:  $mail->ErrorInfo";
        
    }
}
}