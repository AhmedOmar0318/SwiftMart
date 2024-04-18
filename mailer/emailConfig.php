<?php
require '../../private/connSwiftMart.php';
require '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

$emailUsername = getenv('EMAIL_USERNAME');
$emailPassword = getenv('EMAIL_PASSWORD');

$mail = new PHPMailer(true);

$mail->SMTPDebug = SMTP::DEBUG_SERVER;

$mail->isSMTP();
$mail->SMTPAuth = true;

$mail->Host = "smtp.gmail.com";
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = 587;
$mail->Username = $emailUsername;
$mail->Password = $emailPassword;

$mail->isHtml(true);

return $mail;











