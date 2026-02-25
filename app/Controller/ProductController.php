<?php
namespace App\Controller;

use App\Viewer\View;
use Delight\Db\PdoDataSource;
use Delight\Db\PdoDatabase;

class ProductController {
	private $args; // This will store Dynamic variables Extracted from url
	public $DB;
	function __construct($dv) {
		$this->args = $dv;
		$dataSource = new PdoDataSource('mysql'); // see "Available drivers for database systems" below
		$dataSource->setHostname(env('DB_HOST'));
		$dataSource->setPort(3306);
		$dataSource->setDatabaseName(env('DB_NAME'));
		$dataSource->setCharset('utf8mb4');
		$dataSource->setUsername(env('DB_USER'));
		$dataSource->setPassword(env('DB_PASS'));

		$this->DB = PdoDatabase::fromDataSource($dataSource);
		// Default Controller
	}

	public function showProduct() {
		$view = new View();
		$id = intval($this->args['id']);

		if ($id > 0 && $id < 9999) {
			echo $id;
			view('product-page.php', [
				'id' => $id,
				'DB' => $this->DB
			]);
		} else {
			view('product-page.php', [
				'invalidId' => true
			]);
		}
	}

	public function showProductPage() {


		$sql = "select * from products";
		$result = $this->DB->select($sql);
		// echo "<pre>";
		// print_r($result);
		// echo "</pre>";

		view('product.php', [
			'DB' => $this->DB,
			'result' => $result
		]);
	}
}
