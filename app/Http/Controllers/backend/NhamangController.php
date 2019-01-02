<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Nhamang;
use Validator;

class NhamangController extends Controller
{
	public function index(){
		$data = Nhamang::all();
		$count = count($data);
		return view('admin.nhamang.index',['data'=>$data,'count'=>$count]);
	}
	public function postinsert(Request $request){
			$items = new Nhamang();
			$items->name = $request->name;
			$items->stateid = 1;
			$items->created_at =date('Y-m-d H:i:s');
			$items->updated_at =date('Y-m-d H:i:s');
			$items->save();
			return redirect()->route('getnhamang')->with('message','Thêm '.$request->name.' thành công');
	}
	public function getupdate($id){
		$row = Nhamang::find($id);
		return view('admin.nhamang.update',['row'=>$row]);
	}
	public function postupdate(Request $request,$id){
		$items = Nhamang::find($id);
		$name1 = $request->name;
		$name2 = $items->name;
		if($name1 == $name2){
			$items->created_at =date('Y-m-d H:i:s');
			$items->updated_at =date('Y-m-d H:i:s');
			$items->save();
			return redirect()->route('getnhamang')->with('message','Sửa '.$request->name.' thành công');
		}else{
			$rules =['name'=>'unique:db_nhamang',];
			$messages =['name.unique' => 'Tên nhà mạng đã tồn tại',];
			$validator = Validator::make($request->all(), $rules, $messages);
			if ($validator->fails()) {
				return redirect('admin/nhamang/update/'.$items->id)->withErrors($validator)->withInput();
			}else{
				$items->name = $request->name;
				$items->created_at =date('Y-m-d H:i:s');
				$items->updated_at =date('Y-m-d H:i:s');
				$items->save();
				return redirect()->route('getnhamang')->with('message','Sửa '.$request->name.' thành công');
			}
		}
	}
	public function delete($id){
		$items = Nhamang::find($id);
		$items->delete();
		return redirect()->route('getnhamang')->with('message','Xóa thành công');
	}
	public function deleteall(){
        $data = Nhamang::all();
    foreach ($data as $key){
        $id = Nhamang::find($key->id);
        if($id->id!=0){
            $id->delete();
        }
    }
    return redirect()->route('getnhamang')->with('message','Xóa tất cả thành công');
    }
}
