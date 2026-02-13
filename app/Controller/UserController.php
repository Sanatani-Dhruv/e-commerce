<?php
namespace App\Controller;

use App\Router\Route;
use App\Viewer\View;

class UserController {
	private $view;
	function __construct() {
		$this->view = new View();
	}

	public function showDetail($name, $id) {
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>UserController::showDetail()</title>
	</head>
	<body>
		<h1>
Message from <?=UserController::class?> method showDetail()
		</h1>
	</body>
</html>
<?php
		echo (isset($id)) ? "True" : "False";
	}

	public function welcome() {
		$name = "Dhruv";
		View::instantView('welcome.php', [
			'name' => $name
		]);
		// $this->view->view('welcome.php');
	}
}
