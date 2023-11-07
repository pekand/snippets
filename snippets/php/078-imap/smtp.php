<?php
// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

include "config.php";

// Create a new PHPMailer instance
$mail = new PHPMailer(true);

try {
    // SMTP server configuration
    $mail->isSMTP();
    $mail->Host = $hostnamesmtp; // For Gmail
    $mail->SMTPAuth = true;
    $mail->Username = $username; // Gmail username
    $mail->Password = $password;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Email information
    $mail->setFrom('andrej.pekar@nike.sk', 'Mailer');
    $mail->addAddress('pekand@gmail.com', 'Receiver'); // Add a recipient
    //$mail->addReplyTo('info@example.com', 'Information');
    
    // Content
    $mail->isHTML(true); // Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    // Send the email
    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}