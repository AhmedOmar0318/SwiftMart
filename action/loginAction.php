<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();
    require '../../private/connSwiftMart.php';
    require '../class/User.class.php';

    $authUser = new LoginManager($conn);
    $authUser->authenticateUser($_POST['email'], $_POST['password']);
} else {
    header('Location: ../index.php?page=login');
    exit();
}
