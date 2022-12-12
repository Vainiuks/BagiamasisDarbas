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
    $product->uploadPicture($fileName, $fileTempName, $fileSize, $fileError, $fileType, '');
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
    $productID              = $_POST['productID'];
    $carBrand               = $_POST['carBrand'];
    $carModel               = $_POST['carModel'];
    $productBrand           = $_POST['productBrand'];
    $productName            = $_POST['productName'];
    $productPrice           = $_POST['productPrice'];
    $productWeight          = $_POST['productWeight'];
    $productType            = $_POST['productType'];
    $productDescription     = $_POST['productDescription'];
    $productImage           = "";
    $oldPicture             = "";


    if(isset($_FILES['productNewImage']['name']) && !empty($_FILES['productNewImage']['name'])) {
        $oldPicture = $_POST['product_Image'];
        $file = $_FILES['productNewImage'];
        $productImage = $_FILES['productNewImage']['name'];        
        $fileTempName = $_FILES['productNewImage']['tmp_name'];
        $fileSize = $_FILES['productNewImage']['size'];
        $fileError = $_FILES['productNewImage']['error'];
        $fileType = $_FILES['productNewImage']['type'];
    } else {
        $productImage = $_POST['product_Image'];
    }

    require_once '../classes/product.class.php';
    $product = new Product();
    if(isset($_FILES['productNewImage']['name']) && !empty($_FILES['productNewImage']['name'])) {
        $product->uploadPicture($productImage, $fileTempName, $fileSize, $fileError, $fileType, $oldPicture);
    }
    $product->updateProduct($productID, $carBrand, $carModel, $productBrand, $productName, $productPrice,  $productWeight, $productType, $productDescription, $productImage);

    header("location: ../admin_panel.php?window=product");
}

if (isset($_POST['delete_comment'])) {

    //Getting data from form
    $productCommentID = $_POST['productCommentID'];
    $productID = $_POST['productID'];
    
    require_once '../classes/feedback.class.php';
    $feedback = new FeedBack();
    $feedback->deleteComment($productCommentID, $productID);

    header("location: ../admin_panel.php?window=comment");
}

if (isset($_POST['delete_receipt'])) {

    //Getting data from form
    $receiptID = $_POST['receiptID'];
    
    require_once '../classes/receipt.class.php';
    $receipt = new Receipt();
    $receipt->deleteReceipt($receiptID);

    header("location: ../admin_panel.php?window=shipping");
}

if (isset($_POST['update_receipt'])) {

    //Getting data from form
    $deliveryDate = $_POST['deliveryDate'];
    $homeAddress = $_POST['homeAddress'];
    $emailAddress = $_POST['emailAddress'];
    $city = $_POST['city'];
    $receiptID = $_POST['receiptID'];
    
    require_once '../classes/receipt.class.php';
    $receipt = new Receipt();
    $receipt->updateReceipt($deliveryDate, $homeAddress, $city, $emailAddress, $receiptID);

    header("location: ../admin_panel.php?window=category");
}

if (isset($_POST['update_comment'])) {

    //Getting data from form
    $comment = $_POST['product_Comment'];
    $productCommentID = $_POST['productCommentID'];
    
    require_once '../classes/feedback.class.php';
    $feedback = new FeedBack();
    $feedback->updateCommentTable($comment, $productCommentID);

    header("location: ../admin_panel.php?window=comment");
}

if (isset($_POST['ban_user'])) {

    //Getting data from form
    $userID = $_POST['userID'];
    
    require_once '../classes/feedback.class.php';
    $feedback = new FeedBack();
    $feedback->banUserFromCommenting2($userID);

    header("location: ../admin_panel.php?window=comment");
}