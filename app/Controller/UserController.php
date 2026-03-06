<?php
namespace App\Controller;

use App\Viewer\View;

class UserController {
	private $view;
	private $args; // This will store Dynamic variables Extracted from url
	function __construct($dv) {
		$this->args = $dv;
	}

	public function showDetail() {
		$name = $this->args['name'];
		$id = $this->args['id'];
		view('showDetail.php', [
			'name' => $name,
			'id' => $id
		]);

	}

	public function welcome() {
		$name = "Shyam";
		view('welcome.php', [
			'name' => $name
		]);
	}
}
