<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ProductListController extends Controller {

    function __construct() {
        // echo "Hi";
    }

    public function return_listing() {
        $sql = "select * from products";
        $products_sql_result = DB::select("select * from products");
        return view('product', [
            'product_sql_result' => $products_sql_result
        ]);
    }
}
