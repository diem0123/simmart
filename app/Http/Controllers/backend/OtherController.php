<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Logo;
use App\Models\Ship;
use App\Models\State;

class OtherController extends Controller
{
    public function getlogo(){
    	$row = Logo::where('id',1)->first();
    	$ship = Ship::where('id',1)->first();
    	$state = State::where('id','<',3)->get();

    	return view('admin.other.logo',['row'=>$row,'ship'=>$ship,'state'=>$state]);
    }
    public function postlogo(Request $request){
    	$row = Logo::where('id',1)->first();
    	$id = $row->id;
    	$items = Logo::find($id);
    	if($request->hasFile('photo')){
            if(($items->logo)==""){
                $file = $request->file('photo')->getClientOriginalExtension();
                $name = time().'.'.$file;
                $path = public_path('images');
                $request->file('photo')->move('images', $name);
            }else{
                $file = $request->file('photo')->getClientOriginalExtension();
                $name = time().'.'.$file;
                $path = public_path('images');
                $request->file('photo')->move('images', $name);
            }
            
			}
			else {
				$name = $items->logo;
			}
			$items->logo = $name;
			$items->stateid = $request->stateid;
			$items->save();
			return redirect()->route('getlogo')->with('message','Cập nhật logo thành công');
    }
    public function postpriceship(Request $request){
    	$row = Ship::where('id',1)->first();
    	$id = $row->id;
    	$items = Ship::find($id);
    	$items->ship = $request->ship;
    	$items->save();
		return redirect()->route('getlogo')->with('message','Cập nhật phí vận chuyển thành công');
    }
}
