<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInfoCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('info_customer', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('productid')->nullable();
            $table->integer('catid')->nullable();
            $table->string('name')->nullable();
            $table->integer('phone')->nullable();
            $table->string('cmnd')->nullable(); 
            $table->integer('count')->nullable();
            $table->integer('price')->nullable();
            $table->date('createdate')->nullable();
            

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
        Schema::dropIfExists('info_customer');
    }
}
