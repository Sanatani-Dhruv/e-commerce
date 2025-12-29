<?php
	include_once("php/general-session-variable.php");
	include_once('php/general-functions.php');
	include_once('php/config.php');
?>
<?php 
	if (isset($_SESSION["current_user"])) {
		// echo "<pre>";
		// print_r($_POST);
		// print_r ($_SESSION);
		// echo "</pre><br>";
		$user_id = $_SESSION["current_user_id"];
		try {
		} catch (Exception $err) {
			echo "<h3>DB Error: </h3><pre>" . $err;
			echo "</pre>";
		}
		if (isset($_POST["type"])) {
			if ($_POST["type"] == "hardware") {
				// echo "<strong>From Product Page</strong>";
				$product_id = $_POST["product-id"];
				$quantity = $_POST["quantity"];
				unset($_POST);

				try {
					$check_quantity_sql = "SELECT SUM(item_quantity) FROM cart_items WHERE user_id = $user_id AND product_id = $product_id";
					$check_quantity_result = mysqli_query($conn, $check_quantity_sql);

					if (mysqli_num_rows($check_quantity_result) == 1) {
						while ($check_quantity_row = mysqli_fetch_assoc($check_quantity_result)) {
							$get_sum_from_db = $check_quantity_row["SUM(item_quantity)"];
							if ($get_sum_from_db == NULL) {
								$insert_into_db_sql = "INSERT INTO cart_items (user_id, product_id, item_quantity) VALUES ($user_id, $product_id, $quantity)";
								$insert_into_db_result = mysqli_query($conn, $insert_into_db_sql);
							} else {
								$update_quantity_db_sql = "UPDATE cart_items SET item_quantity = $quantity WHERE user_id = $user_id AND product_id = $product_id;";
								$update_quantity_db_result = mysqli_query($conn, $update_quantity_db_sql);
							}
						}
					}
				} catch (Exception $err) {
					echo "<h3>DB Error: </h3><pre>" . $err;
					echo "</pre>";
				}
			} else {

			}
		}


		// try {
		// 	$get_from_cart_sql = "SELECT u.user_id, c.cart_items_id, p.product_id, p.product_name,p.product_imagepath, p.product_shortdesc, p.product_price, p.product_stock, sum(item_quantity) as incart_quantity FROM users AS u INNER JOIN cart_items AS c ON c.user_id = u.user_id INNER JOIN products AS p ON p.product_id = c.product_id where p.product_id = $product_id and u.user_id = $user_id;";
		// 	$get_from_cart_result = mysqli_query($conn, $get_from_cart_sql);
        //
		// 	if (mysqli_num_rows($get_from_cart_result) > 0) {
		// 		while ($row = mysqli_fetch_assoc($get_from_cart_result)) {
		// 			echo $row["incart_quantity"];
		// 		}
		// 	}
		// } catch (Exception $err) {
		// 	echo "DB ERROR: $err";
		// }

	} else {
		header("Location: login.php");
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Your Cart - IT Sales and Services Website</title>
		<link rel="icon" href="images/logo-monodark.png">
		<link rel="stylesheet" href="styles/header.css" media="all">
		<link rel="stylesheet" href="styles/general.css" media="all">
		<link rel="stylesheet" href="styles/login.css" media="all">
		<link rel="stylesheet" href="styles/footer-part.css" media="all">
		<link rel="stylesheet" href="styles/store-page-general.css" media="all">
		<link rel="stylesheet" href="styles/store-page-items.css" media="all">
		<link rel="stylesheet" href="styles/store-page-single.css" media="all">
		<link rel="stylesheet" href="styles/cart-page.css" media="all">
	</head>
	<body class="body <?= htmlspecialchars($_SESSION['colorscheme']) ?>">
<?php 
	include_once("php/header.php");
?>
		<main class="main-container">
			<h1 class="cart-page-title">Your Cart</h1>
			<div class="cart-page-container">
<?php
					$get_from_cart_sql = "SELECT u.user_id, c.cart_items_id, p.product_id, p.product_name, p.product_imagepath, p.product_shortdesc, p.product_price, p.product_stock, (item_quantity) as incart_quantity FROM users AS u INNER JOIN cart_items AS c ON c.user_id = u.user_id INNER JOIN products AS p ON p.product_id = c.product_id where u.user_id = $user_id order by cart_items_id desc;";
					$get_from_cart_result = mysqli_query($conn, $get_from_cart_sql);

					if (mysqli_num_rows($get_from_cart_result) > 0) {
						while ($row = mysqli_fetch_assoc($get_from_cart_result)) {
?>
				<div class="cart-info-container">
					<div class="cart-container-1">
						<img class="cart-container-img" src="<?=$row["product_imagepath"]?>" alt="<?=$row["product_name"]?>">
					</div>
					<div class="cart-container-2">
						<h2 class="cart-product-title"><?=$row["product_name"]?></h2>
						<div class="cart-product-sdesc">
							<h4><?=$row["product_shortdesc"]?></h4>
						</div>
						<hr class="product-page-hr">
						<div class="cart-product-price"><sup>₹</sup> <?=$row["product_price"]?></div>
						<div class="cart-product-qauntity"><strong>Cart Quantity:</strong> <?=$row["incart_quantity"]?></div>
						<a class="cart-product-btn-link" href="product-page.php?product_id=<?=$row["product_id"]?>">
							<button class="cart-product-btn">Update Cart</button>
						</a>
					</div>
				</div>
<?php
						}
					}
?>
			</div>
		</main>
<?php 
	include_once("php/footer.php");
?>
		<script src="scripts/base.js"></script>
	</body>
</html>
