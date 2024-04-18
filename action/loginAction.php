<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();
    require '../../private/connSwiftMart.php';
    require '../class/User.class.php';

    $email = $_POST['email'];
    $password = $_POST['password'];

    $authUser = new LoginManager($conn);
    $authUser->authenticateUser($email, $password);
} else {
    header('Location: ../index.php?page=login');
    exit();
}
