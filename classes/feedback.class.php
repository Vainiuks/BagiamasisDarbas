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
}