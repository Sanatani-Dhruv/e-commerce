<?php
	include_once("php/general-session-variable.php");
	include_once('php/general-functions.php');
	include_once('php/config.php');

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

					$get_total_stock_sql = "SELECT product_stock FROM products WHERE product_id = $product_id";
					$get_total_stock_result = mysqli_query($conn, $get_total_stock_sql);

					if (mysqli_num_rows($get_total_stock_result) == 1) {
						while ($get_total_stock_row = mysqli_fetch_assoc($get_total_stock_result)) {
							$get_total_stock_result_final = $get_total_stock_row["product_stock"];
							// echo "Stock Result: $get_total_stock_result_final";
						}
					}

					if (mysqli_num_rows($check_quantity_result) == 1) {
						if ($get_total_stock_result_final >= $quantity) {
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
						} else {
							$error = "Requested quantity is greater than available stock";
							header("Location: /product-page.html?product_id=$product_id&error=$error#error");
							echo "<meta http-equiv='refresh' content='0; url=/product-page.html?product_id=$product_id&error=$error#error'";
							header("Location: /product-page.php?product_id=$product_id&error=$error#error");
							echo "<meta http-equiv='refresh' content='0; url=/product-page.php?product_id=$product_id&error=$error#error'";
						}
					}
				} catch (Exception $err) {
					echo "<h3>DB Error: </h3><pre>" . $err;
					echo "</pre>";
				}
			} else {

			}
		}

		if (isset($_REQUEST['product_id']) and isset($_REQUEST['delete']) and $_REQUEST['delete'] == "true") {
			$delete_cart_item_sql = "DELETE FROM cart_items WHERE `product_id` = " . $_REQUEST['product_id'] . " and `user_id` = $user_id";
			// echo $delete_cart_item_sql;
			$delete_cart_item_result = $conn->query($delete_cart_item_sql);
		}


		// Get Total Products available in User Cart
		$get_total_no_of_products_sql = "SELECT COUNT(user_id) AS product_in_cart FROM user_cart WHERE user_id = $user_id;";
		$get_total_no_of_products_result = $conn->query($get_total_no_of_products_sql);
		if (mysqli_num_rows($get_total_no_of_products_result) == 1) {
			$get_total_no_of_products_row = mysqli_fetch_assoc($get_total_no_of_products_result);
			$total_products_in_user_cart = $get_total_no_of_products_row['product_in_cart'];
			// echo "Total products in user cart: " . $total_products_in_user_cart;
		}

		// Get user detail
		// $get_user_detail_sql = "SELECT user_id AS id, user_name AS name, user_email AS email, user_number AS number FROM users WHERE `user_id` = $user_id;";
		$get_user_detail_sql = "SELECT * FROM users WHERE `user_id` = $user_id;";
		$get_user_detail_result = $conn->query($get_user_detail_sql);

		if (mysqli_num_rows($get_user_detail_result) == 1) {
			while ($get_user_detail_row = mysqli_fetch_assoc($get_user_detail_result)) {
				// echo "<pre>";
				// print_r($get_user_detail_row);
				// echo "</pre>";
				$user_name = $get_user_detail_row['user_name'];
				$user_email = $get_user_detail_row['user_email'];
				$user_number = $get_user_detail_row['user_number'];
			}
		}

	} else {
		$_SESSION['redirect_location'] = $_REQUEST['redirect_location'];
		header("Location: login.php");
		echo '<meta http-equiv="refresh" content="0; url=/login.php">';
	}


	// Get Cart details for display
	$get_from_cart_sql = "SELECT u.user_id, c.cart_items_id, p.product_id, p.product_name, p.product_imagepath, p.product_shortdesc, p.product_price, p.product_stock, (item_quantity) as incart_quantity FROM users AS u INNER JOIN cart_items AS c ON c.user_id = u.user_id INNER JOIN products AS p ON p.product_id = c.product_id where u.user_id = $user_id order by cart_items_id desc;";
	$get_from_cart_result = mysqli_query($conn, $get_from_cart_sql);


?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Profile - IT Sales and Services Website</title>
		<link rel="icon" href="images/logo-monodark.png">
		<link rel="stylesheet" href="styles/header.css" media="all">
		<link rel="stylesheet" href="styles/general.css" media="all">
		<link rel="stylesheet" href="styles/login.css" media="all">
		<link rel="stylesheet" href="styles/footer-part.css" media="all">
		<link rel="stylesheet" href="styles/store-page-general.css" media="all">
		<link rel="stylesheet" href="styles/store-page-items.css" media="all">
		<link rel="stylesheet" href="styles/store-page-single.css" media="all">
		<link rel="stylesheet" href="styles/user-page.css" media="all">
	</head>
	<body id="body" class="body">
<?php 
	include_once("php/header.php");
?>
		<main class="main-container">
			<h1 id="profile" class="cart-page-title">Your Profile</h1>

			<section class="profile-section">
				<section class="username-section">
					User Name: <div class="name"><?=htmlspecialchars(ucfirst( $user_name ))?></div>
				</section>
				<section class="key-value-section">
					<div class="key-value">
							<div class="value">
								<?=htmlspecialchars($user_number)?>
							</div>
							<div class="key">Mobile Number</div>
					</div>
					<hr>
					<div class="key-value">
							<div class="value">
								<?=htmlspecialchars($user_email)?>
							</div>
							<div class="key">Email</div>
					</div>
					<hr>
					<div class="key-value">
							<div class="value">
								<?=htmlspecialchars($total_products_in_user_cart)?>
							</div>
							<div class="key">In Cart</div>
					</div>
				</section>
				<button class="login-btn submit" style="width: fit-content;margin-left: auto;">Update Profile</button>
			</section>


<?php
					if (mysqli_num_rows($get_from_cart_result) > 0) {
?>
			<h1 id="cart" class="cart-page-title">Your Cart</h1>
			<div class="cart-page-container">
<?php
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
						<a class="cart-product-btn-link" href="<?=$_SERVER['PHP_SELF'] . "?product_id=". $row['product_id'] ."&delete=true#cart"?>">
							<button class="cart-product-btn danger-btn">Remove from Cart</button>
						</a>
					</div>
				</div>
<?php
						}
?>
				<button class="login-btn checkout-btn">
					Checkout Cart
				</button>
<?php
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
