<?php
	include_once("php/general-session-variable.php");
	include_once('php/config.php');
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
	<body id="body" class="body">
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
					<input name="item-type" type="hidden" value="product">
					<div class="input-container">
						<div class="admin-label">Product name: </div>
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
		if ($_SERVER["REQUEST_METHOD"] === "POST" && $_POST["item-type"] === "product" /* && $_POST["product-name"] != $_SESSION['sproduct_name'] */) {
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
								<td class="product-list-item"><?=($row["product_id"])?></td>
								<td class="product-list-item"><?=($row["product_name"])?></td>
								<td class="product-list-item"><?=($row["product_shortdesc"])?></td>
								<td class="product-list-item"><?=($row["product_longdesc"])?></td>
								<td class="product-list-item"><?=($row["product_stock"])?></td>
								<td class="product-list-item">₹<?=($row["product_price"])?></td>
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

					<fieldset class="admin-fieldset">
						<legend class="admin-legend">
							<h3 class="products-category-title admin-legend-head">
								Add New Service
							</h3>
						</legend>
						<form action="<?=htmlspecialchars($_SERVER['PHP_SELF']);?>" class="product-form admin-form" method="POST" enctype="multipart/form-data">
							<input name="item-type" type="hidden" value="service">
							<div class="input-container">
								<div class="admin-label">Service name: </div>
								<input id="service-name" min="5" pattern="[A-Za-z0-9()'.\-_ ]*" class="product-insert-input" placeholder="Enter Name" type="text" name="service-name" required>
							</div>
							<div class="input-container">
								<div class="admin-label">Service Short Description: </div>
								<textarea id="service-sdesc" min="5" rows="3" class="product-insert-input admin-textarea" name="service-sdesc" placeholder="Enter Short Description about service" required></textarea>
							</div>
							<div class="input-container">
								<div class="admin-label">Service Long Description: </div>
								<textarea id="service-ldesc" min="5" rows="6" class="product-insert-input admin-textarea" name="service-ldesc" placeholder="Enter Long Description about service" required></textarea>
							</div>
							<div class="input-container">
								<div class="admin-label">Service Availability: </div>
								<!-- <input id="service-stock" min="1" max="10000" placeholder="Enter Available Stock" class="product-insert-input" type="number" name="service-stock" required> -->
								<label for="service-status-yes">
									Available <input id="service-status-yes" type="radio" name="service-status" value="available">
								</label>
								<label for="service-status-no">
									Not Available <input id="service-status-no" type="radio" name="service-status" value="not_available">
								</label>
							</div>
							<div class="input-container">
								<div class="admin-label">Service Cost: </div>
								<input id="service-price" min="1" max="100000" placeholder="Enter Price for service" class="product-insert-input" type="number" name="service-price" required>
							</div>
							<div class="input-container">
								<div class="admin-label">Service Image: </div>
								<!-- MAX_FILE_SIZE must precede the file input field -->
								<!-- <input type="hidden" name="MAX_FILE_SIZE" value="3000" />	 -->
								<input id="service-image" class="product-insert-input" type="file" name="service-image">
							</div>
<?php
		echo "Before POST and session, service check";
		if ($_SERVER["REQUEST_METHOD"] === "POST" && $_POST["item-type"] === "service" /* && $_POST["service-name"] != $_SESSION['sservice_name'] */) {
			// echo "<br>In Post and no already same service";
			try {
				// echo "<div>try start</div>";
				$check_service_exist_sql = "select service_name from services where service_name = \"".$_POST["service-name"]."\";";
				if ($check_service_exist = $conn->query($check_service_exist_sql)) {
					// echo "query true";
					// echo "<br>";
				} else {
					// echo "query false";
					// echo "<br>";
				}

				$service_exist_status = "false";
				if ($check_service_exist->num_rows > 0) {
					echo "<div>Service Exists</div>";
					while ($row = $check_service_exist->fetch_assoc()) {
						// echo "while loop running....";
						if ($row["service_name"] == clean_input($_POST['service-name'])) {
							global $service_exist_status;
							$service_exist_status = "true";
							// echo "<div>After Check: $service_exist_status</div>";
							break;
						}
					}
				}

			} catch (Exception $err) {
				echo "<b><div class='php-status-error-message'>Server Side Error: Error in processing query</div><br></b>";
				// echo "<br>Error: <pre class='php-status-error-message'>$err</pre>";
			}

			if ($service_exist_status == "false") {
				// echo "Service Not Exists";
				// Handling service details from POST
				$_SESSION['sservice_name'] = clean_input($_POST["service-name"]);
				$_SESSION['sservice_sdesc'] = clean_input($_POST["service-sdesc"]);
				$_SESSION['sservice_ldesc'] = clean_input($_POST["service-ldesc"]);
				$_SESSION['sservice_status'] = clean_input($_POST["service-status"]);
				$_SESSION['sservice_price'] = clean_input($_POST["service-price"]);

				if ($_SESSION['sservice_status'] == 'available') {
					$_SESSION['sservice_status'] = 'available';
				} else {
					$_SESSION['sservice_status'] = 'not_available';
				}

				// echo "<div>Got POST Values in SESSION</div>";
				// Handling service image upload from POST
				$image_got = 0;
				if (isset($_FILES["service-image"]) /* && $_FILES["service-image"]["error"] == 0 */) {
					$image_got = 1;
					$image_upload_status = 0;
					$image_dir = "images/services/";
					$image_extensions = array("jpeg", "jpg", "png", "gif");
					// echo "<pre>";
					// print_r($_FILES);
					// echo "</pre>";
					$image_name = $image_dir . basename($_FILES["service-image"]["name"]);
					$image_type = strtolower(pathinfo($image_name,PATHINFO_EXTENSION));
					// echo "Image Directory: $image_dir";
					// echo "<div></div>";
					// echo "Image name: $image_name";
					// echo "<div></div>";
					// echo "Image Upload Status: $image_upload_status";
					// echo "<div></div>";

					// Check if image file is a actual image or fake image
					$check_image_size = $_FILES["service-image"]["size"];
					// echo "Image size: $check_image_size";
					// if (!($check_image_size = getimagesize($_FILES["service-image"]))) {
					if ($check_image_size !== 0) {
						// echo "<div></div>";
						if (in_array($image_type, $image_extensions) === true) {
							// echo "Image type: $image_type";
							// echo "<div></div>";
						}
						else {
							$image_got = 0;
							// echo "File is not an image.";
						}
					} 						
					$_SESSION['sservice_imagepath'] = $image_name;
					// echo "<div>Image Name Stored in SESSION</div>";
				}

				try {
					// echo "<div>Try Started for DB QUERY</div>";
					$stmt = $conn->prepare("INSERT INTO services (service_name, service_shortdesc, service_longdesc, service_status, service_price, service_imagepath) VALUES (?, ?, ?, ?, ?, ?)");

					$stmt->bind_param("ssssss", $_SESSION['sservice_name'], $_SESSION['sservice_sdesc'], $_SESSION['sservice_ldesc'], $_SESSION['sservice_status'], $_SESSION['sservice_price'],$_SESSION['sservice_imagepath']);
					$stmt->execute(); // Uploaded Data

					echo "<div>Parameters executed</div>";

					if ($image_got) {
						// echo "<div>Image Got!</div>";
						if (move_uploaded_file($_FILES['service-image']['tmp_name'], $image_name)) {
							chmod($image_name, 0755);
							// echo "<div>Pictures uploaded</div>";
						} else {
							// echo "<div>Pictures <b>not</b> uploaded</div>";
						}
					}

					$sql_id_get = "select max(service_id) from services;";
					$result = $conn->query($sql_id_get);

					if ($result->num_rows > 0) {
						// output data of each row
						while($row = $result->fetch_assoc()) {
							$_SESSION["lastinsert_id"] = $row["max(service_id)"];
						}
					} else {
						echo "0 results";
					}
					unset ($_POST["service-name"]);

					echo "<div class='php-status-message'>";
					echo "New Service added successfully with Service id ". $_SESSION["lastinsert_id"];
					echo "</div>";
				} catch (Exception $err) {
					echo "Error: " . $sql . "<br>" . $conn->error;
				}
			} else {
				echo "<div class='php-status-error-message'>";
				echo "Service With Same Name Already Exists";
				echo "</div>";
			}
		} 
?>
							<div class="input-container admin-btn-container">
								<input type="submit" id="submit" name="submit" class="login-btn admin-btn submit admin-btn-green" value="Add New Service To Database">
								<input type="reset" id="reset" name="reset" class="login-btn admin-btn reset admin-btn-red" value="Reset Fields">
							</div>
						</form>
					</fieldset>
				<h3 class="products-category-title">
					Product List
				</h3>

<?php
		$sql = "select * from services";
		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) > 0) {
			echo "<div class='table-overflow-wrapper'>";
			echo "<table class='item-list-table'";
?>
					<thead>
						<tr class="product-list-tr">
							<th class="product-list-item">Service ID</th>
							<th class="product-list-item">Service Name</th>
							<th class="product-list-item">Service Short Desc</th>
							<th class="product-list-item">Service Long Desc</th>
							<th class="product-list-item">Service Status</th>
							<th class="product-list-item">Service Price</th>
							<th class="product-list-item">Service Image Path</th>
						</tr>
					</thead>
<?php
			echo "<tbody>";
			// output data of each row
			while($row = mysqli_fetch_assoc($result)) {
				// echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
?>
							<tr class="product-list-tr">
								<td class="product-list-item"><?=($row["service_id"])?></td>
								<td class="product-list-item"><?=($row["service_name"])?></td>
								<td class="product-list-item"><?=($row["service_shortdesc"])?></td>
								<td class="product-list-item"><?=($row["service_longdesc"])?></td>
								<td class="product-list-item"><?=($row["service_status"])?></td>
								<td class="product-list-item">₹<?=($row["service_price"])?></td>
								<td class="product-list-item">
									<a class="product-list-item-imagelink" target="_blank" title="View Image" href="<?=htmlspecialchars($row['service_imagepath'])?>">
										<?=htmlspecialchars($row["service_imagepath"])?>
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
		  <meta http-equiv="refresh" content="0; url=login.html" /> <!-- Fallback, in whatever case above doesn't work  -->
		  <meta http-equiv="refresh" content="0; url=login.php" /> <!-- Fallback, in whatever case above doesn't work  -->
<?php
	}
?>
		 <script src="scripts/base.js"></script>
	</body>
</html>
