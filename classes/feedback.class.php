<?php 
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
require_once 'database.class.php';
class FeedBack extends Database {

    public function insertFeedBack($productID, $comment) {

        $userID = $_SESSION['userID'];
        $currentDate = Date("Y-m-d H:i:s");
        $prepareStmt = $this->connect()->prepare('INSERT INTO product_comment(userID, receiptID, product_Comment, comment_Date) VALUES(?,?,?,?);');

        if (!$prepareStmt->execute(array($userID, 1, $comment, $currentDate))) {
            $prepareStmt = null;
            header("location: ../product_detail_page.php?error=stmtfailed?productID=" . $productID);
            exit();
        }

        $prepareStmt = null;
    }

    public function getProductsOnWhichUserCanComment($productID) {
        
        $userID = $_SESSION['userID'];
        $sql = "
            SELECT DISTINCT pp.productID
            FROM purchased_products as pp
            LEFT JOIN receipt as r
            ON pp.receiptID = r.receiptID
            LEFT JOIN product as p
            ON p.productID = pp.productID
            WHERE R.userID = {$userID}"
        ;

        $results = $this->mysqli()->query($sql);
        $productIDs = []; 

        if($results) {
            while($row = $results->fetch_array()) {
                $productIDs[] = $row;
            }
        }

        return $productIDs;
    }

    public function getCommentStatus($productID) {

        $userID = $_SESSION['userID'];
        $sql = "
        SELECT is_Able_To_Comment FROM users WHERE userID = ?
        ";

        $prepareStmt = $this->connect()->prepare($sql);

        if (!$prepareStmt->execute(array($userID))) {
            $prepareStmt = null;
            header("location: ../product_detail_page.php?error=stmtfailed?productID=" . $productID);
            exit();
        }

        $commentStatus = array();

        while($row = $prepareStmt->fetch(PDO::FETCH_ASSOC)) {
            $commentStatus[] = $row;
        }
        
        return $commentStatus;
    }
}