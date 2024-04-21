<?php
if ($_SERVER ['REQUEST_METHOD'] == 'POST') {
    session_start();
    require '../../private/connSwiftMart.php';
    require '../class/User.class.php';
    $emailConfig = '../mailer/emailConfig.php';

    $emailManager = new EmailManager($emailConfig);
    $databaseManager = new DatabaseManager($emailManager, $conn);
    $databaseManager->editUser($_POST);

} else {
    header('Location: ../index.php?page=login');
    exit();
}