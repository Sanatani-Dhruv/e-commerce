<?php
namespace App\Controller;

use App\Viewer\View;

class ProductController {
	private $args; // This will store Dynamic variables Extracted from url
	function __construct($dv) {
		$this->args = $dv;
		// Default Controller
	}

	public function showProduct() {
		$view = new View();
		$id = intval($this->args['id']);

		if ($id > 0 && $id < 9999) {
			echo $id;
			view('product-page.php', [
				'id' => $id
			]);
		} else {
			view('produ');
		}
	}
}
