<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShippingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shippings', function (Blueprint $table) {
            // ID 
            $table->id();
            // Tiêu đề
            $table->string('title')->nullable();
            // Quốc gia
            $table->integer('province_id')->default(0);
            // Trạng thái
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('shippings');
    }
}
