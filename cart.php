<?php 
require_once 'navigation_bar.php';
require_once 'classes/cart.class.php';

$cartObj = new Cart();
$cartProducts = $cartObj->getProductsFromCart();
$cartCount = $cartObj->getCartCount();
$cartPrice = $cartObj->getCartPrice();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Krepšelis</title>
    <link rel="stylesheet" href="../../includes/style/style.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>
    
<section class="h-100 h-custom" style="background-color: #FE828C;">
  <div class="container py-5 h-100" style="margin-top: -100px;">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12">
        <div class="card card-registration card-registration-2" style="border-radius: 15px;">
          <div class="card-body p-0">
            <div class="row g-0">
              <div class="col-lg-8">
                <div class="p-5">
                  <div class="d-flex justify-content-between align-items-center mb-5">
                    <h1 class="fw-bold mb-0 text-black">Krepšelis</h1>
                    <h6 class="mb-0 text-muted"><?php echo $cartCount . ' prekės' ?></h6>
                  </div>
                  <hr class="my-4">

                  <?php foreach($cartProducts as $product => $value) : ?>
                  <div class="row mb-4 d-flex justify-content-between align-items-center">
                    <div class="col-md-2 col-lg-2 col-xl-2">
                      <img
                        src=" <?php echo $value['product_Image']; ?>"
                        class="img-fluid rounded-3" alt="<?php echo $value['product_Name']; ?>">
                    </div>
                    <div class="col-md-3 col-lg-3 col-xl-3">
                      <!-- <h6 class="text-muted"><?php echo $value['product_Type']; ?></h6> -->
                      <h6 class="text-black mb-0"><?php echo $value['product_Name']; ?></h6>
                    </div>
                    <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                      <button class="btn btn-link px-2"
                        onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                        <i class="fa fa-minus"></i>
                      </button>

                      <input min="0" name="quantity-<?php echo $value['productID']; ?>" form="formq-<?php echo $value['productID']; ?>" value="<?php echo $value['quantity'];?>" type="number"
                        class="form-control form-control-sm" />
                        <button class="btn btn-link px-2"
                        onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                        <i class="fa fa-plus"></i>
                      </button>
                    </div>
                    <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                      <h6 class="mb-0"><?php echo ($value['product_Price'] * $value['quantity']) . '€'; ?></h6>
                    </div>
                    <div class="col-md-1 col-lg-1 col-xl" style="margin-left: 20px;">
                      <form id="formq-<?php echo $value['productID']; ?>" action="handling/cart.han.php" method="POST" >
                        <input id="" type="hidden" value='<?php echo $value['productID']; ?>' name="productID">
                        <button type="submit" name="update_product_quantity" class="fa fa-save" style="border:none; background-color:white;"></button>
                        
                        <button type="submit" name="remove_from_cart_submit" class="fa fa-times" style="border:none; background-color:white;"></button>
                      </form>
                    </div>
                  </div>
                  <?php endforeach; ?>

                  <hr class="my-4">

                  <div class="d-flex justify-content-between align-items-center mb-5">
                    <h6 class="mb-0"><a href="index.php" class="text-body"><i class="fas fa-long-arrow-alt-left me-2"></i>Atgal į pagrindinį puslapį</a></h6>
                  </div>

                  <div class="pt-5">
                  </div>
                </div>
              </div>
              <div class="col-lg-4 bg-grey">
                <div class="p-5">
                  <h3 class="fw-bold mb-5 mt-2 pt-1">Suvestinė</h3>
                  <hr class="my-4">

                  <div class="d-flex justify-content-between mb-4">
                    <h5 class="text-uppercase"><?php echo $cartCount . ' prekės'; ?></h5>
                    <h5><?php echo $cartPrice . '€'; ?></h5>
                  </div>

                  <!-- <h5 class="text-uppercase mb-3">Siųntimas</h5>

                  <div class="mb-4 pb-2">
                    <select class="select">
                      <option value="1">1-7 d.d. - €0.00</option>
                      <option value="2">1-3 d.d. - €5.00</option>
                      <option value="3">Three</option>
                      <option value="4">Four</option>
                    </select>
                  </div> -->

                  <hr class="my-4">

                  <div class="d-flex justify-content-between mb-5">
                    <h5 class="text-uppercase">Iš viso:</h5>
                    <h5><?php echo $cartPrice . '€'; ?></h5>
                  </div>

                  <form action="shipping.php" method="POST">
                    <button type="submit" class="btn btn-dark btn-block btn-lg" data-mdb-ripple-color="dark">Tęsti apmokėjimą</button>
                  </form>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

</body>
</html>

<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>