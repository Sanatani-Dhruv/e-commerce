<?php
namespace Bundle;

use App\Helper\Environment;

class Bundler {
	function __construct() {
		// require(__DIR__ . "/Routes.php");
		require __DIR__ . '/../vendor/autoload.php';
		require __DIR__ . '/HelperFunction.php';
		Environment::setenv();
	}

	public function bundle() {
		try {
			require(__DIR__ . "/Routes.php");
		} catch (Exception $err) {
			echo $err;
		}
	}
}
