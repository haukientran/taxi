<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductCategoryMapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_category_maps', function (Blueprint $table) {
            $table->integer('product_id');
            $table->integer('product_category_id');
            // Đánh index cho tên bảng, ngôn ngữ, và và chuỗi ngẫu nhiên
            $table->index([ 'product_id' ]);
            $table->index([ 'product_category_id' ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_category_maps');
    }
}
