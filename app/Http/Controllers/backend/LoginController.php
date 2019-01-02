<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Validator;
use Input;
use Redirect;
use Session;
use DB;

class LoginController extends Controller
{
	public function getlogin(){
		return view('admin.login');
	}
	public function postlogin(Request $request){
		$rules =[
			'user'	=>	'required',
			'password'	=>	'required',
		];
		$messages =[
			'user.required' =>'Tài khoản không được bỏ trống',
			'password.required' =>'Mật khẩu không được bỏ trống',
		];
		$validator = Validator::make($request->all(), $rules, $messages);
		if ($validator->fails()) {
			return redirect('login')->withErrors($validator)->withInput();
		}
		else{
			$passINdata = DB::table('db_user')->where('user',$request->user)->value('password');
			if(password_verify($request->password, $passINdata)){
				$data = DB::table('db_user')->where('user',$request->user)->first();
				Session::put('login',$data);
				return redirect()->route('getdashboard');
			}
			else{
				Session::flash('message','Sai thông tin đăng nhập');
				return redirect()->back()->withInput();
			}
		}
	}
}
