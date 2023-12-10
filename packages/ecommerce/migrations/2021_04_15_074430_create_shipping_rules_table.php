<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShippingRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipping_rules', function (Blueprint $table) {
            // ID 
            $table->id();
            // Tiêu đề
            $table->string('name', 191)->nullable();

            $table->integer('shipping_id')->default(0);
            $table->string('type', 191)->nullable(); // weight or price
            $table->integer('from')->default(0); 
            $table->integer('to')->default(0);
            $table->integer('price')->default(0);
            // Ngày tạo/cập nhật
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
        Schema::dropIfExists('shipping_rules');
    }
}
