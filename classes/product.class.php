<?php
require_once 'database.class.php';
// session_start();

class Product extends Database
{

    public function getProducts() 
    {
        // $dbConn = new Database();
        $prepareStmt = $this->connect()->prepare('SELECT * FROM product;');
        $prepareStmt->execute();

        $productArray = array();

        while($row = $prepareStmt->fetch(PDO::FETCH_ASSOC)) {
            $productArray[] = $row;
        }

        return $productArray;
    }

    public function getProductById($productID) {

        // $dbConn = new Database();
        $prepareStmt = $this->connect()->prepare('SELECT * FROM product WHERE productID=?;');
        if(!$prepareStmt->execute(array($productID))) {
            $prepareStmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }
        $productArray = array();

        while($row = $prepareStmt->fetch(PDO::FETCH_ASSOC)) {
            $productArray[] = $row;
        }

        return $productArray;
    }
}