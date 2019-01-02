<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('db_seo', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->string('metadesc')->nullable();
            $table->string('metakey')->nullable();
            $table->string('toado')->nullable();
            $table->string('author')->nullable();
            $table->string('address')->nullable();
            $table->string('code')->nullable();
            $table->string('url')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('db_seo');
    }
}
