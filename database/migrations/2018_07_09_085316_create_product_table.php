<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('db_product', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->integer('catid')->nullable();
            $table->integer('nhamang')->nullable();
            $table->integer('styleid')->nullable();
            $table->string('number')->nullable();
            $table->integer('countbuy')->nullable();
            $table->integer('price')->nullable();
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
        Schema::dropIfExists('db_product');
    }
}
