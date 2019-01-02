<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Dichvu;
use App\Models\Info;


class TemplateController extends Controller
{
	public function dichvu(){
		$data = Dichvu::orderBy('id','desc')->get();
		return view('admin.footer.indexdichvu',['data'=>$data]);
	}
	public function getdeletealldichvu(){
		$data = Dichvu::all();
		foreach ($data as $key){
			$id = Dichvu::find($key->id);
			if($id->id!=0){
				$id->delete();
			}
		}
		return redirect()->route('getdichvu')->with('message','Xóa tất cả thành công');
	}
	public function getdeletedichvu($id){
		$items = Dichvu::find($id);
		$items->delete();
		return redirect()->route('getdichvu');
	}
	public function getinsertdichvu(){
		return view('admin.footer.insertdichvu');
	}
	public function postinsertdichvu(Request $request){
		$items = new Dichvu();
		$items->name = $request->name;
		$items->slug = $request->slug;
		if($request->hasFile('photo')) {
			$file = $request->file('photo')->getClientOriginalExtension();
			$name = str_slug($items->name).'-'.time().'.'.$file;
			$path = public_path('images');
			$request->file('photo')->move($path, $name);
		}
		else {
			$name = '';
		}
		$items->icon = $name;
		$items->save();
		return redirect()->route('getdichvu')->with('message','Thêm thành công');

	}
	public function getupdatedichvu($id){
		$row = Dichvu::find($id);
		return view('admin.footer.updatedichvu',['row'=>$row]);
	}
	public function postupdatedichvu(Request $request, $id){
		$items = Dichvu::find($id);

		$items->name = $request->name;
		$items->slug = $request->slug;
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
		return redirect()->route('getdichvu')->with('message','Sửa thành công');
	}
	
	




	public function info(){
		$data = Info::orderBy('id','desc')->get();
		return view('admin.footer.indexinfo',['data'=>$data]);
	}
	public function getupdateinfo($id){
		$row = Info::find($id);
		return view('admin.footer.updateinfo',['row'=>$row]);
	}
	public function postupdateinfo(Request $request, $id){
		$items = Info::find($id);

		$items->name = $request->name;
		$items->slug = $request->slug;
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
		return redirect()->route('getinfoo')->with('message','Sửa thành công');
	}
	public function getdeleteallinfo(){
		$data = Info::all();
		foreach ($data as $key){
			$id = Info::find($key->id);
			if($id->id!=0){
				$id->delete();
			}
		}
		return redirect()->route('getinfoo')->with('message','Xóa tất cả thành công');
	}
	public function getdeleteinfo($id){
		$items = Info::find($id);
		$items->delete();
		return redirect()->route('getinfoo');
	}

	public function getinsertinfo(){
		return view('admin.footer.insertinfo');
	}
	public function postinsertinfo(Request $request){
		$items = new Info();
		$items->name = $request->name;
		$items->slug = $request->slug;
		if($request->hasFile('photo')) {
			$file = $request->file('photo')->getClientOriginalExtension();
			$name = str_slug($items->name).'-'.time().'.'.$file;
			$path = public_path('images');
			$request->file('photo')->move($path, $name);
		}
		else {
			$name = '';
		}
		$items->icon = $name;
		$items->save();
		return redirect()->route('getinfoo')->with('message','Thêm thành công');

	}
}
