<?php
include_once 'classes/database.class.php';

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
}