<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->integer('user_id')->nullable()->change();
            $table->integer('category_id')->nullable()->change();
            $table->integer('type_id')->nullable()->change();
            $table->integer('location_id')->nullable()->change();
            $table->text('location')->nullable()->change();
            $table->string('alias')->nullable()->change();
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
            $table->integer('user_id')->index()->change();
            $table->integer('category_id')->index()->change();
            $table->integer('type_id')->nullable()->change();
            $table->integer('location_id')->index()->change();
            $table->text('location')->change();
            $table->string('alias')->change();
        });
    }
}
