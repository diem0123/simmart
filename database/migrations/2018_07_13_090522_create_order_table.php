<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('db_order', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customerid')->nullable();
            $table->integer('idorder')->nullable();
            $table->integer('productid')->nullable();
            $table->integer('price')->nullable();
            $table->string('shiptime')->nullable();
            $table->string('sex')->nullable();
            $table->string('address')->nullable();
            $table->string('fullname')->nullable();
             $table->string('email')->nullable();
            $table->date('createdate')->nullable();
            $table->date('shipdate')->nullable();
            $table->double('phone')->nullable();;
            $table->double('cmnd')->nullable();;
            $table->unsignedTinyInteger('stateid')->default(1);
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
        Schema::dropIfExists('db_order');
    }
}
