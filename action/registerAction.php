<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();
    require '../../private/connSwiftMart.php';
    require '../class/User.class.php';
    $emailConfig = '../mailer/emailConfig.php';

    $dateOfBirth = new DateTime($_POST['dateOfBirth']);
    $currentDate = new DateTime();
    $ageInterval = $currentDate->diff($dateOfBirth);

    if ($ageInterval->y < 18) {
        $_SESSION['error'] = 'You must be over the age of 18 to register.';
        $_SESSION['data'] = $_POST;
        header('Location: ../index.php?page=register');
        exit();
    }
    $emailManager = new EmailManager($emailConfig);
    $databaseManager = new DatabaseManager($emailManager, $conn);
    $registerUser = new RegistrationManager($databaseManager);
    $registerUser->registerUser($_POST);

} else {
    header('Location: ../index.php?page=register');
    exit();
}
