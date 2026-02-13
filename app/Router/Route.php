<?php
namespace App\Router;

class Route {
	public $request_uri;
	public $method;
	public $file;
	static $requests;
	static $hasMatch = false;
	static $viewDirectory = __DIR__ . "/../../resources/views/";
	private $viewName_methodCall;
	private $displayedView;

	function __construct() {
		global $requests;
		if (!isset($_SERVER["PATH_INFO"])) {
			$_SERVER["PATH_INFO"] = "/";
		}
		$this->displayedView = 0;
	}

	public function get(string $request_uri, $viewName_methodCall) {
		if ($_SERVER['REQUEST_METHOD'] == "GET") {
			self::$requests[$request_uri] = $viewName_methodCall;
		}
	} 

	public function post(string $request_uri, $viewName_methodCall) {
		if ($_SERVER['REQUEST_METHOD'] == "POST") {
			self::$requests[$request_uri] = $viewName_methodCall;
		}
	}

	public function end() {
		// echo "<pre>";
		// print_r($_SERVER);
		// print_r(self::$requests);
		// echo "</pre>";

		foreach(self::$requests as $request_uri => $action) {
			// echo $request_uri . "<br>";
			$forThisRequest = ($request_uri == $_SERVER['PATH_INFO']) ? true : false;
			if ($forThisRequest) {
				if (is_array($action)) {
					// print_r($action);

					// Handle $action array's first element - Class Name
					$actionClass = $action[0];
					$actionObject = new $action[0];
					// echo "<pre>";
					// print_r($actionObject);
					// echo "</pre>";

					// Handle $action array's second element - Method Name
					$actionMethod = $action[1];
					$actionArgsArray = $action[2];
					// extract($actionArgsArray);
					// echo $actionMethod;
					$actionObject->{$actionMethod}(...$actionArgsArray);

				} elseif (is_string($action)) {
					// echo $action;
					if (file_exists(self::$viewDirectory . $action)) {
						include(self::$viewDirectory . $action);
					} else {
						if (file_exists(__DIR__ . "/../Helper/Views/view-notfound-error.php")) {
							include(__DIR__ . "/../Helper/Views/view-notfound-error.php");
						} else {
							echo "View Not Found";
						}
					}
				}
			}
			// echo "<br>";

		}

		foreach (self::$requests as $request_uri => $action) {
			if ($request_uri == $_SERVER['PATH_INFO']) {
				self::$hasMatch = true;
			}
		}
	}

	public function __destruct() {
		if (!self::$hasMatch) {
			// echo "No Match Found";
			if (file_exists(__DIR__ . "/../Helper/Views/general-notfound-error.php")) {
				include(__DIR__ . "/../Helper/Views/general-notfound-error.php");
			} else {
				echo "404 Not Found";
			}
			http_response_code(404);
		}
	}
}
