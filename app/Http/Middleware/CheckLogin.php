<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use DB;

class CheckLogin
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
        if(Session::has('login')){
 
            $arr = [ 
                'user'=>Session::get('login')->user,
                'password'=>Session::get('login')->password, 
            ];
 
            if(DB::table('db_user')->where($arr)->count()==1){
                 return redirect()->route('getdashboard');
                //return redirect()->intended('admin.dashboard');             
             } 
            else{ 
                return $next($request); 
            } 
        } 
        else{ 
            return $next($request); 
        }
    }
}
