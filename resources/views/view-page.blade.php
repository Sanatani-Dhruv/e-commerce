<!-- 					try { -->
<!-- 						if (isset($_SESSION["current_user"])) { -->
<!-- 							$current_user_id = $_SESSION["current_user_id"]; -->
<!--  -->
<!-- 							$get_cart_detail_sql = "SELECT sum(item_quantity) from cart_items where product_id = $product_id and user_id = $current_user_id;"; -->
<!-- 							$get_cart_detail_result = mysqli_query($conn, $get_cart_detail_sql); -->
<!--  -->
<!-- 							if (mysqli_num_rows($get_cart_detail_result) === 1) { -->
<!-- 								while ($get_cart_detail_row = mysqli_fetch_assoc($get_cart_detail_result)) { -->
<!-- 									$quantity_from_db = $get_cart_detail_row["sum(item_quantity)"]; -->
<!-- 									if ($quantity_from_db == NULL) { -->
<!-- 										$quantity_from_db = 1;  -->
<!-- 									} -->
<!-- 								} -->
<!-- 							} else { -->
<!-- 								$quantity_from_db = 1; -->
<!-- 							} -->
<!-- 						} else { -->
<!-- 							$quantity_from_db = 1; -->
<!-- 						} -->
<!-- 					} catch (Exception $err) { -->
<!-- 						echo "DB Error: "; -->
<!-- 						echo "<pre>"; -->
<!-- 						echo "$err"; -->
<!-- 						echo "</pre>"; -->
<!-- 					} -->
<!-- ?> -->

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Product Page - IT Sales and Services Website</title>
		<link rel="icon" href="images/logo-monodark.png">
		<link rel="stylesheet" href="/css/header.css" media="all">
		<link rel="stylesheet" href="/css/general.css" media="all">
		<link rel="stylesheet" href="/css/login.css" media="all">
		<link rel="stylesheet" href="/css/user-page.css" media="all">
		<link rel="stylesheet" href="/css/footer-part.css" media="all">
		<link rel="stylesheet" href="/css/store-page-general.css" media="all">
		<link rel="stylesheet" href="/css/store-page-single.css" media="all">
	</head>
	<body id="body" class="body dark">
		{{ view('parts.header') }}
		  <div class="pathline-container">
			  <div class="pathline">
				  <a class="home-link" href="index.php">
					  <span class="home">Home</span>
				  </a>
				  <span class="path-arrow">&#x3E;</span>
				  <a class="home-link" href="/products">
					  <span class="home">Products</span>
				  </a>
				  <span class="path-arrow">&#x3E;</span>
				  <span class="current-location">{{ $detail_object->product_name }}</span>
			  </div>
		  </div>
		  <main class="main-container">
			  <div class="product-container-1">
			  	<div class="product-left-part-container">
					<div class="product-image-container">
						<img class="product-image" src="{{ $detail_object->product_imagepath }}" alt="{{ $detail_object->product_name }}">
					</div>
				</div>
			  	<div class="product-right-part-container">
					<div class="product-right-part">
						<div class="product-showcase-title">
							<h2>
								{{ $detail_object->product_name }}
							</h2>
						</div>
						<div class="product-showcase-sdesc">
							<h4>
								{{ $detail_object->product_shortdesc }}
							</h4>
						</div>
						<hr class="product-page-hr">
						<div class="product-showcase-price"><sup>₹</sup> {{ $detail_object->product_price }}</div>
						<div class="product-showcase-stock">
							<strong>Stock:</strong> {{ $detail_object->product_stock }}
							<div class="product-showcase-post-stock-message {{ ($stock_status)? 'true' : 'false' }}">{{ $stock_message }}</div>
						</div>
					<!-- if ($stock_available == "true") { -->
					<form action="<!-- /user.php#cart -->" method="post">
						<input type="hidden" id="type" name="type" value="hardware">
						<div class="product-showcase-btns-container">
							<div class="product-showcase-how-much-addcart">
								Quantity: <input name="quantity" class="product-showcase-how-much-addcart-input" value="1" min="1" max="{{ $detail_object->product_stock }}" type="number">
							</div>
							<div class="product-showcase-addcart-btn-container">
								<button name="product-id" value="{{ $detail_object->product_id }}" class="product-showcase-addcart-btn login-btn submit {{ ($stock_status)? 'true' : 'false' }}">Add To Cart</button>
								<br>
								<a class="cart-product-btn-link" href="/user.php#cart">
									<div class="cart-product-btn login-btn submit product-page-cart-btn">
										View Cart
									</div>
								</a>
							</div>
						</div>
					</form>
						<!-- if (isset($_REQUEST['error'])) { -->
	<!-- <div class="php-status-error-message" id="error" style="font-size: 1.5rem;"></div> -->
						<!-- } -->
					<!-- } -->
					</div>
				</div>
			  </div>
			  <div class="product-container-2">
				  <div class="product-ldesc-container" style="white-space: pre-line">
					  <h3 class="ldesc-title">Product Description</h3>
					  {{ $detail_object->product_longdesc }}
				  </div>
			  </div>
		  </main>
		  {{ view('parts.footer') }}
				<script src="scripts/base.js"></script>
	</body>
</html>
