<?php
require_once 'ProductManagement.class.php';

class ProductManagement
{



}

class DatabaseManager
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getConn()
    {
        return $this->conn;
    }

    public function addProduct($productName, $productPrice, $productDescription, $productImage)
    {
        $addProduct = $this->conn->prepare("INSERT INTO product(name,price,description,picture) 
                                            VALUES(:productName,:productPrice,:productDescription,:productPicture)");
        $addProduct->execute(array(':productName' => $productName, ':productPrice' => $productPrice, ':productDescription' => $productDescription, ':productPicture' => $productImage));

        header('Location: ../index.php?page=products');
        exit();
    }
}

