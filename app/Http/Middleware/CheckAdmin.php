<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use DB;


class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        /* ========== > AUTH < ========== */
        $value = Request()->cookie('trangthailogin');
        $trueOrFalse = (string)(substr($value,0,strpos($value,'|')));
        $id_login = trim(substr($value,strpos($value,'|')+1,strlen($value)));

        if ($trueOrFalse == 'true') {
            $data = DB::table('db_user')->where('id',$id_login)->first();
            Session::put('login', $data);
        }if ($trueOrFalse == 'false'){
            Session::forget('login');
            return redirect()->route('getlogin');
        }
        /* ========== > / AUTH < ========== */
        
        if(Session::has('login')){
            return $next($request);
            // $arr = [
            //     'user'=>Session::get('login')->user,
            //     'password'=>Session::get('login')->password,
            // ];

            // if(DB::table('db_user')->where($arr)->count()==1){
            //     return $next($request);
            // }else{
            //     return redirect()->route('getlogin');
            //    //return redirect()->intended('getlogin');
            // }
        }
        else{
            return redirect()->route('getlogin');
            //return redirect()->intended('getlogin');
        }
    }
}
