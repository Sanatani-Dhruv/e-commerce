<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        for ($i = 0; $i < 10; $i++){
            DB::table('products')->insert([
                [
                    'product_name' => Str::random(6) . " " . Str::random(7),
                    'product_shortdesc' => Str::random(100),
                    'product_longdesc' => Str::random(10) . '@example.com',
                    'product_stock' => rand(0, 250),
                    'product_price' => rand(0, 10050),
                    'product_imagepath' => '/images/' . Str::random(8)
                ]
            ]);
        }
    }
}
