<?php 

if (isset($_POST['delete_product'])) {

    //Getting data from form
    $productID = $_POST['productID'];

    require_once '../classes/product.class.php';
    $product = new Product();
    $product->deleteProduct($productID);

    header("location: ../admin_panel.php?window=product");
}

if (isset($_POST['delete_category'])) {

    //Getting data from form
    $filterCategoryID = $_POST['filterCategoryID'];
    
    require_once '../classes/filter.class.php';
    $filter = new Filter();
    $filter->deleteCategory($filterCategoryID);

    header("location: ../admin_panel.php?window=category");
}

if (isset($_POST['delete_attribute'])) {

    //Getting data from form
    $filterAttributeID = $_POST['filterAttributeID'];
    
    require_once '../classes/filter.class.php';
    $filter = new Filter();
    $filter->deleteAttribute($filterAttributeID);

    header("location: ../admin_panel.php?window=attribute");
}

if (isset($_POST['create_attribute'])) {

    //Getting data from form
    $attributeName = $_POST['attribute_Name'];
    $displayName = $_POST['display_Name'];
    $categoryID = $_POST['filterCategoryID'];
    
    require_once '../classes/filter.class.php';
    $filter = new Filter();
    $filter->createAttribute($attributeName, $displayName, $categoryID);

    header("location: ../admin_panel.php?window=attribute");
}
