<?php
	include_once("php/general-session-variable.php");
	include_once('php/config.php');
	include_once("php/validate.php");
	include_once("php/general-functions.php");
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta name="viewport" charset="UTF-8" content="width=device-width, initial-scale=1.0"/>
		<title>Admin Panel - IT Sales and Services Website</title>
		<link rel="icon" href="images/logo-monodark.png">
		<link rel="stylesheet" href="styles/header.css" media="all">
		<link rel="stylesheet" href="styles/general.css" media="all">
		<link rel="stylesheet" href="styles/store-page-items.css" media="all">
		<link rel="stylesheet" href="styles/footer-part.css" media="all">
		<link rel="stylesheet" href="styles/admin-panel.css" media="all">
		<link rel="stylesheet" href="styles/login.css" media="all">
	</head>
	<body class="body <?= htmlspecialchars($_SESSION['colorscheme']) ?>">
<?php
if (isset($_SESSION["current_user"]) && $_SESSION["current_user"] === "admin") {
	include_once("php/header.php");
	echo "<h1 class='admin-welcome'>Ram Ram Admin!</h1>";
?>
		<main class="main-container">
			<fieldset class="admin-fieldset">
				<legend class="admin-legend">
					<h3 class="products-category-title admin-legend-head">
						Add New Product
					</h3>			
				</legend>
				<form action="<?=htmlspecialchars($_SERVER['PHP_SELF']);?>" class="product-form admin-form" method="POST" enctype="multipart/form-data">
					<div class="input-container">
						<div class="admin-label">Products name: </div>
						<input id="product-name" min="5" pattern="[A-Za-z0-9()'.\-_ ]*" class="product-insert-input" placeholder="Enter Name" type="text" name="product-name" required>
					</div>
					<div class="input-container">
						<div class="admin-label">Product Short Description: </div>
						<textarea id="product-sdesc" min="5" rows="3" class="product-insert-input admin-textarea" name="product-sdesc" placeholder="Enter Short Description about Product" required></textarea>
					</div>
					<div class="input-container">
						<div class="admin-label">Product Long Description: </div>
						<textarea id="product-ldesc" min="5" rows="6" class="product-insert-input admin-textarea" name="product-ldesc" placeholder="Enter Long Description about Product" required></textarea>
					</div>
					<div class="input-container">
						<div class="admin-label">Product Stock: </div>
						<input id="product-stock" min="1" max="10000" placeholder="Enter Available Stock" class="product-insert-input" type="number" name="product-stock" required>
					</div>
					<div class="input-container">
						<div class="admin-label">Product Price: </div>
						<input id="product-price" min="1" max="100000" placeholder="Enter Price for product" class="product-insert-input" type="number" name="product-price" required>
					</div>
					<div class="input-container">
						<div class="admin-label">Product Image: </div>
						<!-- MAX_FILE_SIZE must precede the file input field -->
						<!-- <input type="hidden" name="MAX_FILE_SIZE" value="3000" />	 -->
						<input id="product-image" class="product-insert-input" type="file" name="product-image">
					</div>
<?php 
	echo "Before POST and session, product check";
	if ($_SERVER["REQUEST_METHOD"] === "POST" /* && $_POST["product-name"] != $_SESSION['sproduct_name'] */) {
		echo "<br>In Post and no already same product";
		try {
			echo "<div>try start</div>";
			$check_product_exist_sql = "select product_name from products where product_name = \"".$_POST["product-name"]."\";";
			if ($check_product_exist = $conn->query($check_product_exist_sql)) {
				echo "query true";
				echo "<br>";
			} else {
				echo "query false";
				echo "<br>";
			}

			$product_exist_status = "false";
			if ($check_product_exist->num_rows > 0) {
				echo "<div>Product Exists</div>";
				while ($row = $check_product_exist->fetch_assoc()) {
					echo "while loop running....";
					if ($row["product_name"] == clean_input($_POST['product-name'])) {
						global $product_exist_status;
						$product_exist_status = "true";
						echo "<div>After Check: $product_exist_status</div>";
						break;
					}
				}
			}

		} catch (Exception $err) {
			echo "<b><div class='php-status-error-message'>Server Side Error: Error in processing query</div><br></b>";
			// echo "<br>Error: <pre class='php-status-error-message'>$err</pre>";
		}

		if ($product_exist_status == "false") {
			echo "Product Not Exists";
			// Handling Product details from POST
			$_SESSION['sproduct_name'] = clean_input($_POST["product-name"]);
			$_SESSION['sproduct_sdesc'] = clean_input($_POST["product-sdesc"]);
			$_SESSION['sproduct_ldesc'] = clean_input($_POST["product-ldesc"]);
			$_SESSION['sproduct_stock'] = clean_input($_POST["product-stock"]);
			$_SESSION['sproduct_price'] = clean_input($_POST["product-price"]);

			echo "<div>Got POST Values in SESSION</div>";
			// Handling Product image upload from POST
			$image_got = 0;
			if (isset($_FILES["product-image"]) /* && $_FILES["product-image"]["error"] == 0 */) {
				$image_got = 1;
				$image_upload_status = 0;
				$image_dir = "images/products/";
				$image_extensions = array("jpeg", "jpg", "png", "gif");
				echo "<pre>";
				print_r($_FILES);
				echo "</pre>";
				$image_name = $image_dir . basename($_FILES["product-image"]["name"]);
				$image_type = strtolower(pathinfo($image_name,PATHINFO_EXTENSION));
				echo "Image Directory: $image_dir";
				echo "<div></div>";
				echo "Image name: $image_name";
				echo "<div></div>";
				echo "Image Upload Status: $image_upload_status";
				echo "<div></div>";

				// Check if image file is a actual image or fake image
				$check_image_size = $_FILES["product-image"]["size"];
				echo "Image size: $check_image_size";
				// if (!($check_image_size = getimagesize($_FILES["product-image"]))) {
				if ($check_image_size !== 0) {
					echo "<div></div>";
					if (in_array($image_type, $image_extensions) === true) {
						echo "Image type: $image_type";
						echo "<div></div>";
					}
					else {
						$image_got = 0;
						echo "File is not an image.";
					}
				} 						
				$_SESSION['sproduct_imagepath'] = $image_name;
				echo "<div>Image Name Stored in SESSION</div>";
			}

			try {
				echo "<div>Try Started for DB QUERY</div>";
				$stmt = $conn->prepare("INSERT INTO products (product_name, product_shortdesc, product_longdesc, product_stock, product_price,product_imagepath) VALUES (?, ?, ?, ?, ?, ?)");

				$stmt->bind_param("ssssss", $_SESSION['sproduct_name'], $_SESSION['sproduct_sdesc'], $_SESSION['sproduct_ldesc'], $_SESSION['sproduct_stock'], $_SESSION['sproduct_price'],$_SESSION['sproduct_imagepath']);
				$stmt->execute(); // Uploaded Data

				echo "<div>Parameters executed</div>";

				if ($image_got) {
					echo "<div>Image Got!</div>";
					if (move_uploaded_file($_FILES['product-image']['tmp_name'], $image_name)) {
						chmod($image_name, 0755);
						echo "<div>Pictures uploaded</div>";
					} else {
						echo "<div>Pictures <b>not</b> uploaded</div>";
					}
				}

				$sql_id_get = "select max(product_id) from products;";
				$result = $conn->query($sql_id_get);

				if ($result->num_rows > 0) {
					// output data of each row
					while($row = $result->fetch_assoc()) {
						$_SESSION["lastinsert_id"] = $row["max(product_id)"];
					}
				} else {
					echo "0 results";
				}
				unset ($_POST["product-name"]);

				echo "<div class='php-status-message'>";
				echo "New Product added successfully with product id ". $_SESSION["lastinsert_id"];
				echo "</div>";
			} catch (Exception $err) {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}
		} else {
			echo "<div class='php-status-error-message'>";
			echo "Product With Same Name Already Exists";
			echo "</div>";
		}
	} 
?>
					   <div class="input-container admin-btn-container">
						   <input type="submit" id="submit" name="submit" class="login-btn admin-btn submit admin-btn-green" value="Add New Product To Database">
						   <input type="reset" id="reset" name="reset" class="login-btn admin-btn reset admin-btn-red" value="Reset Fields">
					   </div>
				</form>
			</fieldset>
			<div class="admin-table-view-container">
				<h3 class="products-category-title">
					Product List
				</h3>			

<?php 
	$sql = "select * from products";
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {
		echo "<div class='table-overflow-wrapper'>";
		echo "<table class='item-list-table'"; 
?>
					<thead>
						<tr class="product-list-tr">
							<th class="product-list-item">Product ID</th>
							<th class="product-list-item">Product Name</th>
							<th class="product-list-item">Product Short Desc</th>
							<th class="product-list-item">Product Long Desc</th>
							<th class="product-list-item">Product Stock</th>
							<th class="product-list-item">Product Price</th>
							<th class="product-list-item">Product Image Path</th>
						</tr>
					</thead>
<?php
		echo "<tbody>";
		// output data of each row
		while($row = mysqli_fetch_assoc($result)) {
			// echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
?>
							<tr class="product-list-tr">
								<td class="product-list-item"><?=htmlspecialchars($row["product_id"])?></td>
								<td class="product-list-item"><?=htmlspecialchars($row["product_name"])?></td>
								<td class="product-list-item"><?=htmlspecialchars($row["product_shortdesc"])?></td>
								<td class="product-list-item"><?=htmlspecialchars($row["product_longdesc"])?></td>
								<td class="product-list-item"><?=htmlspecialchars($row["product_stock"])?></td>
								<td class="product-list-item">₹<?=htmlspecialchars($row["product_price"])?></td>
								<td class="product-list-item">
									<a class="product-list-item-imagelink" target="_blank" title="View Image" href="<?=htmlspecialchars($row['product_imagepath'])?>">
										<?=htmlspecialchars($row["product_imagepath"])?>
									</a>
								</td>
							</tr>
<?php
		}
		echo "</tbody>";
		echo "</table>";
		echo "</div>";
	} else {
		echo "<strong>Empty set</strong>";
	}
?>

			</div>
		</main>
<?php
	include_once("php/footer.php");
?>
<?php
} else {
	header("Location: login.php");
	exit();
?>
				<meta http-equiv="refresh" content="0; url=login.php" /> <!-- Fallback, in whatever case above doesn't work  -->
<?php
}
?>
	   <script src="scripts/base.js"></script>
	</body>
</html>
