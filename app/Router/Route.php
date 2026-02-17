<?php
namespace App\Router;

class Route {
	public $request_uri;
	public $method;
	public $file;
	static $requests;
	static $arguments;
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

	public function get(string $request_uri, $viewName_methodCall, array $arguments = []) {
		if ($_SERVER['REQUEST_METHOD'] == "GET") {
			self::$requests[$request_uri] = $viewName_methodCall;
			$isAssociative = (array_keys($arguments) !== range(0, count($arguments) - 1));
			if ($isAssociative) {
				self::$arguments[$request_uri] = $arguments;
			}
		}
	} 

	public function post(string $request_uri, $viewName_methodCall, array $arguments = []) {
		if ($_SERVER['REQUEST_METHOD'] == "POST") {
			self::$requests[$request_uri] = $viewName_methodCall;
			$isAssociative = (array_keys($arguments) !== range(0, count($arguments) - 1));
			if ($isAssociative) {
				self::$arguments[$request_uri] = $arguments;
			}
		}
	}

	public function end() {
		// echo "<pre>";
		// print_r($_SERVER);
		// print_r(self::$requests);
		// echo "</pre>";

		if (is_array(self::$requests)) {
			foreach(self::$requests as $request_uri => $action) {
				// echo $request_uri . "<br>";

				$routeRegex = preg_replace_callback('/{\w+(:([^}]+))?}/', function ($matches) {
					return isset($matches[1]) ? '(' . $matches[2] . ')' : '([a-zA-Z0-9_-]+)';
				}, $request_uri);
				$routeRegex = '@^' . $routeRegex . '$@';
				// echo "\n\"$request_uri\" => \"$routeRegex\"\n\n";

				$forThisRequest = false;

				if (preg_match($routeRegex, $_SERVER['PATH_INFO'], $matches)) {
					// echo "<pre>";
					// print_r($matches);
					// echo "True for $matches[0]";

					array_shift($matches);
					$routeParamsValues = $matches;
					$routeParamsNames = [];
					if (preg_match_all('/{(\w+)(:[^}]+)?}/', $request_uri, $matches)) {
						$routeParamsNames = $matches[1];
						// For debugging parameter names
						// print_r($routeParamsNames);
						$routeParams = array_combine($routeParamsNames, $routeParamsValues);
					}

					$forThisRequest = true;
					self::$hasMatch = true;
					// echo "</pre>";
				}

				// $forThisRequest = ($request_uri == $_SERVER['PATH_INFO']) ? true : false;
				if ($forThisRequest) {
					if (is_array($action)) {
						// print_r($action);

						// Handle $action array's first element - Class Name
						$actionClass = $action[0];
						$actionObject = new $action[0]($routeParams);
						// echo "<pre>";
						// print_r($actionObject);
						// echo "</pre>";

						// Handle $action array's second & third element - Method Name & Method Args
						if (isset($action[1])) {
							$actionMethod = $action[1];
							$actionArgsArray = (isset($action[2])) ? $action[2] : [];
							$actionObject->{$actionMethod}(...$actionArgsArray);
						} else {
							echo "";
						}
						// extract($actionArgsArray);
						// echo $actionMethod;

					} elseif (is_string($action)) {
						// echo $action;
						if (file_exists(self::$viewDirectory . $action)) {
							if (isset(self::$arguments[$request_uri]) && count(self::$arguments[$request_uri])) {
								extract(self::$arguments[$request_uri]);
							}
							include(self::$viewDirectory . $action);
						} else {
							if (file_exists(__DIR__ . "/../Helper/AppViews/view-notfound-error.php")) {
								include(__DIR__ . "/../Helper/AppViews/view-notfound-error.php");
							} else {
								echo "View Not Found";
							}
						}
					}
				}
				// echo "<br>";

			}
		}
	}

	public function __destruct() {
		if (!self::$hasMatch) {
			// echo "No Match Found";
			if (file_exists(__DIR__ . "/../Helper/AppViews/general-notfound-error.php")) {
				include(__DIR__ . "/../Helper/AppViews/general-notfound-error.php");
			} else {
				echo "404 Not Found";
			}
		}
	}
}
