<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateApiGhtkCauHinhTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('api_ghtk_cau_hinh', function (Blueprint $table) {
            $table->increments('id');
            $table->string('token')->nullable();
            $table->string('pick_name')->nullable();
            $table->string('pick_tel')->nullable();
            $table->string('pick_address')->nullable();
            $table->string('pick_province')->nullable();
            $table->string('pick_district')->nullable();
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
        Schema::dropIfExists('api_ghtk_cau_hinh');
    }
}