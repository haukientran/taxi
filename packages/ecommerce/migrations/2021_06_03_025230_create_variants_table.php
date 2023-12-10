<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVariantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('variants', function (Blueprint $table) {
            $table->id();
            // ID sản phẩm
            $table->integer('product_id');
            // Mã định danh sản phẩm duy nhất
            $table->string('sku')->nullable();
            // Giá bán
            $table->integer('price')->nullable();
            // Giá thị trường
            $table->integer('price_old')->nullable();
            // Ảnh sản phẩm
            $table->text('image')->nullable();
            // Số lượng sp trong kho
            $table->integer('quantity')->nullable();
            // Chiều dài
            $table->integer('length')->nullable();
            // Chiều rộng
            $table->integer('wide')->nullable();
            // Chiều cao
            $table->integer('height')->nullable();
            // Khối lượng
            $table->integer('weight')->nullable();

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
        Schema::dropIfExists('variants');
    }
}
