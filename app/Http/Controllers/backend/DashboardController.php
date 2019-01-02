<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Models\Thongke;
use App\Models\Seo;
use Excel;
use Symfony\Component\HttpFoundation\Cookie;

class DashboardController extends Controller
{

    public function index(){
        $ss = Session::get('login');
        $id_login = $ss->id; 

        $data = Thongke::orderBy('date','desc')->where('stateid',1)->get();
        $data2 = Thongke::where('stateid',2)->get();
        $sum = 0;
        foreach ($data as $zzz) {
          $sum += $zzz->price;
      }
      return response()->view('admin.dashboard',['data'=>$data,'data2'=>$data2,'sum'=>$sum])->withCookie(cookie()->forever('trangthailogin', 'true|'.$id_login));
  }
  public function getlogout(){
    Session::flush();
    return redirect()->route('getlogin')->withCookie(cookie()->forever('trangthailogin', 'false'));

}
public function thongke($slug){
 $data = Thongke::orderBy('date','desc')->where('stateid',1)->get();
 return view('admin.thongke.index',['data'=>$data,'date'=>$slug]);
}
public function getexportthongke(){

    $count = Thongke::where('stateid',1)->get();
    if(count($count)){
        Excel::create('Thống kê', function($excel) {
            $excel->sheet('Sheet 1', function($sheet){
                $products= Thongke::where('stateid',1)->get();
                foreach($products as $product) {
                 $data[] = array(
                    $product->fullname,
                    $product->cmnd,
                    $product->number,
                    $product->price,
                    $product->created_at,
                );
             }
             $sheet->fromArray($data, null, 'A1', false, false);
             $headings = array('Họ và tên', 'Số CMND', 'Số sim đã bán', 'Tổng giá', 'Thời gian thanh toán');
             $sheet->prependRow(1, $headings);
         });
        })->export('xlsx');
    }else{
        return redirect()->back()->with('message','Dữ liệu trống không thể Export');
    }

}


public function export($date){
 global $d;
 $d = $date;
 Excel::create('Thống kê tháng '.$date, function($excel) {
    $excel->sheet('Sheet 1', function($sheet){
        $products= Thongke::where('stateid',1)->get();
        global $d;
        foreach($products as $product){
         $year = substr($product->date, 0,4);
         $month = substr($product->date, 5,2);
         $time = $month."-".$year;
         if($time == $d){
             $data[] = array(
                $product->fullname,
                $product->cmnd,
                $product->number,
                $product->price,
                $product->created_at,
            );
         }
     }
     $sheet->fromArray($data, null, 'A1', false, false);
     $headings = array('Họ và tên', 'Số CMND', 'Số sim đã bán', 'Tổng giá', 'Thời gian thanh toán');
     $sheet->prependRow(1, $headings);
 });
})->export('xlsx');
}


public function deleteall(){
    $data = Thongke::all();
    foreach ($data as $key){
       $id = Thongke::find($key->id);
       if($id->id!=0){
        $id->delete();
    }
}
return redirect()->back()->with('message','Xóa tất cả thành công');
}
public function deletedate($date){
 $data = Thongke::all();
 foreach ($data as $key){
   $id = Thongke::find($key->id);
   $year = substr($key->date, 0,4);$month = substr($key->date, 5,2);
   $time = $month."-".$year;
   if($time == $date){
     $id->delete();
 } 
}
return redirect()->route('getdashboard')->with('message','Xóa doanh thu trong tháng '.$date.' thành công');
}

public function seo(){
    $row = Seo::where('id',1)->first();
    return view('admin.seo.index',['row'=>$row]);
}

public function updateseo(Request $request){
    $row = Seo::where('id',1)->first();
    $items = Seo::find($row->id);
    $items->title = $request->title;
    $items->url = $request->url;
    $items->author = $request->author;
    $items->toado = $request->toado;
    $items->metadesc = $request->metadesc;
    $items->metakey = $request->metakey;
    $items->address = $request->address;
    $items->code = $request->code;
    $items->updated_at = date('Y-m-d H:i:s');
    $items->save();
    return redirect()->route('seo')->with('message','Cập nhật thành công');


}
}
