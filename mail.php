<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/Exception.php';
require 'PHPMailer/SMTP.php';

function epostaGonder($alici,$konu,$mesaj)
{


$mail = new PHPMailer(true);


try {
    $mail->SMTPDebug = 0;			
    $mail->isSMTP();				
    $mail->Host       = 'mail.bariscangungor.com.tr';	
    $mail->SMTPAuth   = true;							
    $mail->Username   = 'fotograf-sitesi@bariscangungor.com.tr';			
    $mail->Password   = 'Deneme123';						
    $mail->SMTPSecure = 'tls';			
    $mail->Port       = 587;			
    $mail->setFrom('fotograf-sitesi@bariscangungor.com.tr', 'Fotoğraf Paylaşma Platformu'); 
	$mail->CharSet  = 'utf-8';
	
	$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);

    $mail->addAddress($alici); // Alıcı bilgileri
   
    $mail->isHTML(true); // html true text false
    $mail->Subject = $konu;
    $mail->Body    = $mesaj;

    $mail->send();
} catch (Exception $e) {
    $GLOBALS['msg']=  "Ops! Email iletilemedi. Hata: $mail->ErrorInfo";
}
}
?>