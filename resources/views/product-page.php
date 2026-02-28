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
if (isset($invalidId) && !$invalidId) :
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
				  <span class="current-location"><?=($response['product_name'])?></span>
			  </div>
		  </div>
		  <main class="main-container">
			  <div class="product-container-1">
				<div class="product-left-part-container">
					<div class="product-image-container">
						<img class="product-image" src="/<?=out($response['product_imagepath'])?>" alt="<?=out($response['product_name'])?>">
					</div>
				</div>
				<div class="product-right-part-container">
					<div class="product-right-part">
						<div class="product-showcase-title">
							<h2>
								<?=out($response['product_name'])?>
							</h2>
						</div>
						<div class="product-showcase-sdesc">
							<h4>
								<?=out($response['product_shortdesc'])?>
							</h4>
						</div>
						<hr class="product-page-hr">
						<div class="product-showcase-price"><sup>₹</sup> <?=out($response['product_price'])?></div>
						<div class="product-showcase-stock">
							<strong>Stock:</strong> <?=($response['product_stock'])?>
							<div class="product-showcase-post-stock-message <?=out($stock_enum) ? 'true' : 'false';?>"><?=out($post_stock_text)?></div>
						</div>
<?php 
if ($stock_enum) :
?>
					<form action="/user.php#cart" method="post">
						<input type="hidden" id="type" name="type" value="hardware">
						<input type="hidden" id="redirect_location" name="redirect_location" value="<?=url('get') . "?product_id=" . $response["product_id"]?>">
						<div class="product-showcase-btns-container">
							<div class="product-showcase-how-much-addcart">
								Quantity: <input name="quantity" class="product-showcase-how-much-addcart-input" value="<?=out($quantity_from_db)?>" min="1" max="<?=$response["product_stock"]?>" type="number">
							</div>
							<div class="product-showcase-addcart-btn-container">
								<button name="product-id" value="<?=out($product_id)?>" class="product-showcase-addcart-btn login-btn submit <?=out($stock_enum) ? 'true' : 'false';?>">Add To Cart</button>
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
	if (isset($error)):
?>
	<div class="php-status-error-message" id="error" style="font-size: 1.5rem;"><?=out($_REQUEST['error'])?></div>
<?php
		endif;
?>
<?php
endif;
?>
					</div>
				</div>
			  </div>
			  <div class="product-container-2">
				  <div class="product-ldesc-container">
					  <h3 class="ldesc-title">Product Description</h3>
					  <?=($response['product_longdesc'])?>
				  </div>
			  </div>
<?php else : ?>
<h2 style="color: crimson;">Error:</h2>
<h3>No Such Product Found With ID: <?= $id ?></h3>
<?php endif; ?>
		  </main>
<?php 
include_once("php/footer.php");
?>
				<script src="/scripts/base.js"></script>
	</body>
</html>
