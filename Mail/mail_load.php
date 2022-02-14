<?php

/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';

function sendMail($emailName,$recipientAddress, $recipientName,$subject,$message,&$error = null): bool{
    global $mailSection;
    $mail = new PHPMailer(true);
    try{
        if ($mailSection["debugMode"]){
            $mail->SMTPDebug = SMTP::DEBUG_SERVER; //Enable verbose debug output Only open for debug purpose
        }
        $mail->isSMTP(); //Send using SMTP
        $mail->Host = $mailSection["host"]; //Set the smtp server to send through
        $mail->SMTPAuth = true; //Enable SMTP authentication
        $mail->Username= $mailSection["username"]; //SMTP Username
        $mail->Password = $mailSection["password"]; //SMTP Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; //Enable TLS encryption
        $mail->Port = $mailSection["port"];
        $mail->setFrom($mailSection["username"],$emailName);
        $mail->addAddress($recipientAddress, $recipientName);
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->msgHTML($message, __DIR__);
        if (!$mail->send()){
            $error = $mail->ErrorInfo;
            return false;
        }else{
            return true;
        }
    } catch (Exception $ex) {
        $error = $mail->ErrorInfo;
        return false;
    }
    
}
