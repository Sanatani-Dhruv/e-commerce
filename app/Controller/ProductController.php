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
		$id = trim(intval($this->args['id']));

		if (isset($_SESSION["current_user"])) {
			$current_user_id = $_SESSION["current_user_id"];

			$get_cart_detail_sql = "SELECT sum(item_quantity) from cart_items where product_id = $product_id and user_id = $current_user_id;";
			$get_cart_detail_result = $this->DB->select($get_cart_detail_sql);

			print_r($get_cart_detail_result);

			if (mysqli_num_rows($get_cart_detail_result) === 1) {
				while ($get_cart_detail_row = mysqli_fetch_assoc($get_cart_detail_result)) {
					$quantity_from_db = $get_cart_detail_row["sum(item_quantity)"];
					if ($quantity_from_db == NULL) {
						$quantity_from_db = 1;
					}
				}
			} else {
				$quantity_from_db = 1;
			}
		} else {
			$quantity_from_db = 1;
		}

		$getmaxid_sql = "select max(product_id) as total_products from products";
		$getmaxid_result = $this->DB->select($getmaxid_sql)[0]['total_products'];

		$getids_sql = "select product_id from products";
		$getids_result = $this->DB->select($getids_sql);

		$invalidId = true;
		foreach($getids_result as $value) {
			if ($id == $value['product_id'])
				$invalidId = false;
		}

		if (!$invalidId) {
			if ($id > 0 && $id <= $getmaxid_result) {

				$getdetail_sql = "select * from products where product_id = $id";
				$getdetail_result = $this->DB->select($getdetail_sql)[0];
				// echo "<pre>";
				// print_r($getdetail_result);
				// echo "</pre>";

				$post_stock_text;
				if ($getdetail_result['product_stock'] > 0) {
					$stock_available = true;
					if ($getdetail_result['product_stock'] <=50) {
						$post_stock_text = "Running Out Of Stock!";
					} elseif ($getdetail_result['product_stock'] <=100) {
						$post_stock_text = "Limited Quantity!";
					} elseif ($getdetail_result['product_stock'] > 100) {
						$post_stock_text = "In Stock!";
					}
				} else {
					$post_stock_text = "Out Of Stock!";
					$stock_available = false;
				}

				view('product-page.php', [
					'id' => $id,
					'invalidId' => false,
					'response' => $getdetail_result,
					'stock_enum' => $stock_available,
					'quantity_from_db' => $quantity_from_db,
					'post_stock_text' => $post_stock_text
				]);
			} else {
				view('product-page.php', [
					'id' => $id,
					'invalidId' => true
				]);
				http_response_code(404);
			}
		} else {
			view('product-page.php', [
				'id' => $id,
				'invalidId' => true
			]);
			http_response_code(404);
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
