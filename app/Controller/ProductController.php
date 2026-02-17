<?php
namespace App\Controller;

use App\Viewer\View;

class ProductController {
	private $args; // This will store Dynamic variables Extracted from url
	function __construct($dv) {
		$this->args = $dv;
		// Default Controller
	}

	public function index() {
		$view = new View();
		// Base Method
	}
}
