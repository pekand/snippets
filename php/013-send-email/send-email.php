<?php

/*
setup gmail account for less csecure apps: https://myaccount.google.com/lesssecureapps
*/

include __DIR__.'/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$options = array(
	"debugMode" => false,
    "gmail" => array(
        "username" => "",
        "password" => "",
    ),
    "mail" => array(
        "from" => "",
        "to" => "",
    ),
);


$optionsFile = "options.json";
if (file_exists($optionsFile)) {
    $options = array_merge($options, json_decode(file_get_contents($optionsFile), true));
}

$debugMode = $options['debugMode'];
$username = $options['gmail']['username'];
$password = $options['gmail']['password'];
$from = $options['mail']['from'];
$to = $options['mail']['to'];

$mail = new PHPMailer(true);

if($debugMode) {
	$mail->SMTPDebug = SMTP::DEBUG_SERVER;
}

$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = $username;
$mail->Password = $password;                           
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;                           
$mail->Port = 587;

$mail->setFrom($from, 'Mailer');
$mail->addAddress($to, 'pekand');

$mail->addAttachment('attachment.png', 'screenshot');    


$mail->isHTML(true);

$mail->Subject = 'Test message from php';
$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}