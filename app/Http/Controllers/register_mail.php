<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Models\User;
class register_mail extends Controller
{
	public function register_mail(Request $request){
		$data = User::where('id',1)->first();
		$email = $request->send;
		$emailadmin = $data->email;
		Mail::send('page.contentmail',['email'=>$email,'emailadmin'=>$emailadmin],function($msg) use ($email,$emailadmin){
			$msg->from('hethongsimsodep@gmail.com','Đăng ký nhận thông báo');
			$msg->to($emailadmin,'')->subject('Đây là mail hệ thống');
		});
		return redirect()->route('trangchu')->with('message','Cám ơn bạn đã đăng ký với cho chúng tôi, mọi thông báo mới nhất sẽ được gửi đến bạn sớm nhất');
	}
}
