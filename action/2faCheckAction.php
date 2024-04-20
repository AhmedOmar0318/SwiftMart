<?php
require '../../private/connSwiftMart.php';
require '../class/User.class.php';
$emailConfig = '../mailer/emailConfig.php';
require '../vendor/autoload.php';
require_once('../class/ActivityLogger.class.php');

use Monolog\Logger;

session_start();

$verificationCode = $_POST['verificationCode'];
$token = $_POST['token'];
$email = $_POST['email'];
$currentTime = date('Y-m-d H:i:s', time());

$getUserData = $conn->prepare("SELECT * FROM user WHERE email = :email");
$getUserData->execute(array(':email' => $email));
$userData = $getUserData->fetch(PDO::FETCH_ASSOC);

if ($getUserData->rowCount() <= 0 ||
    $token !== $userData['token'] ||
    $userData['tokenExpiresAt'] < $currentTime ||
    $verificationCode != $_SESSION['verificationCode']) {

    $logger = new Logger('2FA Attempt.');
    $logger->pushHandler(new ActivityLogger($conn));
    $logger->info('Failed. Verification code or token expired or not found.');

    $_SESSION['error'] = 'Verification code or token expired or not found. Please submit another email confirm request.';
    header("Location: ../index.php?page=confirmEmail&token={$token}");
    exit();
}

$logger = new Logger('2FA Attempt.');
$logger->pushHandler(new ActivityLogger($conn));
$logger->info('Successful. User ID: ' . $userData['userId']);

$emailManager = new EmailManager($emailConfig);
$succesful2fa = new DatabaseManager($emailManager, $conn);
$succesful2fa->update2fa($email, $userData['userId'], $userData['role']);
