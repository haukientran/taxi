<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttributeDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attribute_details', function (Blueprint $table) {
            // ID
            $table->id();
            // ID danh mục cha
            $table->integer('attribute_id')->default(0);
            // Tên
            $table->string('name')->nullable();
            // Đường dẫn (Trường hợp lọc kết hợp với link)
            $table->string('slug')->nullable();

            $table->string('color_code')->nullable();

            $table->string('image')->nullable();
            // Sắp xếp
            $table->integer('order')->default(99999);
            // Ngày đăng/cập nhật
            $table->timestamps();
            // Đánh index (Quan trọng)
            $table->index(['attribute_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attribute_details');
    }
}
