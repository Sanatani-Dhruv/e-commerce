<?php
namespace App\Viewer;

use App\Router\Route;

class View {
	private $uri;
	private $viewLocation1;

	function __construct() {
		//
	}

	public function view($viewName, array $keyValue = []) {
		$this::instantView($viewName, $keyValue);
	}


	public static function instantView($viewName, array $keyValue = []) {
		$viewLocation1 = __DIR__ . "/../../resources/views/";
		$viewLocation2 = __DIR__ . "/../../resources/views/";

		if (file_exists($viewLocation1 . $viewName)) {
			if (count($keyValue)) {
				extract($keyValue);
			}
			require($viewLocation1 . $viewName);
		} else if (file_exists($viewLocation2 . $viewName)) {
			if (count($keyValue)) {
				extract($keyValue);
			}
			require($viewLocation2 . $viewName);
		} else {
			if (file_exists(__DIR__ . "/../Helper/Views/view-notfound-error.php")) {
				$action = $viewName;
				require(__DIR__ . "/../Helper/Views/view-notfound-error.php");
			} else if (file_exists(__DIR__ . "/../Helper/AppViews/view-notfound-error.php")) {
				$action = $viewName;
				require(__DIR__ . "/../Helper/AppViews/view-notfound-error.php");
			} else {
				echo "<pre>View Not Found</pre>";
			}
		}
	}
}
