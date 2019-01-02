<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class api_order extends Model
{
    protected $table = 'api_order';
    protected $fillable = ['ten_kh', 'sdt_kh', 'tinh_tp', 'quan_huyen', 'dia_chi', 'id_don_hang', 'tien_thu_ho'];
}
