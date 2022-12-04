<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 

include_once 'navigation_bar.php';
require_once "classes/product.class.php";
require_once "classes/cart.class.php";
require_once 'classes/feedback.class.php';

$productObj = new Product();
$cartObj = new Cart();
$feedbackObj = new FeedBack();
$product = array();
$currentProductsInCart = array();
$currentProductsInCart = $cartObj->getProductsFromCart();
$purchasedProductArray = array();
$usersComments = array();


$productID = "";
if (isset($_GET['productID'])) {
	$productID = $_GET['productID'];
}

$usersComments = $feedbackObj->getComments($productID);

$comment = false;
$commentStatus = false;
$statusOfComment = $feedbackObj->getCommentStatus($productID);

foreach ($statusOfComment as $status => $value) {
	if ($value['is_Able_To_Comment'] == 'Yes') {
		$commentStatus = true;
	}
}

$purchasedProductArray = $feedbackObj->getProductsOnWhichUserCanComment($productID);
foreach ($purchasedProductArray as $product => $value) {
	if ($value['productID'] == $productID) {
		$comment = true;
	}
}


$product = $productObj->getProductById($productID);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
	if (isset($_POST['submit_product'])) {
		$quantity = $_POST['quantity'];
		$productID = $_GET['productID'];
		$counter = true;

		if (isset($_POST['quantity'])) {
			foreach ($currentProductsInCart as $value => $key) {
				if ($key['productID'] == $productID) {
					$counter = false;
				}
			}

			if ($counter == true) {
				$cartObj->insertIntoTempCartItemsWithQuantity($productID, $quantity);
				header("Location:" . $_SERVER['PHP_SELF'] . "?productID=" . $productID);
			} else {
				echo '<script> alert("This product is already in your cart"); </script>';
			}
		} else {
			echo '<script> alert("Enter product quantity you want to buy"); </script>';
		}
	}
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Detalus prekės puslapis</title>
	<link href="includes/style/star/style.css" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

	<div class="container" style="margin-top:20px;">
		<div class="card">
			<?php foreach ($product as $prod => $value) : ?>
				<div class="row">
					<aside class="col-sm-5 border-right">
						<article class="gallery-wrap">
							<div class="img-big-wrap">
								<div> <a href="#"><img src="<?php echo $value['product_Image']; ?>"></a></div>
							</div>
						</article>
					</aside>
					<aside class="col-sm-7">
						<article class="card-body p-5">
							<h3 class="title mb-3"><?php echo $value['product_Name']; ?></h3>

							<p class="price-detail-wrap">
								<span class="price h3 text-warning">
									<span class="currency">Eur €</span><span class="num"><?php echo $value['product_Price']; ?></span>
								</span>
								<span></span>
							</p>






							<div class="rating-wrapper">
								<!-- star 5 -->
								<input type="radio" id="5-star-rating" name="star-rating" value="5">
								<label for="5-star-rating" class="star-rating">
									<i class="fa fa-star d-inline-block"></i>
								</label>

								<!-- star 4 -->
								<input type="radio" id="4-star-rating" name="star-rating" value="4">
								<label for="4-star-rating" class="star-rating star">
									<i class="fa fa-star d-inline-block"></i>
								</label>

								<!-- star 3 -->
								<input type="radio" id="3-star-rating" name="star-rating" value="3">
								<label for="3-star-rating" class="star-rating star">
									<i class="fa fa-star d-inline-block"></i>
								</label>

								<!-- star 2 -->
								<input type="radio" id="2-star-rating" name="star-rating" value="2">
								<label for="2-star-rating" class="star-rating star">
									<i class="fa fa-star d-inline-block"></i>
								</label>

								<!-- star 1 -->
								<input type="radio" id="1-star-rating" name="star-rating" value="1">
								<label for="1-star-rating" class="star-rating star">
									<i class="fa fa-star d-inline-block"></i>
								</label>

							</div>
							<div class="py-1"></div>





							<dl class="item-property">
								<dt>Description</dt>
								<dd>
									<p> <?php echo $value['product_Description']; ?> </p>
								</dd>
							</dl>
							<dl class="param param-feature">
								<dt>Product brand</dt>
								<dd><?php echo $value['product_Brand']; ?></dd>
							</dl>
							<dl class="param param-feature">
								<dt>Car model</dt>
								<dd><?php echo $value['car_Model']; ?></dd>
							</dl>
							<dl class="param param-feature">
								<dt>Car brand</dt>
								<dd><?php echo $value['car_Brand']; ?></dd>
							</dl>
							<dl class="param param-feature">
								<dt>Color</dt>
								<dd>Black and white</dd>
							</dl>
							<dl class="param param-feature">
								<dt>Delivery</dt>
								<dd>Russia, USA, and Europe</dd>
							</dl>

							<hr>
							<div class="row">
								<p>Quantity: </p>
								<div class="col-md-3 col-lg-3 col-xl-2 d-flex">
									<button class="btn btn-link px-2" onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
										<i class="fa fa-minus"></i>
									</button>

									<input id="form1" min="0" name="quantity" value="1" type="number" form="quantity" class="form-control form-control-sm" style="text-align:center; width: 70px;" />

									<button class="btn btn-link px-2" onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
										<i class="fa fa-plus"></i>
									</button>
								</div>
							</div>
							<hr>
							<form id="quantity" method="POST">
								<input type="hidden" name="productID" value="<?php echo $value['productID']; ?>">
								<button class="btn btn-lg btn-outline-primary" type="submit" name="submit_product"> <i class="fa fa-shopping-cart"></i> Pridėti į krepšelį</button>
							</form>
							<form action="">
								<input type="hidden" name="productID" value="<?php echo $value['productID']; ?>">
								<button class="btn btn-lg btn-primary" class="fa fa-shopping-cart">Nusipirkti dabar</button>
							</form>
						</article>
					</aside>
				</div>
			<?php endforeach; ?>
		</div>


		<?php if ($commentStatus == true) : ?>
			<?php if ($comment == true) : ?>
				<div class="d-flex justify-content-center gx-5" style="padding: 5px;">
					<div class="col-lg-10 col-md-6 p-3">
						<div class="card mb-8">
							<div class="card-header py-3">
								<h5 class="mb-0">Palikite atsiliepimą</h5>
							</div>
							<div class="card-body">
								<form method="POST" action="handling/feedback.han.php">
									<input type="hidden" name="productID" value="<?php echo $value['productID']; ?>">
									<div class="form-outline mb-4">
										<textarea name="comment_input" id="" cols="134" rows="4" placeholder="Komentaras..."></textarea>
										<label class="form-label" for="form7Example5">Jūsų komentaras</label>
									</div>
									<button type="submit" class="btn btn-primary btn-lg btn-block" name="confirm_comment">
										Palikti atsiliepimą
									</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			<?php endif; ?>
		<?php endif; ?>

		<section style="background-color: #ad655f;">
			<div class="container py-1">
				<div class="row d-flex justify-content-center">
					<div class="col-md-12 col-lg-10">
						<div class="card text-dark">
							<div class="card-body p-1">
								<h4 class="mb-0">Naujausi atsiliepimai</h4>

								<?php foreach ($usersComments as $comment => $value) : ?>
								<div class="d-flex flex-start border py-1">
										<div>
											<h6 class="fw-bold mb-1"><?php echo $value['user_Username']; ?> </h6>

											<div class="d-flex align-items-center mb-3">
												<p class="mb-0">
													<?php echo $value['comment_Date']; ?> 
												</p>
												<a href="#!" class="link-muted" style="margin-left:10px;"><i class="fa fa-pencil"></i></a>
												<a href="#!" class="link-muted" style="margin-left:4px;"><i class="fa fa-window-close"></i></a>
												<?php if(isset($_SESSION['user_Type']) == 'Admin'): ?>
												<a href="#!" class="link-muted" style="margin-left:4px;"><i class="fa fa-ban"></i></a>
												<?php endif; ?>
											</div>
											<p class="mb-0">
												<?php echo $value['product_Comment']; ?>
										</div>
										</p>
									</div>
									<?php endforeach; ?>
							</div>

							<hr class="my-0" style="height: 1px;" />
						</div>
					</div>
				</div>
			</div>
		</section>

		<!-- <h2>Users feedback</h2>
        <?php foreach ($comments as $comment => $key) { ?>
            <div class="row3" style="margin-top: 0px;">
                <div class="comment_container">
                <div class="dialog_box">
                    <div class="body">
                        <span class="tip tip-up"></span>
                        <p>Commented by:<?php echo " " . $key['userUsername']; ?> / Date:<?php echo " " . $key['commentDate']; ?></p>
                        <div class="message">
                            <span><?php echo $key['productComment']; ?></span>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        <?php } ?> -->

	</div>

	<div class="py-5"></div>




</body>

</html>