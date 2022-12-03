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

    public function getFilteredProducts($filters) {

        // $filtersArr = array();
        // $tmp = array();
        $columns = [];
        $parameters = [];
        $sql = [];

        foreach($filters as $filter => $value) {
            $res = explode('-', $value);
            // $parameters[] = $res['0']; 
            // $columns[] = $res['1']; // Stuleplio pavadinimai
            $sql[] = " {$res['1']} LIKE '{$res['0']}-{$res['1']}' ";
        }

        $query = "SELECT * FROM product";

        if ($sql) {
                $query .= ' WHERE ( ' . implode(' OR ', $sql) . ' )';
        } 
        $prepareStmt = $this->connect()->prepare($query);
        if(!$prepareStmt->execute()) {
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

    public function deleteProduct($productID)
    {   
        if (!empty($productID)) {
            // $prepareStmt = $this->connect()->prepare("DELETE FROM product WHERE productID=?; ");
            // $prepareStmt->execute(array($productID));

            header("Location:" . $_SERVER['PHP_SELF']);
        }
    }
}