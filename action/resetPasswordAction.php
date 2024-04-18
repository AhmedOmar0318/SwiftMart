<?php
session_start();
require '../class/User.class.php';
require '../../private/connSwiftMart.php';
$emailConfig = '../mailer/emailConfig.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $emailManager = new EmailManager($emailConfig);
    $resetUserPassword = new DatabaseManager($emailManager, $conn);
    $resetUserPassword->resetUserPassword($_POST['email'], $_POST['password']);
} else {
    header('Location: ../index.php?page=login');
    exit();
}