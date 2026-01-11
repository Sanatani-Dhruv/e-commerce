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
                    'product_name' => fake()->sentence(3),
                    'product_shortdesc' => fake('en_IN')->sentence(30),
                    'product_longdesc' => fake('en_IN')->sentence(205),
                    'product_stock' => rand(0, 250),
                    'product_price' => rand(0, 10050),
                    'product_imagepath' => '/images/products/13th-Gen-Intel-Core-2-740x416.jpg'
                ]
            ]);
        }
    }

    // public function genSentence(int $num_of_word, int $min_length = 3, int $max_length = 10) {
    //     $string = "";
    //     for ($i = 0; $i < $num_of_word; $i++) {
    //         if ($i == $num_of_word - 1) {
    //             $string .= Str::random(rand($min_length, $max_length)) . ".";
    //         } else {
    //             $string .= Str::random(rand($min_length, $max_length)) . " ";
    //         }
    //     }
    //     return $string;
    // }

}
