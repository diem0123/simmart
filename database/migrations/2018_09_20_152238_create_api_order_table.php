<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateApiOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('api_order', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ten_kh')->nullable();
            $table->string('sdt_kh')->nullable();
            $table->string('tinh_tp')->nullable();
            $table->string('quan_huyen')->nullable();
            $table->string('dia_chi')->nullable();
            $table->string('id_don_hang')->nullable();
            $table->string('tien_thu_ho')->nullable();
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
        Schema::dropIfExists('api_order');
    }
}