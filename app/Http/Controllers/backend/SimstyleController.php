<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Simstyle;
class SimstyleController extends Controller
{
    public function index(){
    	$data = Simstyle::all();
		$count = count($data);
		return view('admin.simstyle.index',['data'=>$data,'count'=>$count]);
    }
    public function postinsert(Request $request){
    	$items = new Simstyle();
    	$items->name = $request->name;
    	$items->save();
		return redirect()->route('getsimstyle')->with('message','Thêm '.$request->name.' thành công');
	}
	public function getupdate($id){
		$row = Simstyle::find($id);
		return view('admin.simstyle.update',['row'=>$row]);
	}
	public function postupdate(Request $request,$id){
	    $kiki = Simstyle::find($id);
		$items = Simstyle::find($id);
		$items->name = $request->name;
		$items->save();
		return redirect()->route('getsimstyle')->with('message','Cập nhật '.$request->name.' thành công');
	}
	public function delete($id){
		$items = Simstyle::find($id);
		$items->delete();
		return redirect()->route('getsimstyle')->with('message','Xóa thành công');
	}
	public function deleteall(){
    $data = Simstyle::all();
    foreach ($data as $key){
        $id = Simstyle::find($key->id);
        if($id->id!=0){
            $id->delete();
        }
    }
    return redirect()->route('getsimstyle')->with('message','Xóa tất cả thành công');
    }
}
