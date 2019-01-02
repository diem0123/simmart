<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateApiKhoHangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('api_kho_hang', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ma_kho')->nullable();
            $table->string('ten_chu_shop')->nullable();
            $table->string('email_shop')->nullable();
            $table->string('sdt_shop')->nullable();
            $table->string('tinh_thanh')->nullable();
            $table->string('quan_huyen')->nullable();
            $table->string('xa_phuong')->nullable();
            $table->string('ten_duong')->nullable();
            $table->string('dia_chi')->nullable();
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
        Schema::dropIfExists('api_kho_hang');
    }
}