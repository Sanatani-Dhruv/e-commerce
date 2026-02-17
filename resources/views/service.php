<?php
	include_once('php/config.php');
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Products - IT Sales and Services Website</title>
		<link rel="icon" href="images/logo-monodark.png">
		<link rel="stylesheet" href="styles/header.css" media="all">
		<link rel="stylesheet" href="styles/general.css" media="all">
		<link rel="stylesheet" href="styles/footer-part.css" media="all">
		<link rel="stylesheet" href="styles/store-page-general.css" media="all">
		<link rel="stylesheet" href="styles/store-page-items.css" media="all">
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
				  <span class="current-location">Products</span>
			  </div>
		  </div>
		  <main class="main-container">
			  <div class="products-container">
				  <h2 class="products-category-title">
					  Hardware
				  </h2>
				  <div class="product-listing">
<?php 
	$sql = "select * from products";
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {
					  while ($row = mysqli_fetch_assoc($result)) {
?>
						  <div class='hardware-element-container hardware-element-'>
							  <div class='hardware-element-1 hardware-img-container'>
								  <img class="hardware-img" src="<?=htmlspecialchars($row["product_imagepath"])?>" alt="Hardware-image">
							  </div>
							  <div class="hardware-element-2-container">
								  <div class="hardware-element-2 hardware-text-container">
									  <div class='hardware-element-title hardware-element-1'><?=htmlspecialchars($row["product_name"])?></div>
									  <div class='hardware-element-1 hardware-element-price'>₹<?=htmlspecialchars($row["product_price"])?></div>
									  <div class='hardware-element-1 hardware-element-price'>Stock: <?=htmlspecialchars($row["product_stock"])?></div>
								  </div>
								  <div class="hardware-element-2 hardware-element-addtocart-btn-container">
								  <a class="hardware-element-addtocart-link" href="product-page.php?product_id=<?=htmlspecialchars($row['product_id'])?>">
										  <button class="hardware-element-addtocart-btn">View Product</button>
									  </a>
								  </div>
							  </div>
						  </div>

<?php
					  }
	}
?>
				  </div>
			  </div>
<?php
	try {
		// Try Executing Commands
	} catch (Exception $err) {
		// If Any Exception Comes up, do This
	}
?>
		</main>
<?php
	include_once("php/footer.php");
?>
		<script src="scripts/base.js"></script>
	</body>
</html>
