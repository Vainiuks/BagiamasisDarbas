<?php 

if (isset($_POST['confirm_comment'])) {
    
    //Getting data from form
    $productID = $_POST['productID'];
    $comment = $_POST['comment_input'];

    require_once '../classes/feedback-controller.class.php';
    $feedback = new FeedBackController($productID, $comment);
    $feedback->checkComment();

    header("location: ../product_detail_page.php?error=none&productID=" . $productID);
}