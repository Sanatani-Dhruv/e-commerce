<?php
namespace App\Viewer;

use App\Router\Route;

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
		$viewLocation = __DIR__ . "/../../resources/views/";

		if (file_exists($viewLocation . $viewName)) {
			if (count($keyValue)) {
				extract($keyValue);
			}
			require($viewLocation . $viewName);
		} else {
			if (file_exists(__DIR__ . "/../Helper/Views/view-notfound-error.php")) {
				$viewName_methodCall = $viewName;
				require(__DIR__ . "/../Helper/Views/view-notfound-error.php");
			} else {
				echo "<pre>View Not Found</pre>";
			}
		}
	}
}
