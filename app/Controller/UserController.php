<?php
namespace App\Controller;

use App\Viewer\View;

class UserController {
	private $view;
	private $args; // This will store Dynamic variables Extracted from url
	function __construct($dv) {
		$this->args = $dv;
		$this->view = new View();
	}

	public function showDetail() {
		$name = $this->args['name'];
		$id = $this->args['id'];
		View::instantView('showDetail.php', [
			'name' => $name,
			'id' => $id
		]);

	}

	public function welcome() {
		$name = "Shyam";
		View::instantView('welcome.php', [
			'name' => $name
		]);
	}
}
