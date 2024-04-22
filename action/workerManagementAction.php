<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" || $_SERVER["REQUEST_METHOD"] == "GET") {
    require '../../private/connSwiftMart.php';
    require '../class/User.class.php';
    $emailConfig = '../mailer/emailConfig.php';
    session_start();

    if (isset($_POST["addWorkerBtn"])) {

        $checkEmail = $conn->prepare("SELECT email FROM user WHERE email = :email");
        $checkEmail->execute(array(":email" => $_POST["email"]));

        if ($checkEmail->rowCount() > 0) {
            $_SESSION['error'] = 'Email not available';
            header("Location: ../index.php?page=workerOverview");
            exit();
        }

        $hashedPassword = password_hash($_POST["password"], PASSWORD_DEFAULT);
        $_POST["password"] = $hashedPassword;

        $emailManager = new EmailManager($emailConfig);
        $databaseManager = new DatabaseManager($emailManager, $conn);
        $databaseManager->addWorker($_POST);

    } elseif (isset($_POST["editWorkerBtn"])) {

        $checkEmail = $conn->prepare("SELECT email FROM user WHERE email = :email");
        $checkEmail->execute(array(":email" => $_POST["email"]));

        if ($checkEmail->rowCount() > 0) {
            $_SESSION['error'] = 'Email not available';
            header("Location: ../index.php?page=editWorker&userId={$_POST['userId']}");
            exit();
        }

        $emailManager = new EmailManager($emailConfig);
        $databaseManager = new DatabaseManager($emailManager, $conn);
        $databaseManager->editWorker($_POST);


    } else {
        $emailManager = new EmailManager($emailConfig);
        $databaseManager = new DatabaseManager($emailManager, $conn);
        $databaseManager->editWorker($_GET);
    }

} else {
    header("location: ../index.php?page=login");
    exit();
}
