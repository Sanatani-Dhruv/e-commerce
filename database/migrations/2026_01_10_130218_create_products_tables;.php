<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function(Blueprint $table) {
            $table->id('product_id');
            $table->string('product_name', 150);
            $table->string('product_shortdesc', 400);
            $table->string('product_longdesc', 2000);
            $table->string('product_stock');
            $table->string('product_price');
            $table->string('product_imagepath', 200);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('products');
    }
};
