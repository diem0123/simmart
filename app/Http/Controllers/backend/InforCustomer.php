<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Infor_customer;
use App\Models\Product;
use App\Models\Order;
use App\Models\State;


class InforCustomer extends Controller
{
	public function index(){
		$data = Infor_customer::orderBy('id','desc')->get();
		$product = Product::all();
		return view('admin.infor_customer.index',['data'=>$data,'product'=>$product]);
	}
	public function delete($id){
		$items = Infor_customer::find($id);
		$items->delete();
		return redirect()->route('getinfor_customer');
	}
	public function deleteall(){
		$data = Infor_customer::all();
		foreach ($data as $key){
			$id = Infor_customer::find($key->id);
			if($id->id!=0){
				$id->delete();
			}
		}
		return redirect()->route('getinfor_customer')->with('message','Xóa tất cả thành công');

	}

	public function detail($id){
		$row = infor_customer::find($id);
		$pro = Product::all();
		$order = Order::all();
		$state = State::all();
		return view('admin.infor_customer.detail',['row'=>$row,'pro'=>$pro,'order'=>$order,'state'=>$state]);
	}
}
