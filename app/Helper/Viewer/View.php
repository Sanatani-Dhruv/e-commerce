<?php
namespace App\Helper\Viewer;

use App\Helper\Router\Route;

class View {
	private $uri;
	private $viewLocation;

	function __construct() {
		//
	}

	public function view($viewName, array $keyValue = []) {
		$this::instantView($viewName, $keyValue);
	}


	public static function instantView($viewName, array $keyValue = []) {
		$viewLocation = __DIR__ . "/../../../resources/views/";

		if (file_exists($viewLocation . $viewName)) {
			if (count($keyValue)) {
				extract($keyValue);
			}
			require($viewLocation . $viewName);
		} else {
			if (file_exists(__DIR__ . "/../AppViews/view-notfound-error.php")) {
				require(__DIR__ . "/../AppViews/view-notfound-error.php");
			} else {
				echo "<pre>View Not Found</pre>";
			}
		}
	}
}
