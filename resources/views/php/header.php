<header class="header-container">
	<a href="/" class="home-link">
		<div class="logo-container">
			<div class="logo-container-box rotate">
				<img class="logo-main" src="/images/logo-color.png" alt="">
			</div>
			<div class="logo-txt">
				IT Sales and Services
			</div>
		</div>
	</a>
	<nav class="navbar">
		<div class="hamburger">
			<img class="hamburger-img" src="/images/hamburger.svg" alt="#">
		</div>
		<div class="navbar-link-container">
			<div class="close-icon-show close-icon">
				<img class="close-icon-img" src="/images/close-x.svg" alt="X">
			</div>
			<ul class="navbar-ul">
				<li class="navbar-li">
					<a class="navbar-link" href="/products">Our Products</a>
				</li>
				<li class="navbar-li">
					<a class="navbar-link" href="/services">Our Services</a>
				</li>
				<li class="navbar-li">
					<a class="navbar-link" href="/contact">Contact Us</a>
				</li>
				<li class="navbar-li">
					<a class="navbar-link" href="/about">About Us</a>
				</li>
<?php 
	$current_filename = $_SERVER['PHP_SELF'];
	if (isset($_SESSION["current_user"])) {
		$current_user = strtoupper($_SESSION["current_user"]);
?>
				<li class="navbar-li">
				<a class="navbar-link logout" href="<?=($current_user == "ADMIN")? '/admin' : '/user' ?>">
						<?=htmlspecialchars($current_user);?>
					</a>
<?php 
		if ($current_filename != "/logout") {
?>
					<a class="navbar-link logout logout-img-container" href="logout.php">
						 <img src="/images/logout.svg" class="logout-img" alt="Logout">
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
		// if ($current_user == "ADMIN") {
		// 	echo "<div class='admin-panel-btn'>Admin-Panel</div>";
		// }
	} else {
			if ($current_filename == "/logout") {
				header("Location: login");
				exit();
				echo '<meta http-equiv="refresh" content="0; url=/login">';
				echo '<meta http-equiv="refresh" content="0; url=/login">';
			}
?>
	<li class="navbar-li">
		<a class="navbar-link" href="login">Sign In</a>
		</li>
<?php
	}
?>
				<span id="ctb" style="cursor: pointer;">
					<img id="ctb-img" src="/images/dark-mode.svg" alt="">
				</span>
			</ul>
		</div>
	</nav>
</header>
