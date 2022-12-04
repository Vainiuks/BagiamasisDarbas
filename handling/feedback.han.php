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

if (isset($_POST['delete_comment'])) {
    
    //Getting data from form
    $commentID = $_POST['productCommentID'];
    $productID = $_POST['productID'];
    
    require_once '../classes/feedback.class.php';
    $feedback = new FeedBack();
    $feedback->deleteComment($commentID, $productID);

    header("location: ../product_detail_page.php?error=none&productID=" . $productID);
}

if (isset($_POST['ban_user'])) {
    
    //Getting data from form
    $userID = $_POST['userID'];
    $productID = $_POST['productID'];

    require_once '../classes/feedback.class.php';
    $feedback = new FeedBack();
    $feedback->banUserFromCommenting($userID, $productID);

    header("location: ../product_detail_page.php?error=none&productID=" . $productID);
}

if (isset($_POST['update_comment'])) {
    
    //Getting data from form
    $comment = $_POST['productComment'];
    $commentID = $_POST['productCommentID'];
    $productID = $_POST['productID'];
    
    require_once '../classes/feedback.class.php';
    $feedback = new FeedBack();
    $feedback->updateComment($comment, $commentID, $productID);

    header("location: ../product_detail_page.php?error=none&productID=" . $productID);
}
