<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Session;

class UserController extends Controller
{
    public function update($id)
    {
        $row = User::find($id);

        return view('admin.user.update', ['row' => $row]);
        dd();
    }
    public function postupdate(Request $request, $id)
    {
        $items = User::find($id);

        if ($items->password != password_hash($request->password, PASSWORD_DEFAULT)) {
            $items->fullname = $request->fullname;
            $items->email    = $request->email;
            $items->password = password_hash($request->password, PASSWORD_DEFAULT);

            if ($request->hasFile('photo')) {

                if (($items->img) != "") {
                    unlink('images/'.$items->img);

                   $file = $request->file('photo')->getClientOriginalName();
                $name = time() . '_' . $file;
                    // $path = public_path('images');
                    $request->file('photo')->move('images', $name);
                } else {
                    $file = $request->file('photo')->getClientOriginalName();
                $name = time() . '_' . $file;
                    // $path = public_path('images');
                    $request->file('photo')->move('images', $name);
                }
            } else {
                $name = $items->img;
            }
            $items->img = $name;
            $items->save();
            Session::flush();
            return redirect()->route('getlogin')->with('message', 'Bạn vừa đổi mật khẩu, vui lòng đăng nhập lại');
        } else {

            $items->fullname = $request->fullname;
            $items->email    = $request->email;
            $items->password = password_hash($request->password, PASSWORD_DEFAULT);
            if ($request->hasFile('photo')) {
                if($items->img){
                    unlink('images/'.$items->img);
                }
                $file = $request->file('photo')->getClientOriginalName();
                $name = time() . '_' . $file;
                // $path = public_path('images');
                $request->file('photo')->move('images', $name);
            } else {
                $name = $items->img;
            }
            $items->img = $name;

            $items->save();
             Session::put('login',$items);
            return redirect()->route('getdashboard')->with('message', 'Cập nhật thông tin thành công');
        }

    }
}
