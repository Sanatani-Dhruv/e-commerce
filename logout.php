<?php
	include_once("php/general-session-variable.php");
	include_once("php/config.php");
	include_once("php/general-functions.php");
?>
<?php 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	if (isset($_POST["submit"])) {
		echo $_SESSION["current_user"];
		unset($_SESSION["current_user"]);
		echo $_SESSION["current_user"];
		header("Location: login.php");
		exit();
		echo '<meta http-equiv="refresh" content="0; url=/login.php">';
	} else {
		header("Location: index.php");
		exit();
		echo '<meta http-equiv="refresh" content="0; url=/index.php">';
	}
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Login - IT Sales and Services Website</title>
		<link rel="icon" href="images/logo-monodark.png">
		<link rel="stylesheet" href="styles/header.css" media="all">
		<link rel="stylesheet" href="styles/general.css" media="all">
		<link rel="stylesheet" href="styles/view-page.css" media="all">
		<link rel="stylesheet" href="styles/info-page.css" media="all">
		<link rel="stylesheet" href="styles/footer-part.css" media="all">
		<link rel="stylesheet" href="styles/login.css" media="all">
	</head>
	<body class="body <?= htmlspecialchars($_SESSION['colorscheme']) ?>">
<?php
	include_once("php/header.php");
?>
		  <main class="main-container">
		  <form class="logout" action="<?=htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
				  <div class="login-container-box">
					  <h2 class="login-title">Logout out of account</h2>
					  <div class="login-container">
						  <div class="login-input-container">
							  <h3 class="logout-confirm-msg">Are Sure You want to Logout?</h3>
						  </div>
						  <div class="login-input-container">
							  <input class="login-btn reset" name="submit" type="submit" value="Confirm">
							  <input class="login-btn submit" name="reset" type="submit" value="Go back">
						  </div>
					  </div>
				  </div>
			  </form>
		  </main>
<?php
	include_once("php/footer.php");
?>
	<script src="scripts/base.js"></script>
</body>
</html>
