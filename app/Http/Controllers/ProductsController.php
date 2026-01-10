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
        echo "<h2>Product Id: $id<br></h2>";
        echo "<a href='/products#pid$id'>Product Page</a>";
        return view('view-page', [
            'product_id' => $id
        ]);
    }
}
