<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ProductsController extends Controller {

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

    public function return_viewpage($id) {
        // echo "<h2>Product Id: $id<br></h2>";
        // echo "<a href='/products#pid$id'>Product Page</a>";
        $getmaxid_sql = "select max(product_id) as total_products from products";
        $getmaxid_sql_result = DB::select($getmaxid_sql_result);
        return view('view-page', [
            'product_id' => $id
        ]);
    }
}
