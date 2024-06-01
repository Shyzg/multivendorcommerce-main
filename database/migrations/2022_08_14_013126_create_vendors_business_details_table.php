<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors_business_details', function (Blueprint $table) {
            $table->id();
            $table->integer('vendor_id');
            $table->string('shop_name')->nullable();
            $table->string('shop_address')->nullable();
            $table->string('shop_city')->nullable();
            $table->string('shop_state')->nullable();
            $table->string('shop_country')->nullable();
            $table->string('shop_mobile')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vendors_business_details');
    }
};
