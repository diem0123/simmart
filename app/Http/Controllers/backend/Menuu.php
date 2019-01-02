<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\State;
use Validator;
class Menuu extends Controller
{
	public function index(){
		$data = Menu::orderBy('parentid','asc')->get();
		$state = State::all();
		$count = count($data);

		return view('admin.menu.index',['data'=>$data,'state'=>$state,'count'=>$count]);
	}
	public function getupdate($id){
		$row = Menu::find($id);
		$state = State::where('id','<',3)->get();
		$parent = Menu::where('stateid','<',3)->orderBy('parentid','asc')->get();
		return view('admin.menu.update',['state'=>$state,'row'=>$row,'parent'=>$parent]);
	}

	public function postupdate(Request $request,$id){

		$items = Menu::find($id);
		if($items->name == $request->name){
			$items->slug = $request->slug;
			$items->parentid = $request->parentid;
			$items->stateid = $request->stateid;
			$items->created_at = date('Y-m-d H:i:s');
			$items->updated_at = date('Y-m-d H:i:s');
			if($request->hasFile('photo')){
				if(($items->icon)==""){
					unlink('images/'.$items->icon);
				$file = $request->file('photo')->getClientOriginalExtension();
				$name = str_slug($items->name).'-'.time().'.'.$file;
				$path = public_path('images');
				$request->file('photo')->move('images', $name);
				}else{
				$file = $request->file('photo')->getClientOriginalExtension();
				$name = str_slug($items->name).'-'.time().'.'.$file;
				$path = public_path('images');
				$request->file('photo')->move('images', $name);
				}
			}else {
				$name = $items->icon;
			}
			$items->icon = $name;
			$items->save();
		}

		else{
			$rules =[
				'name'=>'unique:db_menu',
			];
			$messages =[
				'name.unique' => 'Tên menu đã tồn tại',
			];
			$validator = Validator::make($request->all(), $rules, $messages);
			if ($validator->fails()){
				return redirect('admin/menu/update/'.$items->id)->withErrors($validator)->withInput();
			}
			else {
				$items->name = $request->name;
				$items->slug = $request->slug;
				$items->parentid = $request->parentid;
				$items->stateid = $request->stateid;
				$items->created_at = date('Y-m-d H:i:s');
				$items->updated_at = date('Y-m-d H:i:s');
				if($request->hasFile('photo')) {
					if(($items->icon)==""){
					unlink('images/'.$items->icon);
				$file = $request->file('photo')->getClientOriginalExtension();
				$name = str_slug($items->name).'-'.time().'.'.$file;
				$path = public_path('images');
				$request->file('photo')->move('images', $name);
				}else{
				$file = $request->file('photo')->getClientOriginalExtension();
				$name = str_slug($items->name).'-'.time().'.'.$file;
				$path = public_path('images');
				$request->file('photo')->move('images', $name);
				}
				}
				else {
					$name = $items->icon;
				}
				$items->icon = $name;
				$items->save();
			}
		}return redirect()->route('getmenu')->with('message','Sửa thành công');

}






public function getinsert(){
	$state = State::where('id','<',3)->get();
	$parent = Menu::where('stateid','<',3)->orderBy('parentid','asc')->get();
	return view('admin.menu.insert',['state'=>$state,'parent'=>$parent]);
}
public function postinsert(Request $request){
	$items = new Menu();
	$rules =[
		'name'=>'unique:db_menu',
		'photo'=>'mimes:jpeg,jpg,png,bmp,gif,svg,ico',
	];
	$messages =[
		'name.unique' => 'Tên menu đã tồn tại',
		'photo.mimes' =>'Định dạng hình ảnh không đúng',
	];
	$validator = Validator::make($request->all(), $rules, $messages);
	if ($validator->fails()){
		return redirect('admin/menu/insert')->withErrors($validator)->withInput();
	}
	else {
		$items->name = $request->name;
		$items->slug = $request->slug;
		$items->parentid = $request->parentid;
		$items->stateid = $request->stateid;
		$items->created_at = date('Y-m-d H:i:s');
		$items->updated_at = date('Y-m-d H:i:s');
		if($request->hasFile('photo')) {
			$file = $request->file('photo')->getClientOriginalExtension();
			$name = str_slug($items->name).'-'.time().'.'.$file;
			$path = public_path('images');
			$request->file('photo')->move('images', $name);
		}
		else {
			$name = "";
		}
		$items->icon = $name;
		$items->save();
		return redirect()->route('getmenu')->with('message','Thêm thành công');

	}
}





public function delete($id){
	$items = Menu::find($id);
	$items->delete();
	return redirect()->route('getmenu');
}

public function deleteall(){
	$data = Menu::all();
	foreach ($data as $key){
		$id = Menu::find($key->id);
		if($id->id!=0){
			$id->delete();
		}
	}
	return redirect()->route('getmenu')->with('message','Xóa tất cả thành công');

}
}
