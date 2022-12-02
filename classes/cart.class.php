<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
require_once 'database.class.php';
require_once 'send-email.class.php';

class Cart extends Database {

    public $productsIDArray;

    public  function addToCart($productID)
    {
        if (!empty($productID)) {
            $this->insertIntoTempCartItems($productID);
        }
    }

    public  function insertIntoTempCartItems($productID)
    {
        $dbConn = new Database();
        $prepareStmt = $this->connect()->prepare('INSERT INTO item_Cart(userID, productID, quantity) VALUES (?,?,?);');
        $userID = $_SESSION['userID'];
        if (!$prepareStmt->execute(array($userID, $productID, 1))) {
            $prepareStmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        $prepareStmt = null;
    }

    public  function insertIntoTempCartItemsWithQuantity($productID, $quantity)
    {
        // $dbConn = new Database();
        $prepareStmt = $this->connect()->prepare('INSERT INTO item_Cart(userID, productID, quantity) VALUES (?,?,?);');
        $userID = $_SESSION['userID'];
        if (!$prepareStmt->execute(array($userID, $productID, $quantity))) {
            $prepareStmt = null;
            header("location: ../product.php?error=stmtfailed");
            exit();
        }

        $prepareStmt = null;
    }

    public function getProductsFromCart()
    {
        if(isset($_SESSION['userID'])) {
        $userID = $_SESSION['userID'];
        $sql = "
        SELECT product.productID, product.product_Type, product.car_Model, product.car_Brand, product.product_Brand, product.product_Name, product.product_Price, product.product_Description, product.product_Image, item_Cart.quantity
        FROM product
        LEFT JOIN item_Cart
        ON product.productID = item_Cart.productID
        WHERE product.productID = item_Cart.productID 
        AND userID = $userID";

        $results = $this->mysqli()->query($sql);

        $products = array();

        if ($results) {
            while ($row = $results->fetch_array()) {
                $products[] = $row;
            }
        }

        return $products;
        }
    }

    
    public function getCartCount() {
        if(isset($_SESSION['userID'])) {
            $userID = $_SESSION['userID'];
            $count = array();
            $prepareStmt = $this->connect()->prepare("SELECT COUNT(*) as numberOfCartItems FROM item_Cart WHERE userID = $userID;");
    
            $prepareStmt->execute();
            $count = $prepareStmt->fetchColumn();
            
            return $count;
        }
    }

    public function getCartPrice() {

        if(isset($_SESSION['userID'])) {
        $products = $this->getProductsFromCart();

        $price = 0;
        foreach($products as $product) {
            $price = $price + ((double)$product['quantity'] * (double)$product['product_Price']);
        }

        return $price;
    }
    }

    
    public function deleteProductFromCart($productID)
    {   
        if (!empty($productID)) {
            $userID = $_SESSION['userID'];
            $prepareStmt = $this->connect()->prepare("DELETE FROM item_Cart WHERE productID=? AND userID=?; ");
            $prepareStmt->execute(array($productID, $userID));

            header("Location:" . $_SERVER['PHP_SELF']);
        }
    }

    
    public function formatReceipt($first_Name, $last_Name, $email_Address, $city, $home_Address, $phone_Number) {

        // $dbConn = new Database();
        $purchaseDate = date("Y-m-d h:i:sa");
        $totalCartPrice = $this->getCartPrice();
        $userID = $_SESSION['userID'];
        $prepareStmt = $this->connect()->prepare('INSERT INTO receipt(userID, date_Purchased, home_Address, city, total_Price, user_Firstname, user_Lastname, user_Phonenumber, email_Address) VALUES(?,?,?,?,?,?,?,?,?); ');

        if (!$prepareStmt->execute(array($userID, $purchaseDate, $home_Address, $city, $totalCartPrice, $first_Name, $last_Name, $phone_Number, $email_Address))) {
            $prepareStmt = null;
            header("location: ../shipping.php?error=stmtfailed");
            exit();
        }
    
        $this->insertPurchasedProducts();
    }

    public function insertPurchasedProducts() {

        // $dbConn = new Database();
        $mail = new EmailSender();
        $productsArr = array();
        $productsArr = $this->getProductsFromCart();
        $receiptID = array();
        $userID = $_SESSION['userID'];
        $prepareStmt = $this->connect()->prepare("SELECT receiptID FROM receipt WHERE userID = $userID;");
        $prepareStmt->execute();

        while($row = $prepareStmt->fetch(PDO::FETCH_ASSOC)) {
            $receiptID = $row;
        }

        foreach($productsArr as $product) {
            $prepareStmt1 = $this->connect()->prepare("INSERT INTO purchased_Products(productID, receiptID, quantity) VALUES(?,?,?);");
            
            if(!$prepareStmt1->execute(array($product['productID'], $receiptID['receiptID'], $product['quantity']))) {
                $prepareStmt1 = null;
                header("location: ../cart.php?error=stmtfailed");
                exit();
            }
        }
        
        $mail->sendEmail($productsArr);
        $this->clearCartItems();

    }

     public function clearCartItems() {
        // $dbConn = new Database();
        $userID = $_SESSION['userID'];
        $prepareStmt = $this->connect()->prepare("DELETE FROM item_Cart WHERE userID = $userID;");

        if($prepareStmt->execute()) {
            echo "<script> window.location.href='../index.php?success=purchase'; </script>";
        }
    }

    public function updateProductQuantityInCart($productID, $quantity) {
        // $dbConn = new Database();
        $userID = $_SESSION['userID'];
        $prepareStmt = $this->connect()->prepare("UPDATE item_Cart SET quantity = $quantity WHERE productID = $productID AND userID = $userID ;");
        $prepareStmt->execute();

        header("Location:" . $_SERVER['PHP_SELF']);

 }





}

