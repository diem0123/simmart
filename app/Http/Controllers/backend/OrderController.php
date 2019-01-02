<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Models\Order;
use App\Models\Product;
use App\Models\State;
use App\Models\Ship;
use App\Models\Thongke;

class OrderController extends Controller
{
    public function index(){

        $data = Order::where('stateid',3)->orderBy('id','desc')->get();
        $count = count($data);
        $pro  = Product::all();
        $state = State::all();
        $ship = Ship::where('id',1)->first();
        return view('admin.order.index',['ship'=>$ship,'data'=>$data,'pro'=>$pro,'state'=>$state,'count'=>$count]);
    }

    public function ship(){
    	$data = Order::where('stateid',4)->orderBy('createdate','desc')->get();
    	$count = count($data);
    	$pro  = Product::all();
    	$state = State::all();
       $ship = Ship::where('id',1)->first();
       return view('admin.order.ship',['ship'=>$ship,'data'=>$data,'pro'=>$pro,'state'=>$state,'count'=>$count]);
   }
   public function pay(){
    $data = Order::where('stateid',5)->orderBy('createdate','desc')->get();
    $count = count($data);
    $pro  = Product::all();
    $state = State::all();
    $ship = Ship::where('id',1)->first();
    return view('admin.order.pay',['ship'=>$ship,'data'=>$data,'pro'=>$pro,'state'=>$state,'count'=>$count]);
}

public function fail(){
   $data = Order::where('stateid',6)->orderBy('createdate','desc')->get();
   $count = count($data);
   $pro  = Product::all();
   $state = State::all();
   $ship = Ship::where('id',1)->first();
   return view('admin.order.fail',['ship'=>$ship,'data'=>$data,'pro'=>$pro,'state'=>$state,'count'=>$count]);
}

public function detail($id){
   $row = Order::where('id',$id)->first();
   $pro  = Product::all();
   $ship = Ship::where('id',1)->first();
   $state = State::all();

   return view('admin.order.detail',['ship'=>$ship,'row'=>$row,'pro'=>$pro,'state'=>$state]);
}
public function postdetail(Request $request,$id){
   $items = Order::find($id);
   $proid = $items->productid;
   $row = Product::find($proid);
   $items->stateid = 4;
   $items->shipdate = $request->shipdate;

   $items->save();
   $row->save();

   return redirect()->route('getorder')->with('message','Xác nhận thành công');
}

public function confirm($id){
   $items = Order::find($id);
   $proid = $items->productid;
   $row = Product::find($proid);
   $items->stateid =4;
   $row->stateid = 4;

   $items->save();
   $row->save();
   return redirect()->route('getorder')->with('message','Xác nhận thành công');

}

public function delete($id){
    $items = Order::find($id);
    $items->delete();
    return redirect()->back()->with('message','Xóa đơn hàng thành công');
}
public function deleteback($id){
    $items = Order::find($id);
    $items->delete();
    return redirect()->route('getorder')->with('message','Xóa đơn hàng thành công');

}
public function cancel($id){
    $items = Order::find($id);
    $proid = $items->productid;
    $row = Product::find($proid);
    $items->stateid = 6;
    $row->stateid = 6;
    $items->save();
    $row->save();

    $ship = Ship::where('id',1)->first();
    $thongke = new Thongke();
    $thongke->fullname = $items->fullname;
    $thongke->cmnd = $items->cmnd;
    $thongke->number = $row->number;
    $thongke->price = $items->price + $items->price_cat + $ship->ship;
    $date= date('Y-m-d');
        /*echo $year = substr($date, 0,4);
        echo $month = substr($date, 5,2);*/
        $thongke->date = date('Y-m-d');
        $thongke->stateid = 2;
        $thongke->created_at = date('Y-m-d H:i:s');
        $thongke->updated_at = date('Y-m-d H:i:s');
        $thongke->save();
        return redirect()->back()->with('message','Hủy đơn hàng thành công');

    }
    public function money($id){
        $items = Order::find($id);
        $proid = $items->productid;
        $row = Product::find($proid);
        $items->stateid = 5;
        $row->stateid = 5;
        
        $ship = Ship::where('id',1)->first();
        $thongke = new Thongke();
        $thongke->fullname = $items->fullname;
        $thongke->cmnd = $items->cmnd;
        $thongke->number = $row->number;
        $thongke->price = $items->price + $items->price_cat + $ship->ship;
        $date= date('Y-m-d');
        /*echo $year = substr($date, 0,4);
        echo $month = substr($date, 5,2);*/
        $thongke->date = date('Y-m-d');
        $thongke->stateid = 1;
        $thongke->created_at = date('Y-m-d H:i:s');
        $thongke->updated_at = date('Y-m-d H:i:s');

        $items->save();
        $row->save();
        $thongke->save();
        return redirect()->back()->with('message','Đã nhận hàng thành công');
    }

    public function deleteallship(){
        $data = Order::all();
        foreach ($data as $key){
            $id = Order::find($key->id);
            if($id->stateid==4){
                $id->delete();
            }
        }
        return redirect()->back()->with('message','Đã xóa tất cả đơn hàng đang vận chuyển');
    }

    /*public function successallship(){
        $data = Order::all();
        foreach ($data as $key){
        $id = Order::find($key->id);
        if($id->stateid==4){
            $id->stateid = 5;
            $id->save();
        }
    }
        return redirect()->back()->with('message','Đã nhận tiền tất cả đơn hàng đang vận chuyển');
    }*/
    public function deleteallpay(){
        $data = Order::all();
        foreach ($data as $key){
            $id = Order::find($key->id);
            if($id->stateid==5){
                $id->delete();
            }
        }
        return redirect()->back()->with('message','Đã xóa tất cả đơn hàng đã thanh toán');
    }

    public function deleteallfail(){
        $data = Order::all();
        foreach ($data as $key){
            $id = Order::find($key->id);
            if($id->stateid==6){
                $id->delete();
            }
        }
        return redirect()->back()->with('message','Đã xóa tất cả đơn hàng đã bị hủy');
    }
}
