<header class="header-container">
	<a href="index.html" class="home-link">
		<div class="logo-container">
			<div class="logo-container-box rotate">
				<img class="logo-main" src="images/logo-color.png" alt="">
			</div>
			<div class="logo-txt">
				Umiya IT Sales and Services
			</div>
		</div>
	</a>
	<nav class="navbar">
		<div class="hamburger">
			<img class="hamburger-img" src="images/hamburger.svg" alt="#">
		</div>
		<div class="navbar-link-container">
			<div class="close-icon-show close-icon">
				<img class="close-icon-img" src="images/close-x.svg" alt="X">
			</div>
			<ul class="navbar-ul">
				<li class="navbar-li">
					<a class="navbar-link" href="product.html">Our Products</a>
				</li>
				<li class="navbar-li">
					<a class="navbar-link" href="services.html">Our Services</a>
				</li>
				<li class="navbar-li">
					<a class="navbar-link" href="#Contact_Us">Contact Us</a>
				</li>
				<li class="navbar-li">
					<a class="navbar-link" href="#About_Us">About Us</a>
				</li>
<?php 
	$current_filename = $_SERVER['PHP_SELF'];
	if (isset($_SESSION["current_user"])) {
		$current_user = strtoupper($_SESSION["current_user"]);
?>
				<li class="navbar-li">
					<a class="navbar-link logout" href="signup.html">
						<?=htmlspecialchars($current_user);?>
					</a>
<?php 
		if ($current_filename != "/logout.html") {
?>
					<a class="navbar-link logout logout-img-container" href="logout.html">
						 <img src="images/logout.svg" class="logout-img" alt="Logout">
					</a>
				</li>
<?php
		} else {
?>
</li>
<?php
		}
?>
<?php
	} else {
			if ($current_filename == "/logout.html") {
				header("Location: login.html");
				exit();
			}
?>
	<li class="navbar-li">
		<a class="navbar-link" href="login.html">Sign In</a>
		</li>
<?php
	}
?>
			</ul>
		</div>
	</nav>
</header>
