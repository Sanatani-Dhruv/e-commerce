<?php
	// If mysqli error reporting is enabled (MYSQLI_REPORT_ERROR) and the
	// requested operation fails, a warning is generated. If, in addition, the mode
	// is set to MYSQLI_REPORT_STRICT, a mysqli_sql_exception is thrown instead.

	use Dotenv\Dotenv;

	$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
	$dotenv->load();

	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

	class Config {
		public function __construct () {

			// Basic connection settings
			// Connect to the database
			$databaseHost = $_ENV['DB_HOST'];
			$databaseUsername = $_ENV['DB_USERNAME'];
			$databasePassword = $_ENV['DB_PW'];
			$databaseName = $_ENV['DB_NAME'];

			try {
				$conn = new mysqli($databaseHost, $databaseUsername, $databasePassword, $databaseName);

				// Success Comment
				echo "<!-- Connection to DB Successful! -->\n";
			} catch (Exception $e) {
				echo "<pre style='padding: 6px 3%;white-space: pre-wrap;font-size: 15px;'>";
				echo "<h2 style='margin: 10px 0 0k'>Error Caught!</h2>\n";
				echo "<b>Connection Error:</b> $e";
				echo "</pre>";
			}
		}
	}
?>
