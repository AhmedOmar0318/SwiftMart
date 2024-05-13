<?php
require '../vendor/autoload.php';

if ($_SERVER ['REQUEST_METHOD'] == 'POST') {
    session_start();
    require '../../private/connSwiftMart.php';
    require '../class/ProductManagement.class.php';

    $photo = base64_encode(file_get_contents($_FILES['productPicture']['tmp_name']));

    $databaseManager = new DatabaseManager($conn);
    $databaseManager->addProduct($_POST['productName'], $_POST['productPrice'], $_POST['productDescription'], $photo);

} else {
    header('Location: ../index.php?page=login');
    exit();
}
