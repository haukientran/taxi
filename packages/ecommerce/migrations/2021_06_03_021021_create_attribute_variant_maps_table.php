<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttributeVariantMapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attribute_variant_maps', function (Blueprint $table) {
            // ID sản phẩm
            $table->integer('product_id');
            // ID thuộc tính
            $table->integer('attribute_id');
            // ID chi tiết thuộc tính
            $table->integer('attribute_detail_id');
            // ID biến thể
            $table->integer('variant_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attribute_variant_maps');
    }
}
