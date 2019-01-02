<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\State;
use App\Models\Title;
class TitleController extends Controller
{
    public function index(){
    	$data = Title::orderBy('id','desc')->get();
        $state = State::where('id','<',3)->get();
		return view('admin.title.index',['data'=>$data,'state'=>$state]);
    }
    
    public function getupdate($id){
        $row = Title::find($id);
        $state = State::where('id','<',3)->get();
        return view('admin.title.update',['row'=>$row,'state'=>$state]);
        /*return redirect()->route('gettitle')->with('message','Cập nhật thành công');*/
    }
    public function postupdate(Request $request, $id){
        $items = Title::find($id);
        $items->name = $request->name;
        $items->review = $request->review;
        $items->stateid = $request->stateid;
        $items->save();
        return redirect()->route('gettitle')->with('message','Cập nhật thành công');
    }



    public function delete($id){
    	$items = Title::find($id);
    	$items->delete();
    	return redirect()->route('gettitle');
    }
    public function deleteall(){
        $data = Title::all();
    foreach ($data as $key){
        $id = Title::find($key->id);
        if($id->id!=0){
            $id->delete();
        }
    }
    return redirect()->route('gettitle')->with('message','Xóa tất cả thành công');
    }
    public function postinsert(Request $request){

        $items = new Title();
        $items->name = $request->name;
        $items->review = $request->review;
        $items->created_by = 1;
        $items->updated_by = 1;
        $items->stateid = $request->stateid;
        $items->save();
        return redirect()->route('gettitle')->with('message','Thêm thành công');;
    }
}
