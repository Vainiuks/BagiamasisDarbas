<?php

if(isset($_POST['confirm_payment'])) {
    
    $first_Name = $_POST['user_first_name'];
    $last_Name = $_POST['user_last_name'];
    $user_Email = $_POST['user_email'];
    $user_City = $_POST['user_city'];
    $home_Address = $_POST['user_home_address'];
    $user_Phone_Number = $_POST['user_phone_number'];

    require_once '../classes/payment-controller.class.php';

    $payment = new PaymentController($first_Name, $last_Name, $user_Email, $user_City, $home_Address, $user_Phone_Number);

    $payment->checkPaymentInput();

    // header("location: ../payment.php?error=none");

}