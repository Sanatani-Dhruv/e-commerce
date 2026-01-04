<?php
	function clean_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}	

	function nodetailfound() {
		echo "<div class='php-no-detail-found'>";
		echo "No Account Found with Such Details!";
		echo "</div>";
	}

	function detailfound() {
		echo "<div class='php-status-success-message'>";
		echo "Login Successful!";
		echo "</div>";
	}
?>
