<?php 

if (isset($_POST['remove_from_cart_submit'])) {
    
    //Getting data from form
    $productID = $_POST['productID'];

    require_once '../classes/cart.class.php';
    $cart = new Cart();
    $cart->deleteProductFromCart($productID);

    header("location: ../cart.php?error=none");
}