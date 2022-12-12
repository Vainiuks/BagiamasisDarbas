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
        SELECT pc.productCommentID, pc.userID, pc.receiptID, pc.product_Comment, pc.comment_Date, pc.productID, u.user_Username, u.userID, u.is_Able_To_Comment
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

    public function deleteComment($commentID, $productID) {

        if (!empty($productID) && !empty($commentID)) {
            $prepareStmt = $this->connect()->prepare("DELETE FROM product_comment WHERE productID=? AND productCommentID=?; ");
            $prepareStmt->execute(array($productID, $commentID));

            header("Location:" . $_SERVER['PHP_SELF']);
        }
    }

    public function updateComment($comment, $commentID, $productID) {

        $prepareStmt = $this->connect()->prepare("UPDATE product_Comment SET product_Comment = ? WHERE productCommentID = ? ; ");
        if (!$prepareStmt->execute(array($comment, $commentID))) {
            $prepareStmt = null;
            header("location: ../product_detail_page.php?error=stmtfailed?productID=" . $productID);
            exit();
        }

        $prepareStmt = null;
    }

    public function banUserFromCommenting($userID, $productID) {

        $prepareStmt = $this->connect()->prepare("UPDATE users SET is_Able_To_Comment = ? WHERE userID = ? ; ");
        if (!$prepareStmt->execute(array('No', $userID))) {
            $prepareStmt = null;
            header("location: ../product_detail_page.php?error=stmtfailed?productID=" . $productID);
            exit();
        }

        $prepareStmt = null;
    }

    public function getCommentsForAdminPanel() {

        $userID = $_SESSION['userID'];
        $sql = "
        SELECT pc.productCommentID, pc.productID, pc.userID, pc.product_Comment, pc.comment_Date, u.user_Username, u.userID, u.is_Able_To_Comment
        FROM product_comment as pc
        LEFT JOIN product as p
        ON p.productID = pc.productID
        LEFT JOIN receipt as r
        ON pc.receiptID = r.receiptID
        CROSS JOIN users as u
        WHERE pc.userID = u.userID 
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

    public function updateCommentTable($comment, $commentID) {

        $prepareStmt = $this->connect()->prepare("UPDATE product_Comment SET product_Comment = ? WHERE productCommentID = ? ; ");
        if (!$prepareStmt->execute(array($comment, $commentID))) {
            $prepareStmt = null;
            header("location: ../admin_panel.php?window=comment");
            exit();
        }

        $prepareStmt = null;
    }

    public function banUserFromCommenting2($userID) {

        $prepareStmt = $this->connect()->prepare("UPDATE users SET is_Able_To_Comment = ? WHERE userID = ? ; ");
        if (!$prepareStmt->execute(array('No', $userID))) {
            $prepareStmt = null;
            header("location: ../admin_panel.php?window=comment");
            exit();
        }

        $prepareStmt = null;
    }
}