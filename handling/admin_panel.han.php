<?php 

if (isset($_POST['delete_product'])) {

    //Getting data from form
    $productID = $_POST['productID'];
    $productImage = $_POST['product_Image'];

    require_once '../classes/product.class.php';
    $product = new Product();
    $product->deleteProduct($productID, $productImage);

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

if (isset($_POST['create_category'])) {

    //Getting data from form
    $categoryName = $_POST['category_Name'];
    $displayName = $_POST['display_Category_Name'];
    
    require_once '../classes/filter.class.php';
    $filter = new Filter();
    $filter->createCategory($categoryName, $displayName);

    header("location: ../admin_panel.php?window=category");
}

if (isset($_POST['create_product'])) {

    //Getting data from form
    $carBrand               = $_POST['carBrand'];
    $carModel               = $_POST['carModel'];
    $productBrand           = $_POST['productBrand'];
    $productName            = $_POST['productName'];
    $productPrice           = $_POST['productPrice'];
    $productWeight          = $_POST['productWeight'];
    $productType            = $_POST['productType'];
    $productDescription     = $_POST['productDescription'];
    
    $file = $_FILES['productImage'];
    $fileName = $_FILES['productImage']['name'];
    $fileTempName = $_FILES['productImage']['tmp_name'];
    $fileSize = $_FILES['productImage']['size'];
    $fileError = $_FILES['productImage']['error'];
    $fileType = $_FILES['productImage']['type'];
    

    require_once '../classes/product.class.php';
    $product = new Product();
    $product->uploadPicture($fileName, $fileTempName, $fileSize, $fileError, $fileType);
    $product->createProduct($carBrand, $carModel, $productBrand, $productName, $productPrice,  $productWeight, $productType, $productDescription, $fileName);

    header("location: ../admin_panel.php?window=product");
}

if (isset($_POST['update_attribute'])) {

    //Getting data from form
    $attributeName = $_POST['attribute_Name'];
    $displayName = $_POST['display_Name'];
    $categoryID = $_POST['filterCategoryID'];
    $attributeID = $_POST['filterAttributeID'];
    
    require_once '../classes/filter.class.php';
    $filter = new Filter();
    $filter->updateAttribute($attributeName, $displayName, $categoryID, $attributeID);

    header("location: ../admin_panel.php?window=attribute");
}

if (isset($_POST['update_category'])) {

    //Getting data from form
    $categoryName = $_POST['category_Name'];
    $displayName = $_POST['display_Category_Name'];
    $categoryID = $_POST['filterCategoryID'];
    
    require_once '../classes/filter.class.php';
    $filter = new Filter();
    $filter->updateCategory($categoryName, $displayName, $categoryID);

    header("location: ../admin_panel.php?window=category");
}

if (isset($_POST['update_product'])) {

    //Getting data from form
    $carBrand               = $_POST['carBrand'];
    $carModel               = $_POST['carModel'];
    $productBrand           = $_POST['productBrand'];
    $productName            = $_POST['productName'];
    $productPrice           = $_POST['productPrice'];
    $productWeight          = $_POST['productWeight'];
    $productType            = $_POST['productType'];
    $productDescription     = $_POST['productDescription'];
    
    $file = $_FILES['productImage'];
    $fileName = $_FILES['productImage']['name'];
    $fileTempName = $_FILES['productImage']['tmp_name'];
    $fileSize = $_FILES['productImage']['size'];
    $fileError = $_FILES['productImage']['error'];
    $fileType = $_FILES['productImage']['type'];
    

    require_once '../classes/product.class.php';
    $product = new Product();
    $product->uploadPicture($fileName, $fileTempName, $fileSize, $fileError, $fileType);
    $product->createProduct($carBrand, $carModel, $productBrand, $productName, $productPrice,  $productWeight, $productType, $productDescription, $fileName);

    header("location: ../admin_panel.php?window=product");
}