<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>JSON Parsing with PHP</title>
	<link rel="stylesheet" href="css.css">
	<style>
		.title {
			margin: 0 auto;
			display: inline-block;
			text-align: center;
		}
		
		* {
			font-family: Arial, sans-serif;
		 }

		body {
			text-align: center;
		}

		main {
			padding: 0;
			margin: 20px;
			display: flex;
			gap: 10px;
			text-align: initial;
			flex-wrap: wrap;
			box-sizing: border-box;
		}

		.json-element {
			padding: 15px 25px;
			background-color: darkred;
			width: 270px;
			margin: 10px auto;
			border-radius: 25px;

		}
	</style>
	</head>
	<body style="background-color: black;color: white;">
		<h1 class="title">
			PHP Parser Created without AI
		</h1>
		<main>
		<?php
			$json_file_content = file_get_contents('json.json');

			if ($json_file_content === false) {
				die('Error Reading File');
			}

			$json_file_array = json_decode($json_file_content, true);

			if ($json_file_array === null) {
				die('Error decoding File');
			}

			for ($i = 0; $i < sizeof($json_file_array); $i++) {
				echo "<div class='json-element json-element-" . $i . "'>";
				echo "Sr. No: ". $i+1 . "<br>" ;
				echo "ID: " . $json_file_array[$i]['id'] . "<br>";
				echo "NAME: " . $json_file_array[$i]['name'] . "<br>";
				echo "LANGUAGE: " .  $json_file_array[$i]['language'];
				echo "</div>";
			}
		?>
		</main>
	</body>
</html>
