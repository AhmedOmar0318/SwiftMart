<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();
    require '../class/User.class.php';
    require '../../private/connSwiftMart.php';
    $emailConfig =  '../mailer/emailConfig.php';

    $checkEmail = $conn->prepare("SELECT email FROM user WHERE email = :email");
    $checkEmail->execute(array(":email" => $_POST["email"]));

    if ($checkEmail->rowCount() > 0) {
        $token = bin2hex(random_bytes(16));
        $hashedToken = hash("sha256", $token);
        $tokenExpiresAt = date("Y-m-d H:i:s", time() + 60 * 15);

        $setToken = $conn->prepare("UPDATE user SET token = :token,tokenExpiresAt = :tokenExpiresAt WHERE email = :email");
        $setToken->execute(array(':email' => $_POST["email"], ':token' => $hashedToken, ':tokenExpiresAt' => $tokenExpiresAt));

        $emailManager = new EmailManager($emailConfig);
        $emailManager->sendMailPassword($_POST["email"], $hashedToken);
        $_SESSION['checkInbox'] = 'passwordReset';
        header('Location: ../index.php?page=checkInbox');
        exit();
    } else {
        $_SESSION['checkInbox'] = 'passwordReset';
        header('Location: ../index.php?page=checkInbox');
        exit();
    }
} else {
    header("location: ../index.php?page=login");
    exit();
}

