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

    public function deleteProduct($productID, $productImage)
    {   
        if (!empty($productID)) {
            unlink($productImage);
            $prepareStmt = $this->connect()->prepare("DELETE FROM product WHERE productID=?; ");
            $prepareStmt->execute(array($productID));

            header("Location:" . $_SERVER['PHP_SELF']);
        }
    }

    public function createProduct($carBrand, $carModel, $productBrand, $productName, $productPrice,  $productWeight, $productType, $productDescription, $productImage) {

        $prepareStmt = $this->connect()->prepare('INSERT INTO product(product_Type, car_Model, car_Brand, product_Brand, product_Name, product_Price, product_Weight, product_Description, product_Image) VALUES(?,?,?,?,?,?,?,?,?);');

        if (!$prepareStmt->execute(array($productType, $carModel, $carBrand, $productBrand, $productName, $productPrice, $productWeight, $productDescription, "includes/product_images/" . $productImage))) {
            $prepareStmt = null;
            header("location: ../admin_panel.php?error=stmtfailed&window=category");
            exit();
        }

        $prepareStmt = null;
    }

    public function uploadPicture($fileName, $fileTempName, $fileSize, $fileError, $fileType) {
        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowedExt = array('jpg', 'jpeg', 'png');

        if (in_array($fileActualExt, $allowedExt)) {
            if ($fileError === 0) {
                if ($fileSize < 500000) {
                    // $fileNameNew = uniqid('', true) . "." . $fileActualExt;
                    // include_once './';
                    $fileDestination = '../includes/product_images/' . $fileName;
                    move_uploaded_file($fileTempName, $fileDestination);
                } else {
                    header("location: ../admin_panel.php?error=filetoobig");
                }
            } else {
                header("location: ../admin_panel.php?error=erroruploadingfile");
            }
        } else {
            header("location: ../admin_panel.php?error=cantuploadfile");
        }
    }
}