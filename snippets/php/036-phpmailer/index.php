<?php

include "./vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

//Typical mail data
$mail->AddAddress("client@to.com", "client");
$mail->SetFrom("webadmin@from.com", "webadmin");
$mail->Subject = "My Subject";
$mail->Body = "Mail contents";

try{
    $mail->Send();
    echo "Success!";
} catch(Exception $e){
    echo "Fail - " . $mail->ErrorInfo;
}
