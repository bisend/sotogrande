<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSalesAndRentalsColumnsToPropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->boolean('sales')->after('alias')->default(0);
            $table->boolean('rentals')->after('sales')->default(0);
            $table->integer('position')->after('rentals')->default(0);
            $table->boolean('slider')->after('position')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->dropColumn('sales');
            $table->dropColumn('rentals');
            $table->dropColumn('position');
            $table->dropColumn('slider');
        });
    }
}
