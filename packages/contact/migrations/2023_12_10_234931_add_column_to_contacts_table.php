<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->integer('service_contact')->default(1);
            $table->integer('type_contact')->default(4);
            $table->string('departure')->nullable();
            $table->string('destination')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->dropColumn('service_contact');
            $table->dropColumn('type_contact');
            $table->dropColumn('departure');
            $table->dropColumn('destination');
        });
    }
}
