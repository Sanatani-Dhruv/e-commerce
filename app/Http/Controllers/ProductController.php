<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ProductController extends Controller {

    function __construct() {
        //
    }

    /* Return product view with array of objects of products */
    public function return_listing() {
        $products_sql = "select * from products";
        $products_sql_result = DB::select($products_sql);

        return view("product", [
            'product_object' => $products_sql_result
        ]);
    }

    public function return_viewpage(string $id) {
        // echo "<h2>Product Id: $id<br></h2>";
        // echo "<a href='/products#pid$id'>Product Page</a>";
        if (ctype_digit($id)) {

            // Fetch maximum value from products table to check if given id is less than available ids
            $getmaxid_sql = "select max(product_id) as total_products from products";
            $getmaxid_result = DB::select($getmaxid_sql);
            $max_product_id = $getmaxid_result[0]->total_products;

            // Fetch value to check if product with such product id exists or not
            $product_exist_in_db_sql = "select count(product_id) as exist_status from products where product_id=$id";
            $product_exist_in_db_result = DB::select($product_exist_in_db_sql);
            $product_exist_status = (bool) $product_exist_in_db_result[0]->exist_status;
            // echo ($product_exist_status)? 'Exist in DB Status' : 'Not Exist in DB Status';

            // Check if Product Exists by using product id recieved from url and db value
            if (count($getmaxid_result) == 1 && $max_product_id >= $id) {
                if ($product_exist_status) {
                    // echo "<h2>Product Exists</h2><br>";
                    // echo "Total Products in DB: " . $getmaxid_result[0]->total_products;
                } else {
                    // echo "<h2>Product Removed from DB</h2>";
                }
            } else {
                // echo "Not Existing Product ID";
            }
        } else {
            // echo "Numbers Expected instead of String";
        }

        // Making data which will be passed to view
        if (isset($product_exist_status) && $product_exist_status) {
            // echo "<br><a href='/products#pid$id'>Product-Page</a>";

            $get_detail_sql = "select * from products where product_id = $id";
            $get_detail_result = DB::select($get_detail_sql);
            $product_stock = $get_detail_result[0]->product_stock;
            $post_stock_text;
            // echo $product_stock;
            if ($product_stock > 0) {
                $stock_available = true;
                if ($product_stock <=50) {
                    $post_stock_text = "Running Out Of Stock!";
                } elseif ($product_stock <=100) {
                    $post_stock_text = "Limited Quantity!";
                } elseif ($product_stock > 100) {
                    $post_stock_text = "In Stock!";
                }
            } else {
                $post_stock_text = "Out Of Stock!";
                $stock_available = 0;
            }

            // echo $post_stock_text;
            // echo "<pre>";
            // print_r($get_detail_result);
            // echo "</pre>";

            return view('view-page', [
                'detail_object' => $get_detail_result[0],
                'stock_status' => $stock_available,
                'stock_message' => $post_stock_text
            ]);
        } else {
            // echo "<br><a href='/products'>Product-Page</a>";
        }



    }
}
