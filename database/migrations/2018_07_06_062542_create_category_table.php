<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('db_category', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('titid');
            $table->integer('parentid');
            $table->string('slug')->nullable();
            $table->string('img')->nullable();
            $table->string('data')->nullable();
            $table->string('salecallout')->nullable();
            $table->string('salecallin')->nullable();
            $table->string('salesmsout')->nullable();
            $table->string('salesmsin')->nullable();
            $table->string('datadetail')->nullable();
            $table->string('minutecall')->nullable();
            $table->string('saletime')->nullable();
            $table->string('cycle')->nullable();
            $table->string('phigoi')->nullable();
            $table->string('cuphap')->nullable();
            $table->integer('price')->nullable();
            $table->longtext('saleother')->nullable();
            $table->longtext('chuthich')->nullable();
            $table->longtext('detail')->nullable();
            $table->string('title1')->nullable();
            $table->string('title2')->nullable();
            $table->integer('timebuy')->nullable();
            $table->smallInteger('created_by');
            $table->smallInteger('updated_by');
            $table->smallInteger('stateid');
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
        Schema::dropIfExists('db_category');
    }
}
