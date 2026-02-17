<?php
namespace Bundle;

use App\Helper\Environment;

class Bundler {
	function __construct() {
		// require(__DIR__ . "/Routes.php");
		try {
			require __DIR__ . '/../vendor/autoload.php';
		} catch (Exception $err) {
			echo "It looks like you didn't ran Startup Command; run <code>composer run setup</code> in ownwork directory!!";
		}
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
