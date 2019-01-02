<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTitleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('db_title', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('review');
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
        Schema::dropIfExists('db_title');
    }
}
