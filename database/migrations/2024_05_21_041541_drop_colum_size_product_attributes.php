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
        Schema::table('products_attributes', function (Blueprint $table) {
            $table->dropColumn('size');
        });

        Schema::table('carts', function (Blueprint $table) {
            $table->dropColumn('size');
        });

        Schema::table('orders_products', function (Blueprint $table) {
            $table->dropColumn('product_color');
            $table->dropColumn('product_size');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products_attributes', function (Blueprint $table) {
            //
        });
    }
};
