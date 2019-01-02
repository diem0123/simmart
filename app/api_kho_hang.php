<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class api_kho_hang extends Model
{
    protected $table = 'api_kho_hang';
    protected $fillable = ['ma_kho', 'ten_chu_shop', 'email_shop', 'sdt_shop', 'tinh_thanh', 'quan_huyen', 'xa_phuong', 'ten_duong', 'dia_chi'];
}

