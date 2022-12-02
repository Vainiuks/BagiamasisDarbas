<?php

if (isset($_POST['remove_from_cart_submit'])) {

    //Getting data from form
    $productID = $_POST['productID'];

    require_once '../classes/cart.class.php';
    $cart = new Cart();
    $cart->deleteProductFromCart($productID);

    header("location: ../cart.php?error=none");
}

if (isset($_POST['update_product_quantity'])) {

    //Getting data from form
    $productID = $_POST['productID'];
    $quantity = $_POST['quantity-' . $productID];

    require_once '../classes/cart.class.php';
    $cart = new Cart();
    $cart->updateProductQuantityInCart($productID, $quantity);

    header("location: ../cart.php?error=none");
}