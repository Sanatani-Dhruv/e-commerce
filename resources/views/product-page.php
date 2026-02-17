<?php
	include_once('php/config.php');
?>
<?php 
	$_SESSION["product-page"] = "true";
	$getmaxid_sql = "select max(product_id) as total_products from products";
	$getmaxid_result = mysqli_query($conn, $getmaxid_sql);

	if (isset($id)) {
		if (mysqli_num_rows($getmaxid_result) == 1) {
			while ($getmaxid_row = mysqli_fetch_assoc($getmaxid_result)) {
				$total_product = $getmaxid_row["total_products"];
				$current_product_id = (int) (clean_input($id));
				if ($current_product_id > 0 && $current_product_id <= $total_product) {
					echo "<!-- Valid Product -->";

					$getdetail_sql = "select * from products where product_id = $current_product_id";
					$getdetail_result = mysqli_query($conn, $getdetail_sql);

					if(mysqli_num_rows($getdetail_result) == 1) {
						while ($getdetail_row = mysqli_fetch_assoc($getdetail_result)) {
							$product_id = $getdetail_row["product_id"];
							$product_name = $getdetail_row["product_name"];
							$product_sdesc = $getdetail_row["product_shortdesc"];
							$product_ldesc = $getdetail_row["product_longdesc"];
							$product_stock = $getdetail_row["product_stock"];
							$product_price = $getdetail_row["product_price"];
							$product_imagepath = $getdetail_row["product_imagepath"];
							$post_stock_text;
							if ($product_stock > 0) {
								$stock_available = "true";
								if ($product_stock <=50) {
									$post_stock_text = "Running Out Of Stock!";
								} elseif ($product_stock <=100) {
									$post_stock_text = "Limited Quantity!";
								} elseif ($product_stock > 100) {
									$post_stock_text = "In Stock!";
								}
							} else {
								$post_stock_text = "Out Of Stock!";
								$stock_available = "false";
							}
						}
					}

					try {
						if (isset($_SESSION["current_user"])) {
							$current_user_id = $_SESSION["current_user_id"];

							$get_cart_detail_sql = "SELECT sum(item_quantity) from cart_items where product_id = $product_id and user_id = $current_user_id;";
							$get_cart_detail_result = mysqli_query($conn, $get_cart_detail_sql);

							if (mysqli_num_rows($get_cart_detail_result) === 1) {
								while ($get_cart_detail_row = mysqli_fetch_assoc($get_cart_detail_result)) {
									$quantity_from_db = $get_cart_detail_row["sum(item_quantity)"];
									if ($quantity_from_db == NULL) {
										$quantity_from_db = 1; 
									}
								}
							} else {
								$quantity_from_db = 1;
							}
						} else {
							$quantity_from_db = 1;
						}
					} catch (Exception $err) {
						echo "DB Error: ";
						echo "<pre>";
						echo "$err";
						echo "</pre>";
					}

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Product Page - IT Sales and Services Website</title>
		<link rel="icon" href="/images/logo-monodark.png">
		<link rel="stylesheet" href="/styles/header.css" media="all">
		<link rel="stylesheet" href="/styles/general.css" media="all">
		<link rel="stylesheet" href="/styles/login.css" media="all">
		<link rel="stylesheet" href="/styles/user-page.css" media="all">
		<link rel="stylesheet" href="/styles/footer-part.css" media="all">
		<link rel="stylesheet" href="/styles/store-page-general.css" media="all">
		<link rel="stylesheet" href="/styles/store-page-single.css" media="all">
	</head>
	<body id="body" class="body">
<?php 
	include_once("php/header.php");
?>
		  <div class="pathline-container">
			  <div class="pathline">
				  <a class="home-link" href="/">
					  <span class="home">Home</span>
				  </a>
				  <span class="path-arrow">&#x3E;</span>
				  <a class="home-link" href="/products">
					  <span class="home">Products</span>
				  </a>
				  <span class="path-arrow">&#x3E;</span>
				  <span class="current-location"><?=($product_name)?></span>
			  </div>
		  </div>
		  <main class="main-container">
			  <div class="product-container-1">
			  	<div class="product-left-part-container">
					<div class="product-image-container">
						<img class="product-image" src="/<?=htmlspecialchars($product_imagepath)?>" alt="<?=htmlspecialchars($product_name)?>">
					</div>
				</div>
			  	<div class="product-right-part-container">
					<div class="product-right-part">
						<div class="product-showcase-title">
							<h2>
								<?=($product_name)?>
							</h2>
						</div>
						<div class="product-showcase-sdesc">
							<h4>
								<?=($product_sdesc)?>
							</h4>
						</div>
						<hr class="product-page-hr">
						<div class="product-showcase-price"><sup>₹</sup> <?=($product_price)?></div>
						<div class="product-showcase-stock">
							<strong>Stock:</strong> <?=($product_stock)?>
							<div class="product-showcase-post-stock-message <?=htmlspecialchars($stock_available)?>"><?=htmlspecialchars($post_stock_text)?></div>
						</div>
<?php 
					if ($stock_available == "true") {
?>
					<form action="/user.php#cart" method="post">
						<input type="hidden" id="type" name="type" value="hardware">
						<input type="hidden" id="redirect_location" name="redirect_location" value="<?=htmlspecialchars($_SERVER["PHP_SELF"] . "?product_id=" . $product_id)?>">
						<div class="product-showcase-btns-container">
							<div class="product-showcase-how-much-addcart">
								Quantity: <input name="quantity" class="product-showcase-how-much-addcart-input" value="<?=htmlspecialchars($quantity_from_db)?>" min="1" max="<?=htmlspecialchars($product_stock)?>" type="number">
							</div>
							<div class="product-showcase-addcart-btn-container">
								<button name="product-id" value="<?=htmlspecialchars($product_id)?>" class="product-showcase-addcart-btn login-btn submit <?=htmlspecialchars($stock_available)?>">Add To Cart</button>
								<br>
								<a class="cart-product-btn-link" href="/user">
									<div class="cart-product-btn login-btn submit product-page-cart-btn">
										View Cart
									</div>
								</a>
							</div>
						</div>
					</form>
<?php
						if (isset($_REQUEST['error'])) {
?>
	<div class="php-status-error-message" id="error" style="font-size: 1.5rem;"><?=htmlspecialchars($_REQUEST['error'])?></div>
<?php
						}
?>
<?php
					}
?>
					</div>
				</div>
			  </div>
			  <div class="product-container-2">
				  <div class="product-ldesc-container">
					  <h3 class="ldesc-title">Product Description</h3>
				      <?=($product_ldesc)?>
				  </div>
			  </div>
		  </main>
<?php 
	include_once("php/footer.php");
?>
				<script src="/scripts/base.js"></script>
<?php 
				}
			}
		}
	} else {
		header("Location: /products");
		echo '<meta http-equiv="refresh" content="0; url=/product.php">';
	}
?>
	</body>
</html>
