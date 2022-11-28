<?php
require_once 'feedback.class.php';

class FeedBackController extends FeedBack
{
    private $productID;
    private $comment;

    public function __construct($productID, $comment) {
        $this->productID = $productID;
        $this->comment = $comment;
    }

    public function checkComment() {
        if ($this->inputHandling() == false) {
            header("location: ../product_detail_page.php?error=emptyfields&productID=" . $this->productID);
            exit();
        }

        $this->insertFeedBack($this->productID, $this->comment);
    }

    private function inputHandling() {
        $result;

        if (empty($this->comment)) {
            $result = false;
        } else {
            $result = true;
        }

        return $result;
    }
}
