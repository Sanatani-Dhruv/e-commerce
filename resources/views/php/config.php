<?php
	// If mysqli error reporting is enabled (MYSQLI_REPORT_ERROR) and the
	// requested operation fails, a warning is generated. If, in addition, the mode
	// is set to MYSQLI_REPORT_STRICT, a mysqli_sql_exception is thrown instead.


	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

	// Basic connection settings
	$databaseHost = env('DB_HOST');
	$databaseUsername = env('DB_USER');
	$databasePassword = env('DB_PASS');
	$databaseName = env('DB_NAME');

	// Connect to the database
	try {
		// For Procedure Oriented Method
		// $mysqli_connection = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName); 

		// For Object Oriented Method
		$conn = new mysqli($databaseHost, $databaseUsername, $databasePassword, $databaseName);

		// if ($conn->connect_error) {
		// 	die("Connection failed: " . $dbc->connect_error);
		// }

		// Success Comment
		echo "<!-- Connection to DB Successful! -->\n";
	} catch (Exception $e) {
		echo "<pre style='padding: 6px 3%;white-space: pre-wrap;font-size: 15px;'>";
		echo "<h2 style='margin: 10px 0 0k'>Error Caught!</h2>\n";
		echo "<b>Connection Error:</b> $e";
		echo "</pre>";
	}

	// PDO Method to Connect

	// try {
	// 	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	// 	// set the PDO error mode to exception
	// 	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	// 	// echo "Connected successfully";
	// 	// $sql = "";
	// 	// $conn->exec($sql);
	// } catch(PDOException $e) {
	// 	echo "Connection Failed: $e->getMessage()";
	// }
?>
