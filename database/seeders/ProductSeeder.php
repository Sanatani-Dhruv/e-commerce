<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void {

        DB::table('products')->insert([
            'name' => 'Intel Core i3-13100 CPU',
            'shortdesc' => 'Intel’s Entry-Level Core i3-13100 CPU With Quad Core Design Spotted, Perfect For Budget Gaming Builds',
            'longdesc' => 'Intel’s Entry-Level Core i3-13100 CPU With Quad Core Design Spotted, Perfect For Budget Gaming Builds Intel’s Entry-Level Core i3-13100 CPU With Quad Core Design Spotted, Perfect For Budget Gaming Builds Intel’s Entry-Level Core i3-13100 CPU With Quad Core Design Spotted, Perfect For Budget Gaming Builds',
            'stock' => '250',
            'price' => '2459',
            'imagepath' => '/images/products/13th-Gen-Intel-Core-2-740x416.jpg'
        ]);
        DB::table('products')->insert([
            'name' => 'DD2 Gen 2 Old HD RAM',
            'shortdesc' => '(FROM W3M)DD4 HD Ram From Old Gen',
            'longdesc' => 'DD4 HD Ram From Old Gen DD4 HD Ram From Old Gen DD4 HD Ram From Old Gen DD4 HD Ram From Old Gen DD4 HD Ram From Old Gen DD4 HD Ram From Old Gen DD4 HD Ram From Old Gen DD4 HD Ram From Old Gen\r\n ~/Desktop/HTML-CSS-PRACTICE/MAIN/images/products/DDR4 Intel Ram 9th Gen .jpeg',
            'stock' => '0',
            'price' => '1250',
            'imagepath' => '/images/products/DDR4 Intel Ram 9th Gen .jpeg'
        ]);
        DB::table('products')->insert([
            'name' => 'DD2 Gen 2 Old HD RAM',
            'shortdesc' => '(FROM W3M)DD4 HD Ram From Old Gen',
            'longdesc' => 'DD4 HD Ram From Old Gen DD4 HD Ram From Old Gen DD4 HD Ram From Old Gen DD4 HD Ram From Old Gen DD4 HD Ram From Old Gen DD4 HD Ram From Old Gen DD4 HD Ram From Old Gen DD4 HD Ram From Old Gen\r\n ~/Desktop/HTML-CSS-PRACTICE/MAIN/images/products/DDR4 Intel Ram 9th Gen .jpeg',
            'stock' => '0',
            'price' => '1250',
            'imagepath' => '/images/products/DDR4 Intel Ram 9th Gen .jpeg'
        ]);
        DB::table('products')->insert([
            'name' => 'CORSAIR Vengeance LPX DDR4 RAM 32GB (2x16GB) 3200MHz',
            'shortdesc' => 'CORSAIR Vengeance LPX DDR4 RAM 32GB (2x16GB) 3200MHz CL16-20-20-38 1.35V Intel AMD Desktop Computer Memory - Black (CMK32GX4M2E3200C16)',
            'longdesc' => 'VENGEANCE LPX memory is designed for high-performance overclocking. The heatspreader is made of pure aluminum for faster heat dissipation, and the eight-layer PCB helps manage heat and provides superior overclocking headroom. DESIGNED FOR HIGH-PERFORMANCE OVERCLOCKING VENGEANCE LPX memory is designed for high-performance overclocking. The heatspreader is made of pure aluminum for faster heat dissipation, and the custom performance PCB helps manage heat and provides superior overclocking headroom. Each IC is individually screened for peak performance potential. COMPATIBILITY TESTED Part of our exhaustive testing process includes performance and compatibility testing on nearly every motherboard on the market - and a few that aren&#039;t. DESIGNED FOR HIGH-PERFORMANCE OVERCLOCKING Each VENGEANCE LPX module is built from an custom performance PCB and highly-screened memory ICs. The efficient heat spreader provides effective cooling to improve overclocking potential. XMP 2.0 SUPPORT One setting is all it takes to automatically adjust to the fastest safe speed for your VENGEANCE LPX kit. You&#039;ll get amazing, reliable performance without lockups or other strange behavior. LOW-PROFILE DESIGN The small form factor makes it ideal for smaller cases or any system where internal space is at a premium. ALUMINUM HEAT SPREADER Overclocking overhead is limited by operating temperature. The unique design of the VENGEANCE LPX heat spreader optimally pulls heat away from the ICs and into your system&#039;s cooling path, so you can push it harder. MATCH YOUR SYSTEM The best high-performance systems look as good as they run. VENGEANCE LPX is available in several colors to match your motherboard, your other components, your case -- or just your favorite color. The DDR4 form factor is optimized for the latest DDR4 systems and offers higher frequencies, greater bandwidth, and lower power',
            'stock' => '156',
            'price' => '10119',
            'imagepath' => 'images/products/CORSAIR Vengeance LPX DDR4 RAM 32GB (2x16GB) 3200MHz.jpg'
        ]);
    }
}
