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
        $prepareStmt = $this->connect()->prepare('INSERT INTO product_comment(userID, receiptID, productID, product_Comment, comment_Date) VALUES(?,?,?,?,?);');

        if (!$prepareStmt->execute(array($userID, 1, $productID, $comment, $currentDate))) {
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

    public function getComments($productID) {

        $userID = $_SESSION['userID'];
        $sql = "
        SELECT pc.productCommentID, pc.userID, pc.receiptID, pc.product_Comment, pc.comment_Date, pc.productID, u.user_Username
        FROM product_comment as pc
        LEFT JOIN product as p
        ON p.productID = pc.productID
        LEFT JOIN receipt as r
        ON pc.receiptID = r.receiptID
        CROSS JOIN users as u
        WHERE pc.userID = u.userID 
        AND pc.productID = '{$productID}'
        ";

        $results = $this->mysqli()->query($sql);
        $comments = []; 

        if($results) {
            while($row = $results->fetch_array()) {
                $comments[] = $row;
            }
        }

        return $comments;
    }
}