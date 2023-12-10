<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taxes', function (Blueprint $table) {
            // ID 
            $table->id();
            // Tiêu đề
            $table->string('title', 191)->nullable();
            $table->integer('percentage')->default(0);
            $table->integer('priority')->default(0);
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
        Schema::dropIfExists('taxes');
    }
}
