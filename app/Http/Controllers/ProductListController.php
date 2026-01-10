<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ProductListController extends Controller {

    function __construct() {
        //
    }

    public function return_listing() {
        $products_sql = "select * from products";
        $products_sql_result = DB::select($products_sql);

        return view("product", [
            'product_object' => $products_sql_result
        ]);
    }
}
