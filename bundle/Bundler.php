<?php
namespace Bundle;

use Bundle\Environment\Environment;

class Bundler {
	function __construct() {
		// require(__DIR__ . "/Routes.php");
		if (file_exists(__DIR__ . "/../.env") && file_exists(__DIR__ . "/../vendor/autoload.php")) {
			require __DIR__ . '/../vendor/autoload.php';
		} else {
			if (file_exists(__DIR__ . "/../app/Helper/AppViews/no-setup-done-error.php"))
				require __DIR__ . "/../app/Helper/AppViews/no-setup-done-error.php";
			else
				echo "No Setup Command Ran!! Run <code>composer run setup</code>";
			die();
		}

		// Loading .env file from Root Directory
		require __DIR__ .'/Environment/Environment.php';
		$environment = new Environment();
		$environment->setenv();

		// Global Helper Functions exist in below file
		require __DIR__ . '/HelperFunction.php';
	}

	public function bundle() {
		try {
			require(__DIR__ . "/Routes.php");
		} catch (\Exception $err) {
			print_r($err);
		}
	}
}
