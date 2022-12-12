<?php
include_once 'database.class.php';

class Receipt extends Database {

    public function getReceipts() {

        $sql = "
        SELECT * FROM receipt as r
        LEFT JOIN users as u
        ON r.userID = u.userID
        WHERE r.delivery_Date > CURDATE()        
        ";

        $results = $this->mysqli()->query($sql);
        $receipts = array(); 

        if($results) {
            while($row = $results->fetch_array()) {
                $receipts[] = $row;
            }
        }

        return $receipts;
    }

    public function deleteReceipt($receiptID) {

        if (!empty($receiptID) && !empty($commentID)) {
            $prepareStmt = $this->connect()->prepare("DELETE FROM receipt WHERE receiptID=?;");
            $prepareStmt->execute(array($receiptID));

            header("Location:" . $_SERVER['PHP_SELF']);
        }
    }

    public function updateReceipt($deliveryDate, $homeAddress, $emailAddress, $city, $receiptID) {

        $prepareStmt = $this->connect()->prepare("UPDATE receipt SET delivery_Date = ?, home_Address = ?, city = ?, email_address = ? WHERE receiptID = ? ; ");
        if (!$prepareStmt->execute(array($deliveryDate, $homeAddress, $emailAddress, $city, $receiptID))) {
            $prepareStmt = null;
            header("location: ../admin_panel.php?window=shipping");
            exit();
        }

        $prepareStmt = null;
    }
}