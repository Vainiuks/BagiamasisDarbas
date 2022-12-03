<?php
include_once 'navigation_bar.php';
include_once 'classes/product.class.php';
include_once 'classes/cart.class.php';
include_once 'classes/filter.class.php';

$productObj = new Product();
$cartObj = new Cart();
$filterObj = new Filter();

$getProducts = array();
$getProducts = $productObj->getProducts();
$currentProductsInCart = array();
$currentProductsInCart = $cartObj->getProductsFromCart();
$categories = $filterObj->getCategories();
$attributes = $filterObj->getAttributes();

//Add to cart item
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['submit_product'])) {
        $productID = $_POST['productID'];
        $exists = false;
        foreach ($currentProductsInCart as $value => $key) {
            if ($key['productID'] == $productID) {
                $exists = true;
            }
        }
        if ($exists == false) {
            $cartObj->addToCart($_POST['productID']);
            header("Location:" . $_SERVER['PHP_SELF']);
        } else {
            echo '<script> alert("This product is already in your cart"); </script>';
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['submit_filter'])) {
        $submitted_Filters = array(); 
        foreach ($_POST as $filter => $value) {
                if($filter != 'submit_filter') {
                    array_push($submitted_Filters, $filter);
                }
        }
        $getProducts = $productObj->getFilteredProducts($submitted_Filters);
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagrindinis</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" rel="stylesheet">
    <link href="includes/style/style.css" rel="stylesheet" />
</head>

<body>

    <?php
    if (isset($_GET['success'])) {
        if ($_GET['success'] == "purchase") { ?>
            <div class="container col-lg-4 py-1 d-flex justify-content-start" style=" margin-left: 272px; margin-bottom:-25px;">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <div class="row">
                        <div class="col-lg-11">
                            <h4 class="alert-heading">Ačiū, kad pirkote!</h4>
                            <p>Jūsų užsakymas greitu metu bus išsiųstas Jums!</p>
                        </div>
                        <div class="col-lg-1">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="border: none; background-color:#d1e7dd;">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
    <?php   }
    }
    ?>

    <div class="container py-1">
        <div class="row" style="margin-top:5px;">
            <div class="col-lg-3 col-md-6">
            <form method="POST">
                <div class="accordion" id="accordionExample">
                    <?php foreach ($categories as $category => $value) : ?>
                        <div class="card">
                            <div class="card-header" id="heading<?php echo $value['category_Name']; ?>">
                                <h5 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse<?php echo $value['category_Name']; ?>" aria-expanded="false" aria-controls="collapse<?php echo $value['category_Name']; ?>">
                                        <?php echo $value['display_Category_Name']; ?> <i class="fa-solid fa-plus"></i>
                                    </button>
                                </h5>
                            </div>
                            <div id="collapse<?php echo $value['category_Name']; ?>" class="collapse" aria-labelledby="heading<?php echo $value['category_Name']; ?>" data-parent="#accordionExample">
                                <div class="card-body">
                                    <?php foreach ($attributes as $attribute => $a_value) : ?>
                                        <?php if ($value['category_Name'] == $a_value['category_Name']) : ?>
                                            <input  class="form-check-input" 
                                                    type="checkbox" 
                                                    name="<?php echo $a_value['attribute_Name']; ?>" 
                                                    value="<?php echo $a_value['display_Name']; ?>"
                                                >
                                            <?php echo $a_value['display_Name']; ?>
                                            <br>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="col-lg-3 col-md-6 d-inline">
                        <button class="btn btn-primary btn-sm" type="submit" name="submit_filter" style="width:150px; margin-top:8px;">Filtruoti</button>
                        <!-- <button class="btn btn-outline-primary btn-sm mt-2" type="submit" name="reset_filters" style="width:150px;">Išvalyti filtrus</button> -->
                    </div>
                </form>
            </div>
            <div class="col-lg-9 col-md-6">
                <?php foreach ($getProducts as $product => $value) :  ?>
                    <div class="row p-2 bg-white border rounded">
                        <div class="col-md-3 mt-1">
                            <a href="<?php printf('%s?productID=%s', 'product_detail_page.php',  $value['productID']); ?>"><img class="img-fluid img-responsive rounded product-image" src="<?php echo $value['product_Image'] ?>" alt="product1" class="product_image"></a>
                        </div>
                        <div class="col-md-6 mt-1">
                            <h5><?php echo $value['product_Name']; ?></h5>
                            <div class="d-flex flex-row">
                                <div class="ratings mr-2"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div><span>310</span>
                            </div>
                            <div class="mt-1 mb-1 spec-1"><span><?php echo $value['car_Model']; ?></span><span class="dot"></span>
                                <span><?php echo $value['car_Brand']; ?></span><span class="dot"></span><span><?php echo $value['product_Brand']; ?><br></span>
                            </div>
                            <p class="text-justify text-truncate para mb-0"><?php echo $value['product_Description']; ?><br><br></p>
                        </div>
                        <div class="align-items-center align-content-center col-md-3 border-left mt-1">
                            <div class="d-flex flex-row align-items-center">
                                <h4 class="mr-1"><?php echo $value['product_Price'] . '€'; ?></h4>
                            </div>
                            <div class="d-flex flex-column mt-4">
                                <form action="product_detail_page.php?" method="GET" enctype="multipart/form-data">
                                    <button class="btn btn-primary btn-sm" type="submit" name="productID" value="<?php printf($value['productID']); ?>">Aprašymas</button>
                                </form>
                                <?php if (isset($_SESSION['logged'])) : ?>
                                    <form method="POST">
                                        <input type="hidden" name="productID" value="<?php echo $value['productID']; ?>">
                                        <button class="btn btn-outline-primary btn-sm mt-2" type="submit" name="submit_product">Pridėti į krepšelį</button>
                                    </form>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    </div>

</body>

</html>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="includes/scripts/script.js"></script>