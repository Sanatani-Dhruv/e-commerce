<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller {
    public function index() {
        $list = DB::table('products')->get();
        $all = DB::select('select * from products');
        // print_r($all);

        return view('product', [
            'response' => $list
        ]);
    }
}
