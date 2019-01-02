<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class api_ghtk_cau_hinh extends Model
{
	protected $table = 'api_ghtk_cau_hinh';
	protected $fillable = ['id', 'token', 'pick_name', 'pick_tel', 'pick_address', 'pick_province', 'pick_district' ];
}
