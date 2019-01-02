<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Nhamang;
use App\Models\province;
use App\Models\district;
use App\Models\tinhthanh;
use App\Models\quanhuyen;
use App\Models\xaphuong;
use App\Models\Order;
use App\Models\Simstyle;
use App\Models\Infor_customer;
use App\Models\Ship;
use App\Models\User;
use Mail;


class SanphamController extends Controller
{
   public function getIndex ($slug){
    $row = Category::where('slug',$slug)->where('stateid',1)->first();
    //echo'<pre>';print_r($row);die;
    if(count($row)){
        $listcat = Category::where('parentid',$row->id)->select('id')->get();
        $mang[] = $row->id;
        foreach ($listcat as $v) {
            $mang[] = $v['id'];
        }
        $data = Product::wherein('catid',$mang)
        ->where('stateid',1)
        ->orderBy('id','desc')
        ->get();
        $nm = Nhamang::where('stateid',1)->get();
        $style = Simstyle::all();
        return view('page.sanpham',['list'=>$data,'nm'=>$nm,'row'=>$row,'style'=>$style]);
    }else{
        return redirect()->route('trangchu')->with('message','Trang không tồn tại');
    }
}
public function tinhthanh(Request $request){
    $data_tinh = tinhthanh::where('matp','=',$request->ID_PROVINCE)->get();
    return response()->json($data_tinh);
}
public function listquanhuyen(Request $request){
    //$id_province = Input::get('id_province');
    $data_district = quanhuyen::where('matp','=',$request->ID_PROVINCE)->get();
    return response()->json($data_district);
}
public function dataquanhuyen(Request $request){
    $district = quanhuyen::where('maqh','=',$request->ID_DIST)->get();
    return response()->json($district);
}
public function listphuongxa(Request $request){
    $data_phuongxa = xaphuong::where('maqh','=',$request->ID_DIST)->get();
    return response()->json($data_phuongxa);
}
public function dataphuongxa(Request $request){
    $xaphuong = xaphuong::where('xaid','=',$request->ID_XA)->get();
    return response()->json($xaphuong);
}

public function getmuahang($id){
   $row = Product::where('id',$id)->where('stateid',1)->first();
   if(count($row)){
    $cat = Category::where('stateid',1)->where('id',$row->catid)->first();
    $ship = Ship::where('id',1)->first();
    $province = tinhthanh::all();//Tỉnh thành
    return view('page.muahang',['row'=>$row,'cat'=>$cat,'ship'=>$ship,'province'=>$province]);
}else{
    return redirect()->route('trangchu')->with('message','Sản phẩm đã được bán');
}
}
public function sanpham(){
    return redirect()->route('trangchu');
}

public function postDatHang(Request $request,$id){
    $stateproduct = Product::find($id);
    $stateproduct->stateid = 3;
    $gioi_tinh = $request->male_f;
    $khach_hang = $request->fullname;
    $items = new Order();
    $items->idorder = time();
    $items->productid = $request->productid;
    $items->price = $request->price;
    $items->price_cat = $request->pricecat;
    $items->fullname = $request->fullname;
    $items->sex = $request->male_f;
    $items->createdate = date('Y-m-d H:i:s');
    $items->shipdate = $request->shipdate;
    $items->phone = $request->phone;
    $items->cmnd = $request->cmnd;
    $items->email = $request->email;
    $items->stateid = 3;
    $items->address = $request->sonha.", ".$request->phuong.", ".$request->quan.", ".$request->tinh;
    $items->shiptime = $request->shiptime;
    $items->productid = $request->productid;
    $items->price = $request->price;

    /*$cmnd = $request->cmnd;
    $cus = Infor_customer::where('cmnd',$cmnd)->first();
    $id = $cus->id;
    $data = Infor_customer::find($id);
    if($cmnd == $data->cmnd)*/
    $data = new Infor_customer();
    $data->orderid =  $items->idorder;
    $data->name = $request->fullname;
    $data->productid = $request->number;
    $data->price = $request->price + $request->pricecat +$request->ship;
    $data->phone =$request->phone;
    $data->cmnd=$request->cmnd;
    $data->email=$request->email;
    $data->createdate = date('Y-m-d H:i:s');
    $data->save();
    $items->save();
    $stateproduct->save();

    $id = $items->id;
    $order = Order::find($id);
    $prod = Product::where('id',$order->productid)->first();
    $cate = Category::where('id',$prod->catid)->first();

    $fuck = User::where('id',1)->first();
    $emailadmin = $fuck->email;
    Mail::send('order',['order'=>$order,'prod'=>$prod,'cate'=>$cate,'emailadmin'=>$emailadmin],function($msg) use ($order,$prod,$cate,$emailadmin){
        $msg->from('hethongsimsodep@gmail.com','Thông báo đặt hàng');
        $msg->to($emailadmin);
        $msg->subject('Đây là mail hệ thống');
    });

    return redirect()->route('trangchu')->with('message','Cám ơn '.' '.$khach_hang.' '.'đã đặt hàng với chúng tôi, chúng tôi sẽ liên lạc lại sớm nhất có thể');
}

public function ajax(Request $request){
    $key = $_GET['id'];
    $cate = $_GET['cat'];
    $price = $_GET['price'];

    if($price==0){
        if($key!=0){
            $product = Product::where('styleid',$key)->where('catid',$cate)->where('stateid',1)->orderBy('id','desc')->get();
            $nm = Nhamang::all();
            foreach ($product as $row) {
                echo "<div class='kiu row' style='margin-left: 0px;margin-right: -10px;'>
                <div class='ku col-md-3 col-sm-5 col-xs-5' style='color:#2898e0;padding-left:0px;'><strong>".$row->number."</strong></div>
                <div class='ku col-md-3 col-xs-3 text-center' style='color:#d2021b;'><strong>".number_format($row->price)."</strong><sup>đ</sup></div>

                <div class='ku col-md-3 col-sm-2 col-xs-2 text-center'>";
                foreach($nm as $nmm){
                    if($nmm->id == $row->nhamang)
                        {echo $nmm->name;}
                }
                echo "</div>
                <div class='ku col-md-3 col-sm-2 col-xs-2 text-center' style='color:#2898e0;'><a href='".url('mua-hang/'.$row->id)."' style='padding: 0px 46% 0px 46%; '><strong>MUA</strong></a></div>
                </div>";
            }}else{
                $product = Product::where('catid',$cate)->where('stateid',1)->orderBy('id','desc')->get();
                $nm = Nhamang::all();
                foreach ($product as $row) {
                    echo "<div class='kiu row' style='margin-left: 0px;margin-right: -10px;'>
                    <div class='searchable-container'>
                    <div class='itemss'>
                    <div class='ku col-md-3 col-sm-5 col-xs-5' style='color:#2898e0;padding-left:0px;'><strong>".$row->number."</strong></div>
                    <div class='ku col-md-3 col-xs-3 text-center' style='color:#d2021b;'><strong>".number_format($row->price)."</strong><sup>đ</sup></div>

                    <div class='ku col-md-3 col-sm-2 col-xs-2 text-center'>";
                    foreach($nm as $nmm){
                        if($nmm->id == $row->nhamang)
                            {echo $nmm->name;}
                    }
                    echo "</div>
                    <div class='ku col-md-3 col-sm-2 col-xs-2 text-center' style='color:#2898e0;'><a href='".url('mua-hang/'.$row->id)."' style='padding: 0px 46% 0px 46%; '><strong>MUA</strong></a></div>
                    </div>
                    </div>
                    </div>";
                }
            }
        } else if($price!=0){
            if($key!=0){
                $product = Product::where('styleid',$key)->where('price',$price)->where('catid',$cate)->where('stateid',1)->orderBy('id','desc')->get();
                $nm = Nhamang::all();
                foreach ($product as $row) {
                    echo "<div class='kiu row' style='margin-left: 0px;margin-right: -10px;'>
                    <div class='ku col-md-3 col-sm-5 col-xs-5' style='color:#2898e0;padding-left:0px;'><strong>".$row->number."</strong></div>
                    <div class='ku col-md-3 col-xs-3 text-center' style='color:#d2021b;'><strong>".number_format($row->price)."</strong><sup>đ</sup></div>

                    <div class='ku col-md-3 col-sm-2 col-xs-2 text-center'>";
                    foreach($nm as $nmm){
                        if($nmm->id == $row->nhamang)
                            {echo $nmm->name;}
                    }
                    echo "</div>
                    <div class='ku col-md-3 col-sm-2 col-xs-2 text-center' style='color:#2898e0;'><a href='".url('mua-hang/'.$row->id)."' style='padding: 0px 46% 0px 46%; '><strong>MUA</strong></a></div>
                    </div>";
                }}else{
                    $product = Product::where('catid',$cate)->where('price',$price)->where('stateid',1)->orderBy('id','desc')->get();
                    $nm = Nhamang::all();
                    foreach ($product as $row) {
                        echo "<div class='kiu row' style='margin-left: 0px;margin-right: -10px;'>
                        <div class='searchable-container'>
                        <div class='itemss'>
                        <div class='ku col-md-3 col-sm-5 col-xs-5' style='color:#2898e0;padding-left:0px;'><strong>".$row->number."</strong></div>
                        <div class='ku col-md-3 col-xs-3 text-center' style='color:#d2021b;'><strong>".number_format($row->price)."</strong><sup>đ</sup></div>

                        <div class='ku col-md-3 col-sm-2 col-xs-2 text-center'>";
                        foreach($nm as $nmm){
                            if($nmm->id == $row->nhamang)
                                {echo $nmm->name;}
                        }
                        echo "</div>
                        <div class='ku col-md-3 col-sm-2 col-xs-2 text-center' style='color:#2898e0;'><a href='".url('mua-hang/'.$row->id)."' style='padding: 0px 46% 0px 46%; '><strong>MUA</strong></a></div>
                        </div>
                        </div>
                        </div>";
                    }
                }
            }


        }

        public function postsearch(Request $request){
           $key = $request->keysearch;
           $catid =$request->catid;

           $nm = Nhamang::where('stateid',1)->get();
           $style = Simstyle::all();
           $row = Category::where('id',$catid)->where('stateid',1)->first();
           if($key==null)
            return redirect()->back();
        else{
            $str = substr($key,0,1);
            $strlast =substr($key,-1,1);
            $strmid =substr($key,3,1);

            if($str == "*"){
                $num = str_replace("*","",$key);
                $product = Product::where('number','like','%'.$num)
                ->where('catid',$catid)
                ->where('stateid',1)
                ->orderBy('id','desc')
                ->get();
                $cou = count($product);
            }else if($strlast =="*"){
                $num = str_replace("*","",$key);
                $product = Product::where('number','like',$num.'%')
                ->where('catid',$catid)
                ->where('stateid',1)
                ->orderBy('id','desc')
                ->get();
                $cou = count($product);

            }else if($strmid == "*"){
                $mid =explode("*",$key);
                $first = $mid[0];
                $last = $mid[1];
                $product = Product::where('number','like',$first.'%'.$last)
                ->where('catid',$catid)
                ->where('stateid',1)
                ->orderBy('id','desc')
                ->get();
                $cou = count($product);
            }


            else{
                $product = Product::where('number','like','%'.$key.'%')
                ->where('catid',$catid)
                ->where('stateid',1)
                ->orderBy('id','desc')
                ->get();
                $cou = count($product);

            }
            return view('page.search',compact('product'),[
                'key'=>$key,
                'cou'=>$cou,
                'nm'=>$nm,
                'row'=>$row,
                'style'=>$style
            ]);
        }
    }

    public function proajaxsearch(){
        $keyid = $_GET['id'];
        $cate = $_GET['cat'];
        $key = $_GET['key'];
        $nm = Nhamang::where('stateid',1)->get();

        $str = substr($key,0,1);
        $strlast =substr($key,-1,1);
        $strmid =substr($key,3,1);

        if($keyid!=0){
            if($str == "*"){
                $num = str_replace("*","",$key);
                $product = Product::where('number','like','%'.$num)
                ->where('catid',$cate)
                ->where('styleid',$keyid)
                ->where('stateid',1)
                ->orderBy('id','desc')
                ->get();
                foreach ($product as $row) {
                    echo "<div class='kiu row' style='margin-left: 0px;margin-right: -10px;'>
                    <div class='searchable-container'>
                    <div class='itemss'>
                    <div class='ku col-md-3 col-sm-5 col-xs-5' style='color:#2898e0;padding-left:0px;'><strong>".$row->number."</strong></div>
                    <div class='ku col-md-3 col-xs-3 text-center' style='color:#d2021b;'><strong>".number_format($row->price)."</strong><sup>đ</sup></div>

                    <div class='ku col-md-3 col-sm-2 col-xs-2 text-center'>";
                    foreach($nm as $nmm){
                        if($nmm->id == $row->nhamang)
                            {echo $nmm->name;}
                    }
                    echo "</div>
                    <div class='ku col-md-3 col-sm-2 col-xs-2 text-center' style='color:#2898e0;'><a href='".url('mua-hang/'.$row->id)."' style='padding: 0px 46% 0px 46%; '><strong>MUA</strong></a></div>
                    </div>
                    </div>
                    </div>";
                }
            }else if($strlast =="*"){
                $num = str_replace("*","",$key);
                $product = Product::where('number','like',$num.'%')
                ->where('catid',$cate)
                ->where('styleid',$keyid)
                ->where('stateid',1)
                ->orderBy('id','desc')
                ->get();
                foreach ($product as $row) {
                    echo "<div class='kiu row' style='margin-left: 0px;margin-right: -10px;'>
                    <div class='searchable-container'>
                    <div class='itemss'>
                    <div class='ku col-md-3 col-sm-5 col-xs-5' style='color:#2898e0;padding-left:0px;'><strong>".$row->number."</strong></div>
                    <div class='ku col-md-3 col-xs-3 text-center' style='color:#d2021b;'><strong>".number_format($row->price)."</strong><sup>đ</sup></div>

                    <div class='ku col-md-3 col-sm-2 col-xs-2 text-center'>";
                    foreach($nm as $nmm){
                        if($nmm->id == $row->nhamang)
                            {echo $nmm->name;}
                    }
                    echo "</div>
                    <div class='ku col-md-3 col-sm-2 col-xs-2 text-center' style='color:#2898e0;'><a href='".url('mua-hang/'.$row->id)."' style='padding: 0px 46% 0px 46%; '><strong>MUA</strong></a></div>
                    </div>
                    </div>
                    </div>";
                }

            }else if($strmid == "*"){
                $mid =explode("*",$key);
                $first = $mid[0];
                $last = $mid[1];
                $product = Product::where('number','like',$first.'%'.$last)
                ->where('catid',$cate)
                ->where('stateid',1)
                ->where('styleid',$keyid)
                ->orderBy('id','desc')
                ->get();
                $cou = count($product);
                foreach ($product as $row) {
                    echo "<div class='kiu row' style='margin-left: 0px;margin-right: -10px;'>
                    <div class='searchable-container'>
                    <div class='itemss'>
                    <div class='ku col-md-3 col-sm-5 col-xs-5' style='color:#2898e0;padding-left:0px;'><strong>".$row->number."</strong></div>
                    <div class='ku col-md-3 col-xs-3 text-center' style='color:#d2021b;'><strong>".number_format($row->price)."</strong><sup>đ</sup></div>

                    <div class='ku col-md-3 col-sm-2 col-xs-2 text-center'>";
                    foreach($nm as $nmm){
                        if($nmm->id == $row->nhamang)
                            {echo $nmm->name;}
                    }
                    echo "</div>
                    <div class='ku col-md-3 col-sm-2 col-xs-2 text-center' style='color:#2898e0;'><a href='".url('mua-hang/'.$row->id)."' style='padding: 0px 46% 0px 46%; '><strong>MUA</strong></a></div>
                    </div>
                    </div>
                    </div>";
                }
            }else if(($str != "*") &&($strlast!= "*") &&($strmid!= "*")){
                $product = Product::where('number','like','%'.$key.'%')
                ->where('catid',$cate)
                ->where('styleid',$keyid)
                ->where('stateid',1)
                ->orderBy('id','desc')
                ->get();
                foreach ($product as $row) {
                    echo "<div class='kiu row' style='margin-left: 0px;margin-right: -10px;'>
                    <div class='searchable-container'>
                    <div class='itemss'>
                    <div class='ku col-md-3 col-sm-5 col-xs-5' style='color:#2898e0;padding-left:0px;'><strong>".$row->number."</strong></div>
                    <div class='ku col-md-3 col-xs-3 text-center' style='color:#d2021b;'><strong>".number_format($row->price)."</strong><sup>đ</sup></div>

                    <div class='ku col-md-3 col-sm-2 col-xs-2 text-center'>";
                    foreach($nm as $nmm){
                        if($nmm->id == $row->nhamang)
                            {echo $nmm->name;}
                    }
                    echo "</div>
                    <div class='ku col-md-3 col-sm-2 col-xs-2 text-center' style='color:#2898e0;'><a href='".url('mua-hang/'.$row->id)."' style='padding: 0px 46% 0px 46%; '><strong>MUA</strong></a></div>
                    </div>
                    </div>
                    </div>";
                }

            }}else{
                if($str == "*"){
                    $num = str_replace("*","",$key);
                    $product = Product::where('number','like','%'.$num)
                    ->where('catid',$cate)
                    ->where('stateid',1)
                    ->orderBy('id','desc')
                    ->get();
                    foreach ($product as $row) {
                        echo "<div class='kiu row' style='margin-left: 0px;margin-right: -10px;'>
                        <div class='searchable-container'>
                        <div class='itemss'>
                        <div class='ku col-md-3 col-sm-5 col-xs-5' style='color:#2898e0;padding-left:0px;'><strong>".$row->number."</strong></div>
                        <div class='ku col-md-3 col-xs-3 text-center' style='color:#d2021b;'><strong>".number_format($row->price)."</strong><sup>đ</sup></div>

                        <div class='ku col-md-3 col-sm-2 col-xs-2 text-center'>";
                        foreach($nm as $nmm){
                            if($nmm->id == $row->nhamang)
                                {echo $nmm->name;}
                        }
                        echo "</div>
                        <div class='ku col-md-3 col-sm-2 col-xs-2 text-center' style='color:#2898e0;'><a href='".url('mua-hang/'.$row->id)."' style='padding: 0px 46% 0px 46%; '><strong>MUA</strong></a></div>
                        </div>
                        </div>
                        </div>";
                    }
                }else if($strlast =="*"){
                    $num = str_replace("*","",$key);
                    $product = Product::where('number','like',$num.'%')
                    ->where('catid',$cate)
                    ->where('stateid',1)
                    ->orderBy('id','desc')
                    ->get();
                    foreach ($product as $row) {
                        echo "<div class='kiu row' style='margin-left: 0px;margin-right: -10px;'>
                        <div class='searchable-container'>
                        <div class='itemss'>
                        <div class='ku col-md-3 col-sm-5 col-xs-5' style='color:#2898e0;padding-left:0px;'><strong>".$row->number."</strong></div>
                        <div class='ku col-md-3 col-xs-3 text-center' style='color:#d2021b;'><strong>".number_format($row->price)."</strong><sup>đ</sup></div>

                        <div class='ku col-md-3 col-sm-2 col-xs-2 text-center'>";
                        foreach($nm as $nmm){
                            if($nmm->id == $row->nhamang)
                                {echo $nmm->name;}
                        }
                        echo "</div>
                        <div class='ku col-md-3 col-sm-2 col-xs-2 text-center' style='color:#2898e0;'><a href='".url('mua-hang/'.$row->id)."' style='padding: 0px 46% 0px 46%; '><strong>MUA</strong></a></div>
                        </div>
                        </div>
                        </div>";
                    }

                }else{
                    $product = Product::where('number','like','%'.$key.'%')
                    ->where('catid',$cate)
                    ->where('stateid',1)
                    ->orderBy('id','desc')
                    ->get();
                    foreach ($product as $row) {
                        echo "<div class='kiu row' style='margin-left: 0px;margin-right: -10px;'>
                        <div class='searchable-container'>
                        <div class='itemss'>
                        <div class='ku col-md-3 col-sm-5 col-xs-5' style='color:#2898e0;padding-left:0px;'><strong>".$row->number."</strong></div>
                        <div class='ku col-md-3 col-xs-3 text-center' style='color:#d2021b;'><strong>".number_format($row->price)."</strong><sup>đ</sup></div>

                        <div class='ku col-md-3 col-sm-2 col-xs-2 text-center'>";
                        foreach($nm as $nmm){
                            if($nmm->id == $row->nhamang)
                                {echo $nmm->name;}
                        }
                        echo "</div>
                        <div class='ku col-md-3 col-sm-2 col-xs-2 text-center' style='color:#2898e0;'><a href='".url('mua-hang/'.$row->id)."' style='padding: 0px 46% 0px 46%; '><strong>MUA</strong></a></div>
                        </div>
                        </div>
                        </div>";
                    }

                }
            }

        }


        public function ajaxcheck(){

        }
        public function ajaxchecksp(){
            $key = $_GET['id'];
            $cate = $_GET['cat'];
            $loai = $_GET['loai'];
            $price = $_GET['price'];

            if(($loai==0) && ($price==0)){
                $product = Product::where('catid',$cate)->where('stateid',1)->orderBy('id','desc')->get();
                $nm = Nhamang::all();
                if($key==10){
                    foreach ($product as $value) {
                        $ku = strlen($value->number);
                        if($ku == $key){
                            echo "<div class='kiu row' style='margin-left: 0px;margin-right: -10px;'>
                            <div class='searchable-container'>
                            <div class='itemss'>
                            <div class='ku col-md-3 col-sm-5 col-xs-5' style='color:#2898e0;padding-left:0px;'><strong>".$value->number."</strong></div>
                            <div class='ku col-md-3 col-xs-3 text-center' style='color:#d2021b;'><strong>".number_format($value->price)."</strong><sup>đ</sup></div>
                            <div class='ku col-md-3 col-sm-2 col-xs-2 text-center'>";
                            foreach($nm as $nmm){
                                if($nmm->id == $value->nhamang)
                                    {echo $nmm->name;}
                            }
                            echo "</div>
                            <div class='ku col-md-3 col-sm-2 col-xs-2 text-center' style='color:#2898e0;'><a href='".url('mua-hang/'.$value->id)."' style='padding: 0px 46% 0px 46%; '><strong>MUA</strong></a></div>
                            </div>
                            </div>
                            </div>";
                        }    
                    }
                }else{
                    foreach ($product as $value) {
                        echo "<div class='kiu row' style='margin-left: 0px;margin-right: -10px;'>
                        <div class='searchable-container'>
                        <div class='itemss'>
                        <div class='ku col-md-3 col-sm-5 col-xs-5' style='color:#2898e0;padding-left:0px;'><strong>".$value->number."</strong></div>
                        <div class='ku col-md-3 col-xs-3 text-center' style='color:#d2021b;'><strong>".number_format($value->price)."</strong><sup>đ</sup></div>

                        <div class='ku col-md-3 col-sm-2 col-xs-2 text-center'>";
                        foreach($nm as $nmm){
                            if($nmm->id == $value->nhamang)
                                {echo $nmm->name;}
                        }
                        echo "</div>
                        <div class='ku col-md-3 col-sm-2 col-xs-2 text-center' style='color:#2898e0;'><a href='".url('mua-hang/'.$value->id)."' style='padding: 0px 46% 0px 46%; '><strong>MUA</strong></a></div>
                        </div>
                        </div>
                        </div>";
                    }
                } 
                /* */ 
            }else if(($price==0) && ($loai!=0)){
                $product = Product::where('catid',$cate)->where('styleid',$loai)->where('stateid',1)->orderBy('id','desc')->get();
                $nm = Nhamang::all();
                if($key==10){
                    foreach ($product as $value) {
                        $ku = strlen($value->number);
                        if($ku == $key){
                            echo "<div class='kiu row' style='margin-left: 0px;margin-right: -10px;'>
                            <div class='searchable-container'>
                            <div class='itemss'>
                            <div class='ku col-md-3 col-sm-5 col-xs-5' style='color:#2898e0;padding-left:0px;'><strong>".$value->number."</strong></div>
                            <div class='ku col-md-3 col-xs-3 text-center' style='color:#d2021b;'><strong>".number_format($value->price)."</strong><sup>đ</sup></div>
                            <div class='ku col-md-3 col-sm-2 col-xs-2 text-center'>";
                            foreach($nm as $nmm){
                                if($nmm->id == $value->nhamang)
                                    {echo $nmm->name;}
                            }
                            echo "</div>
                            <div class='ku col-md-3 col-sm-2 col-xs-2 text-center' style='color:#2898e0;'><a href='".url('mua-hang/'.$value->id)."' style='padding: 0px 46% 0px 46%; '><strong>MUA</strong></a></div>
                            </div>
                            </div>
                            </div>";
                        }    
                    }
                }else{
                    foreach ($product as $value) {
                        echo "<div class='kiu row' style='margin-left: 0px;margin-right: -10px;'>
                        <div class='searchable-container'>
                        <div class='itemss'>
                        <div class='ku col-md-3 col-sm-5 col-xs-5' style='color:#2898e0;padding-left:0px;'><strong>".$value->number."</strong></div>
                        <div class='ku col-md-3 col-xs-3 text-center' style='color:#d2021b;'><strong>".number_format($value->price)."</strong><sup>đ</sup></div>

                        <div class='ku col-md-3 col-sm-2 col-xs-2 text-center'>";
                        foreach($nm as $nmm){
                            if($nmm->id == $value->nhamang)
                                {echo $nmm->name;}
                        }
                        echo "</div>
                        <div class='ku col-md-3 col-sm-2 col-xs-2 text-center' style='color:#2898e0;'><a href='".url('mua-hang/'.$value->id)."' style='padding: 0px 46% 0px 46%; '><strong>MUA</strong></a></div>
                        </div>
                        </div>
                        </div>";
                    }
                }
            }else if($price!=0 && $loai==0){
                $product = Product::where('catid',$cate)->where('price',$price)->where('stateid',1)->orderBy('id','desc')->get();
                $nm = Nhamang::all();
                if($key==10){
                    foreach ($product as $value) {
                        $ku = strlen($value->number);
                        if($ku == $key){
                            echo "<div class='kiu row' style='margin-left: 0px;margin-right: -10px;'>
                            <div class='searchable-container'>
                            <div class='itemss'>
                            <div class='ku col-md-3 col-sm-5 col-xs-5' style='color:#2898e0;padding-left:0px;'><strong>".$value->number."</strong></div>
                            <div class='ku col-md-3 col-xs-3 text-center' style='color:#d2021b;'><strong>".number_format($value->price)."</strong><sup>đ</sup></div>
                            <div class='ku col-md-3 col-sm-2 col-xs-2 text-center'>";
                            foreach($nm as $nmm){
                                if($nmm->id == $value->nhamang)
                                    {echo $nmm->name;}
                            }
                            echo "</div>
                            <div class='ku col-md-3 col-sm-2 col-xs-2 text-center' style='color:#2898e0;'><a href='".url('mua-hang/'.$value->id)."' style='padding: 0px 46% 0px 46%; '><strong>MUA</strong></a></div>
                            </div>
                            </div>
                            </div>";
                        }    
                    }
                }else{
                    foreach ($product as $value) {
                        echo "<div class='kiu row' style='margin-left: 0px;margin-right: -10px;'>
                        <div class='searchable-container'>
                        <div class='itemss'>
                        <div class='ku col-md-3 col-sm-5 col-xs-5' style='color:#2898e0;padding-left:0px;'><strong>".$value->number."</strong></div>
                        <div class='ku col-md-3 col-xs-3 text-center' style='color:#d2021b;'><strong>".number_format($value->price)."</strong><sup>đ</sup></div>

                        <div class='ku col-md-3 col-sm-2 col-xs-2 text-center'>";
                        foreach($nm as $nmm){
                            if($nmm->id == $value->nhamang)
                                {echo $nmm->name;}
                        }
                        echo "</div>
                        <div class='ku col-md-3 col-sm-2 col-xs-2 text-center' style='color:#2898e0;'><a href='".url('mua-hang/'.$value->id)."' style='padding: 0px 46% 0px 46%; '><strong>MUA</strong></a></div>
                        </div>
                        </div>
                        </div>";
                    }
                }
            }else if($price!=0 && $loai!=0){
                $product = Product::where('catid',$cate)->where('price',$price)->where('styleid',$loai)->where('stateid',1)->orderBy('id','desc')->get();
                $nm = Nhamang::all();
                if($key==10){
                    foreach ($product as $value) {
                        $ku = strlen($value->number);
                        if($ku == $key){
                            echo "<div class='kiu row' style='margin-left: 0px;margin-right: -10px;'>
                            <div class='searchable-container'>
                            <div class='itemss'>
                            <div class='ku col-md-3 col-sm-5 col-xs-5' style='color:#2898e0;padding-left:0px;'><strong>".$value->number."</strong></div>
                            <div class='ku col-md-3 col-xs-3 text-center' style='color:#d2021b;'><strong>".number_format($value->price)."</strong><sup>đ</sup></div>
                            <div class='ku col-md-3 col-sm-2 col-xs-2 text-center'>";
                            foreach($nm as $nmm){
                                if($nmm->id == $value->nhamang)
                                    {echo $nmm->name;}
                            }
                            echo "</div>
                            <div class='ku col-md-3 col-sm-2 col-xs-2 text-center' style='color:#2898e0;'><a href='".url('mua-hang/'.$value->id)."' style='padding: 0px 46% 0px 46%; '><strong>MUA</strong></a></div>
                            </div>
                            </div>
                            </div>";
                        }    
                    }
                }else{
                    foreach ($product as $value) {
                        echo "<div class='kiu row' style='margin-left: 0px;margin-right: -10px;'>
                        <div class='searchable-container'>
                        <div class='itemss'>
                        <div class='ku col-md-3 col-sm-5 col-xs-5' style='color:#2898e0;padding-left:0px;'><strong>".$value->number."</strong></div>
                        <div class='ku col-md-3 col-xs-3 text-center' style='color:#d2021b;'><strong>".number_format($value->price)."</strong><sup>đ</sup></div>

                        <div class='ku col-md-3 col-sm-2 col-xs-2 text-center'>";
                        foreach($nm as $nmm){
                            if($nmm->id == $value->nhamang)
                                {echo $nmm->name;}
                        }
                        echo "</div>
                        <div class='ku col-md-3 col-sm-2 col-xs-2 text-center' style='color:#2898e0;'><a href='".url('mua-hang/'.$value->id)."' style='padding: 0px 46% 0px 46%; '><strong>MUA</strong></a></div>
                        </div>
                        </div>
                        </div>";
                    }
                }
            }

        }
        public function proajaxprice(){
            $key = $_GET['id'];
            $cate = $_GET['cat'];
            $loai = $_GET['loai'];

            if($loai != 0){
                if($key!=0){
                    $product = Product::where('price',$key)->where('styleid',$loai)->where('catid',$cate)->where('stateid',1)->orderBy('id','desc')->get();
                    $nm = Nhamang::all();
                    foreach ($product as $row) {
                        echo "<div class='kiu row' style='margin-left: 0px;margin-right: -10px;'>
                        <div class='ku col-md-3 col-sm-5 col-xs-5' style='color:#2898e0;padding-left:0px;'><strong>".$row->number."</strong></div>
                        <div class='ku col-md-3 col-xs-3 text-center' style='color:#d2021b;'><strong>".number_format($row->price)."</strong><sup>đ</sup></div>

                        <div class='ku col-md-3 col-sm-2 col-xs-2 text-center'>";
                        foreach($nm as $nmm){
                            if($nmm->id == $row->nhamang)
                                {echo $nmm->name;}
                        }
                        echo "</div>
                        <div class='ku col-md-3 col-sm-2 col-xs-2 text-center' style='color:#2898e0;'><a href='".url('mua-hang/'.$row->id)."' style='padding: 0px 46% 0px 46%; '><strong>MUA</strong></a></div>
                        </div>";
                    }}else{
                        $product = Product::where('catid',$cate)->where('styleid',$loai)->where('stateid',1)->orderBy('id','desc')->get();
                        $nm = Nhamang::all();
                        foreach ($product as $row) {
                            echo "<div class='kiu row' style='margin-left: 0px;margin-right: -10px;'>
                            <div class='searchable-container'>
                            <div class='itemss'>
                            <div class='ku col-md-3 col-sm-5 col-xs-5' style='color:#2898e0;padding-left:0px;'><strong>".$row->number."</strong></div>
                            <div class='ku col-md-3 col-xs-3 text-center' style='color:#d2021b;'><strong>".number_format($row->price)."</strong><sup>đ</sup></div>

                            <div class='ku col-md-3 col-sm-2 col-xs-2 text-center'>";
                            foreach($nm as $nmm){
                                if($nmm->id == $row->nhamang)
                                    {echo $nmm->name;}
                            }
                            echo "</div>
                            <div class='ku col-md-3 col-sm-2 col-xs-2 text-center' style='color:#2898e0;'><a href='".url('mua-hang/'.$row->id)."' style='padding: 0px 46% 0px 46%; '><strong>MUA</strong></a></div>
                            </div>
                            </div>
                            </div>";
                        }
                    }
                }else if($loai == 0){
                 if($key!=0){
                    $product = Product::where('price',$key)->where('catid',$cate)->where('stateid',1)->orderBy('id','desc')->get();
                    $nm = Nhamang::all();
                    foreach ($product as $row) {
                        echo "<div class='kiu row' style='margin-left: 0px;margin-right: -10px;'>
                        <div class='ku col-md-3 col-sm-5 col-xs-5' style='color:#2898e0;padding-left:0px;'><strong>".$row->number."</strong></div>
                        <div class='ku col-md-3 col-xs-3 text-center' style='color:#d2021b;'><strong>".number_format($row->price)."</strong><sup>đ</sup></div>

                        <div class='ku col-md-3 col-sm-2 col-xs-2 text-center'>";
                        foreach($nm as $nmm){
                            if($nmm->id == $row->nhamang)
                                {echo $nmm->name;}
                        }
                        echo "</div>
                        <div class='ku col-md-3 col-sm-2 col-xs-2 text-center' style='color:#2898e0;'><a href='".url('mua-hang/'.$row->id)."' style='padding: 0px 46% 0px 46%; '><strong>MUA</strong></a></div>
                        </div>";
                    }}else{
                        $product = Product::where('catid',$cate)->where('stateid',1)->orderBy('id','desc')->get();
                        $nm = Nhamang::all();
                        foreach ($product as $row) {
                            echo "<div class='kiu row' style='margin-left: 0px;margin-right: -10px;'>
                            <div class='searchable-container'>
                            <div class='itemss'>
                            <div class='ku col-md-3 col-sm-5 col-xs-5' style='color:#2898e0;padding-left:0px;'><strong>".$row->number."</strong></div>
                            <div class='ku col-md-3 col-xs-3 text-center' style='color:#d2021b;'><strong>".number_format($row->price)."</strong><sup>đ</sup></div>

                            <div class='ku col-md-3 col-sm-2 col-xs-2 text-center'>";
                            foreach($nm as $nmm){
                                if($nmm->id == $row->nhamang)
                                    {echo $nmm->name;}
                            }
                            echo "</div>
                            <div class='ku col-md-3 col-sm-2 col-xs-2 text-center' style='color:#2898e0;'><a href='".url('mua-hang/'.$row->id)."' style='padding: 0px 46% 0px 46%; '><strong>MUA</strong></a></div>
                            </div>
                            </div>
                            </div>";
                        }
                    } 
                }
            }
            public function ajaxcheckspsearch(){
                $id = $_GET['id'];
                $cat = $_GET['cat'];
                $key = $_GET['key'];
                $nm = Nhamang::where('stateid',1)->get();
                $str = substr($key,0,1); //LẤY 1 KÝ TỰ ĐẦU ( Ở ĐÂY LÀ *)
                $strlast =substr($key,-1,1); //LẤY 1 KÝ TỰ CUỐI CÙNG (Ở ĐÂY LÀ*)
                $strmid =substr($key,3,1); //LẤY 1 KÝ TỰ THỨ 3 (Ở ĐÂY LÀ *)

                if($id ==10){/*XUẤT SỐ BẰNG 10 DÙNG HÀM ĐẾM, NẾU NÓ BẰNG 10 THÌ XUẤT*/
                    if($str == "*"){ /*NẾU KÝ TỰ ĐẦU BẰNG * */
                        $num = str_replace("*","",$key);
                        $product = Product::where('number','like','%'.$num)
                        ->where('catid',$cat) 
                        /*->where('styleid',$id)*/
                        ->where('stateid',1)
                        ->orderBy('id','desc')
                        ->get();
                        foreach ($product as $row) {
                            $ku = strlen($row->number); // đếm số lượng thằng number;
                            if($ku == $id){// NẾU SỐ LƯỢNG NUMBER BẰNG VỚI GIÁ TRỊ CỦA VALUE CHECKBOX THÌ TIẾP
                                echo "<div class='kiu row' style='margin-left: 0px;margin-right: -10px;'>
                                <div class='searchable-container'>
                                <div class='itemss'>
                                <div class='ku col-md-3 col-sm-5 col-xs-5' style='color:#2898e0;padding-left:0px;'><strong>".$row->number."</strong></div>
                                <div class='ku col-md-3 col-xs-3 text-center' style='color:#d2021b;'><strong>".number_format($row->price)."</strong><sup>đ</sup></div>

                                <div class='ku col-md-3 col-sm-2 col-xs-2 text-center'>";
                                foreach($nm as $nmm){
                                    if($nmm->id == $row->nhamang)
                                        {echo $nmm->name;}
                                }
                                echo "</div>
                                <div class='ku col-md-3 col-sm-2 col-xs-2 text-center' style='color:#2898e0;'><a href='".url('mua-hang/'.$row->id)."' style='padding: 0px 46% 0px 46%; '><strong>MUA</strong></a></div>
                                </div>
                                </div>
                                </div>";
                            }
                            
                        }
                    }else if($strlast == "*"){
                        $num = str_replace("*","",$key);
                        $product = Product::where('number','like',$num.'%')
                        ->where('catid',$cat) 
                        /*->where('styleid',$id)*/
                        ->where('stateid',1)
                        ->orderBy('id','desc')
                        ->get();
                        foreach ($product as $row) {
                            $ku = strlen($row->number); // đếm số lượng thằng number;
                            if($ku == $id){// NẾU SỐ LƯỢNG NUMBER BẰNG VỚI GIÁ TRỊ CỦA VALUE CHECKBOX THÌ TIẾP
                                echo "<div class='kiu row' style='margin-left: 0px;margin-right: -10px;'>
                                <div class='searchable-container'>
                                <div class='itemss'>
                                <div class='ku col-md-3 col-sm-5 col-xs-5' style='color:#2898e0;padding-left:0px;'><strong>".$row->number."</strong></div>
                                <div class='ku col-md-3 col-xs-3 text-center' style='color:#d2021b;'><strong>".number_format($row->price)."</strong><sup>đ</sup></div>

                                <div class='ku col-md-3 col-sm-2 col-xs-2 text-center'>";
                                foreach($nm as $nmm){
                                    if($nmm->id == $row->nhamang)
                                        {echo $nmm->name;}
                                }
                                echo "</div>
                                <div class='ku col-md-3 col-sm-2 col-xs-2 text-center' style='color:#2898e0;'><a href='".url('mua-hang/'.$row->id)."' style='padding: 0px 46% 0px 46%; '><strong>MUA</strong></a></div>
                                </div>
                                </div>
                                </div>";
                            }
                            
                        }
                    }else if($strmid =="*"){
                        $mid =explode("*",$key);
                        $first = $mid[0];
                        $last = $mid[1];
                        $product = Product::where('number','like',$first.'%'.$last)
                        ->where('catid',$cat) 
                        /*->where('styleid',$id)*/
                        ->where('stateid',1)
                        ->orderBy('id','desc')
                        ->get();
                        foreach ($product as $row) {
                            $ku = strlen($row->number); // đếm số lượng thằng number;
                            if($ku == $id){// NẾU SỐ LƯỢNG NUMBER BẰNG VỚI GIÁ TRỊ CỦA VALUE CHECKBOX THÌ TIẾP
                                echo "<div class='kiu row' style='margin-left: 0px;margin-right: -10px;'>
                                <div class='searchable-container'>
                                <div class='itemss'>
                                <div class='ku col-md-3 col-sm-5 col-xs-5' style='color:#2898e0;padding-left:0px;'><strong>".$row->number."</strong></div>
                                <div class='ku col-md-3 col-xs-3 text-center' style='color:#d2021b;'><strong>".number_format($row->price)."</strong><sup>đ</sup></div>

                                <div class='ku col-md-3 col-sm-2 col-xs-2 text-center'>";
                                foreach($nm as $nmm){
                                    if($nmm->id == $row->nhamang)
                                        {echo $nmm->name;}
                                }
                                echo "</div>
                                <div class='ku col-md-3 col-sm-2 col-xs-2 text-center' style='color:#2898e0;'><a href='".url('mua-hang/'.$row->id)."' style='padding: 0px 46% 0px 46%; '><strong>MUA</strong></a></div>
                                </div>
                                </div>
                                </div>";
                            }     
                        }
                    }else if(($str != "*") &&($strlast!= "*") &&($strmid!= "*")){

                        $product = Product::where('number','like','%'.$key.'%')
                        ->where('catid',$cat) 
                        /*->where('styleid',$id)*/
                        ->where('stateid',1)
                        ->orderBy('id','desc')
                        ->get();
                        foreach ($product as $row) {
                            $ku = strlen($row->number); // đếm số lượng thằng number;
                            if($ku == $id){// NẾU SỐ LƯỢNG NUMBER BẰNG VỚI GIÁ TRỊ CỦA VALUE CHECKBOX THÌ TIẾP
                                echo "<div class='kiu row' style='margin-left: 0px;margin-right: -10px;'>
                                <div class='searchable-container'>
                                <div class='itemss'>
                                <div class='ku col-md-3 col-sm-5 col-xs-5' style='color:#2898e0;padding-left:0px;'><strong>".$row->number."</strong></div>
                                <div class='ku col-md-3 col-xs-3 text-center' style='color:#d2021b;'><strong>".number_format($row->price)."</strong><sup>đ</sup></div>

                                <div class='ku col-md-3 col-sm-2 col-xs-2 text-center'>";
                                foreach($nm as $nmm){
                                    if($nmm->id == $row->nhamang)
                                        {echo $nmm->name;}
                                }
                                echo "</div>
                                <div class='ku col-md-3 col-sm-2 col-xs-2 text-center' style='color:#2898e0;'><a href='".url('mua-hang/'.$row->id)."' style='padding: 0px 46% 0px 46%; '><strong>MUA</strong></a></div>
                                </div>
                                </div>
                                </div>";
                            }     
                        }                    
                    }
                }else{/*XUẤT TẤT CẢ THEO KEYSEARCH*/
                    if($str == "*"){ /*NẾU KÝ TỰ ĐẦU BẰNG * */
                        $num = str_replace("*","",$key);
                        $product = Product::where('number','like','%'.$num)
                        ->where('catid',$cat) 
                        /*->where('styleid',$id)*/
                        ->where('stateid',1)
                        ->orderBy('id','desc')
                        ->get();
                        foreach ($product as $row) {
                            echo "<div class='kiu row' style='margin-left: 0px;margin-right: -10px;'>
                            <div class='searchable-container'>
                            <div class='itemss'>
                            <div class='ku col-md-3 col-sm-5 col-xs-5' style='color:#2898e0;padding-left:0px;'><strong>".$row->number."</strong></div>
                            <div class='ku col-md-3 col-xs-3 text-center' style='color:#d2021b;'><strong>".number_format($row->price)."</strong><sup>đ</sup></div>
                            <div class='ku col-md-3 col-sm-2 col-xs-2 text-center'>";
                            foreach($nm as $nmm){
                                if($nmm->id == $row->nhamang)
                                    {echo $nmm->name;}
                            }
                            echo "</div>
                            <div class='ku col-md-3 col-sm-2 col-xs-2 text-center' style='color:#2898e0;'><a href='".url('mua-hang/'.$row->id)."' style='padding: 0px 46% 0px 46%; '><strong>MUA</strong></a></div>
                            </div>
                            </div>
                            </div>";        
                        }
                    }else if($strlast == "*"){
                        $num = str_replace("*","",$key);
                        $product = Product::where('number','like',$num.'%')
                        ->where('catid',$cat) 
                        /*->where('styleid',$id)*/
                        ->where('stateid',1)
                        ->orderBy('id','desc')
                        ->get();
                        foreach ($product as $row) {

                            echo "<div class='kiu row' style='margin-left: 0px;margin-right: -10px;'>
                            <div class='searchable-container'>
                            <div class='itemss'>
                            <div class='ku col-md-3 col-sm-5 col-xs-5' style='color:#2898e0;padding-left:0px;'><strong>".$row->number."</strong></div>
                            <div class='ku col-md-3 col-xs-3 text-center' style='color:#d2021b;'><strong>".number_format($row->price)."</strong><sup>đ</sup></div>

                            <div class='ku col-md-3 col-sm-2 col-xs-2 text-center'>";
                            foreach($nm as $nmm){
                                if($nmm->id == $row->nhamang)
                                    {echo $nmm->name;}
                            }
                            echo "</div>
                            <div class='ku col-md-3 col-sm-2 col-xs-2 text-center' style='color:#2898e0;'><a href='".url('mua-hang/'.$row->id)."' style='padding: 0px 46% 0px 46%; '><strong>MUA</strong></a></div>
                            </div>
                            </div>
                            </div>";
                        }
                    }else if($strmid =="*"){
                        $mid =explode("*",$key);
                        $first = $mid[0];
                        $last = $mid[1];
                        $product = Product::where('number','like',$first.'%'.$last)
                        ->where('catid',$cat) 
                        /*->where('styleid',$id)*/
                        ->where('stateid',1)
                        ->orderBy('id','desc')
                        ->get();
                        foreach ($product as $row) {
                            echo "<div class='kiu row' style='margin-left: 0px;margin-right: -10px;'>
                            <div class='searchable-container'>
                            <div class='itemss'>
                            <div class='ku col-md-3 col-sm-5 col-xs-5' style='color:#2898e0;padding-left:0px;'><strong>".$row->number."</strong></div>
                            <div class='ku col-md-3 col-xs-3 text-center' style='color:#d2021b;'><strong>".number_format($row->price)."</strong><sup>đ</sup></div>

                            <div class='ku col-md-3 col-sm-2 col-xs-2 text-center'>";
                            foreach($nm as $nmm){
                                if($nmm->id == $row->nhamang)
                                    {echo $nmm->name;}
                            }
                            echo "</div>
                            <div class='ku col-md-3 col-sm-2 col-xs-2 text-center' style='color:#2898e0;'><a href='".url('mua-hang/'.$row->id)."' style='padding: 0px 46% 0px 46%; '><strong>MUA</strong></a></div>
                            </div>
                            </div>
                            </div>"; 
                        }
                    }else if(($str != "*") &&($strlast!= "*") &&($strmid!= "*")){

                        $product = Product::where('number','like','%'.$key.'%')
                        ->where('catid',$cat) 
                        /*->where('styleid',$id)*/
                        ->where('stateid',1)
                        ->orderBy('id','desc')
                        ->get();
                        foreach ($product as $row) {
                            echo "<div class='kiu row' style='margin-left: 0px;margin-right: -10px;'>
                            <div class='searchable-container'>
                            <div class='itemss'>
                            <div class='ku col-md-3 col-sm-5 col-xs-5' style='color:#2898e0;padding-left:0px;'><strong>".$row->number."</strong></div>
                            <div class='ku col-md-3 col-xs-3 text-center' style='color:#d2021b;'><strong>".number_format($row->price)."</strong><sup>đ</sup></div>

                            <div class='ku col-md-3 col-sm-2 col-xs-2 text-center'>";
                            foreach($nm as $nmm){
                                if($nmm->id == $row->nhamang)
                                    {echo $nmm->name;}
                            }
                            echo "</div>
                            <div class='ku col-md-3 col-sm-2 col-xs-2 text-center' style='color:#2898e0;'><a href='".url('mua-hang/'.$row->id)."' style='padding: 0px 46% 0px 46%; '><strong>MUA</strong></a></div>
                            </div>
                            </div>
                            </div>"; 
                        }
                    }
                }
            }


            public function proajaxsearchprice(){
                $price = $_GET['price']; 
                $cat = $_GET['cat'];
                $keysearch = $_GET['key'];

                $nm = Nhamang::where('stateid',1)->get();
                $str = substr($keysearch,0,1); //LẤY 1 KÝ TỰ ĐẦU ( Ở ĐÂY LÀ *)
                $strlast =substr($keysearch,-1,1); //LẤY 1 KÝ TỰ CUỐI CÙNG (Ở ĐÂY LÀ*)
                $strmid =substr($keysearch,3,1); //LẤY 1 KÝ TỰ THỨ 3 (Ở ĐÂY LÀ *)
                
                if($price!=0){
                    if($str == "*"){ /*NẾU KÝ TỰ ĐẦU BẰNG * */
                        $num = str_replace("*","",$keysearch);
                        $product = Product::where('number','like','%'.$num)
                        ->where('catid',$cat)
                        ->where('price',$price) 
                        /*->where('styleid',$id)*/
                        ->where('stateid',1)
                        ->orderBy('id','desc')
                        ->get();
                        foreach ($product as $row) {
                            echo "<div class='kiu row' style='margin-left: 0px;margin-right: -10px;'>
                            <div class='searchable-container'>
                            <div class='itemss'>
                            <div class='ku col-md-3 col-sm-5 col-xs-5' style='color:#2898e0;padding-left:0px;'><strong>".$row->number."</strong></div>
                            <div class='ku col-md-3 col-xs-3 text-center' style='color:#d2021b;'><strong>".number_format($row->price)."</strong><sup>đ</sup></div>

                            <div class='ku col-md-3 col-sm-2 col-xs-2 text-center'>";
                            foreach($nm as $nmm){
                                if($nmm->id == $row->nhamang)
                                    {echo $nmm->name;}
                            }
                            echo "</div>
                            <div class='ku col-md-3 col-sm-2 col-xs-2 text-center' style='color:#2898e0;'><a href='".url('mua-hang/'.$row->id)."' style='padding: 0px 46% 0px 46%; '><strong>MUA</strong></a></div>
                            </div>
                            </div>
                            </div>";
                        }
                    }else if($strlast == "*"){
                        $num = str_replace("*","",$keysearch);
                        $product = Product::where('number','like',$num.'%')
                        ->where('catid',$cat) 
                        ->where('price',$price)
                        /*->where('styleid',$id)*/
                        ->where('stateid',1)
                        ->orderBy('id','desc')
                        ->get();
                        foreach ($product as $row) {
                            echo "<div class='kiu row' style='margin-left: 0px;margin-right: -10px;'>
                            <div class='searchable-container'>
                            <div class='itemss'>
                            <div class='ku col-md-3 col-sm-5 col-xs-5' style='color:#2898e0;padding-left:0px;'><strong>".$row->number."</strong></div>
                            <div class='ku col-md-3 col-xs-3 text-center' style='color:#d2021b;'><strong>".number_format($row->price)."</strong><sup>đ</sup></div>

                            <div class='ku col-md-3 col-sm-2 col-xs-2 text-center'>";
                            foreach($nm as $nmm){
                                if($nmm->id == $row->nhamang)
                                    {echo $nmm->name;}
                            }
                            echo "</div>
                            <div class='ku col-md-3 col-sm-2 col-xs-2 text-center' style='color:#2898e0;'><a href='".url('mua-hang/'.$row->id)."' style='padding: 0px 46% 0px 46%; '><strong>MUA</strong></a></div>
                            </div>
                            </div>
                            </div>";
                        }
                    }else if($strmid == "*"){
                        $mid =explode("*",$keysearch);
                        $first = $mid[0];
                        $last = $mid[1];
                        $product = Product::where('number','like',$first.'%'.$last)
                        ->where('catid',$cat) 
                        ->where('price',$price)
                        /*->where('styleid',$id)*/
                        ->where('stateid',1)
                        ->orderBy('id','desc')
                        ->get();
                        foreach ($product as $row) {
                            echo "<div class='kiu row' style='margin-left: 0px;margin-right: -10px;'>
                            <div class='searchable-container'>
                            <div class='itemss'>
                            <div class='ku col-md-3 col-sm-5 col-xs-5' style='color:#2898e0;padding-left:0px;'><strong>".$row->number."</strong></div>
                            <div class='ku col-md-3 col-xs-3 text-center' style='color:#d2021b;'><strong>".number_format($row->price)."</strong><sup>đ</sup></div>

                            <div class='ku col-md-3 col-sm-2 col-xs-2 text-center'>";
                            foreach($nm as $nmm){
                                if($nmm->id == $row->nhamang)
                                    {echo $nmm->name;}
                            }
                            echo "</div>
                            <div class='ku col-md-3 col-sm-2 col-xs-2 text-center' style='color:#2898e0;'><a href='".url('mua-hang/'.$row->id)."' style='padding: 0px 46% 0px 46%; '><strong>MUA</strong></a></div>
                            </div>
                            </div>
                            </div>"; }
                        }else if(($str != "*") &&($strlast!= "*") &&($strmid!= "*")){

                            $product = Product::where('number','like','%'.$keysearch.'%')
                            ->where('catid',$cat) 
                            ->where('price',$price)
                            ->where('stateid',1)
                            ->orderBy('id','desc')
                            ->get();
                            foreach ($product as $row) {
                                echo "<div class='kiu row' style='margin-left: 0px;margin-right: -10px;'>
                                <div class='searchable-container'>
                                <div class='itemss'>
                                <div class='ku col-md-3 col-sm-5 col-xs-5' style='color:#2898e0;padding-left:0px;'><strong>".$row->number."</strong></div>
                                <div class='ku col-md-3 col-xs-3 text-center' style='color:#d2021b;'><strong>".number_format($row->price)."</strong><sup>đ</sup></div>

                                <div class='ku col-md-3 col-sm-2 col-xs-2 text-center'>";
                                foreach($nm as $nmm){
                                    if($nmm->id == $row->nhamang)
                                        {echo $nmm->name;}
                                }
                                echo "</div>
                                <div class='ku col-md-3 col-sm-2 col-xs-2 text-center' style='color:#2898e0;'><a href='".url('mua-hang/'.$row->id)."' style='padding: 0px 46% 0px 46%; '><strong>MUA</strong></a></div>
                                </div>
                                </div>
                                </div>"; 
                            }
                        }}
                else if($price==0){ // XUẤT HẾT TẤT CẢ THEO KEYSEARCH
                    if($str == "*"){ /*NẾU KÝ TỰ ĐẦU BẰNG * */
                        $num = str_replace("*","",$keysearch);
                        $product = Product::where('number','like','%'.$num)
                        ->where('catid',$cat)
                        /*->where('styleid',$id)*/
                        ->where('stateid',1)
                        ->orderBy('id','desc')
                        ->get();
                        foreach ($product as $row) {
                            echo "<div class='kiu row' style='margin-left: 0px;margin-right: -10px;'>
                            <div class='searchable-container'>
                            <div class='itemss'>
                            <div class='ku col-md-3 col-sm-5 col-xs-5' style='color:#2898e0;padding-left:0px;'><strong>".$row->number."</strong></div>
                            <div class='ku col-md-3 col-xs-3 text-center' style='color:#d2021b;'><strong>".number_format($row->price)."</strong><sup>đ</sup></div>

                            <div class='ku col-md-3 col-sm-2 col-xs-2 text-center'>";
                            foreach($nm as $nmm){
                                if($nmm->id == $row->nhamang)
                                    {echo $nmm->name;}
                            }
                            echo "</div>
                            <div class='ku col-md-3 col-sm-2 col-xs-2 text-center' style='color:#2898e0;'><a href='".url('mua-hang/'.$row->id)."' style='padding: 0px 46% 0px 46%; '><strong>MUA</strong></a></div>
                            </div>
                            </div>
                            </div>";
                        }
                    }else if($strlast == "*"){
                        $num = str_replace("*","",$keysearch);
                        $product = Product::where('number','like',$num.'%')
                        ->where('catid',$cat) 
                        /*->where('styleid',$id)*/
                        ->where('stateid',1)
                        ->orderBy('id','desc')
                        ->get();
                        foreach ($product as $row) {
                            echo "<div class='kiu row' style='margin-left: 0px;margin-right: -10px;'>
                            <div class='searchable-container'>
                            <div class='itemss'>
                            <div class='ku col-md-3 col-sm-5 col-xs-5' style='color:#2898e0;padding-left:0px;'><strong>".$row->number."</strong></div>
                            <div class='ku col-md-3 col-xs-3 text-center' style='color:#d2021b;'><strong>".number_format($row->price)."</strong><sup>đ</sup></div>

                            <div class='ku col-md-3 col-sm-2 col-xs-2 text-center'>";
                            foreach($nm as $nmm){
                                if($nmm->id == $row->nhamang)
                                    {echo $nmm->name;}
                            }
                            echo "</div>
                            <div class='ku col-md-3 col-sm-2 col-xs-2 text-center' style='color:#2898e0;'><a href='".url('mua-hang/'.$row->id)."' style='padding: 0px 46% 0px 46%; '><strong>MUA</strong></a></div>
                            </div>
                            </div>
                            </div>";
                        }
                    }else if($strmid == "*"){
                        $mid =explode("*",$keysearch);
                        $first = $mid[0];
                        $last = $mid[1];
                        $product = Product::where('number','like',$first.'%'.$last)
                        ->where('catid',$cat) 
                        /*->where('styleid',$id)*/
                        ->where('stateid',1)
                        ->orderBy('id','desc')
                        ->get();
                        foreach ($product as $row) {
                            echo "<div class='kiu row' style='margin-left: 0px;margin-right: -10px;'>
                            <div class='searchable-container'>
                            <div class='itemss'>
                            <div class='ku col-md-3 col-sm-5 col-xs-5' style='color:#2898e0;padding-left:0px;'><strong>".$row->number."</strong></div>
                            <div class='ku col-md-3 col-xs-3 text-center' style='color:#d2021b;'><strong>".number_format($row->price)."</strong><sup>đ</sup></div>

                            <div class='ku col-md-3 col-sm-2 col-xs-2 text-center'>";
                            foreach($nm as $nmm){
                                if($nmm->id == $row->nhamang)
                                    {echo $nmm->name;}
                                
                            }
                            echo "</div>
                            <div class='ku col-md-3 col-sm-2 col-xs-2 text-center' style='color:#2898e0;'><a href='".url('mua-hang/'.$row->id)."' style='padding: 0px 46% 0px 46%; '><strong>MUA</strong></a></div>
                            </div>
                            </div>
                            </div>"; 
                        }
                    }else if(($str != "*") &&($strlast!= "*") &&($strmid!= "*")){
                        $product = Product::where('number','like','%'.$keysearch.'%')
                        ->where('catid',$cat) 
                        /*->where('styleid',$id)*/
                        ->where('stateid',1)
                        ->orderBy('id','desc')
                        ->get();
                        foreach ($product as $row) {
                            echo "<div class='kiu row' style='margin-left: 0px;margin-right: -10px;'>
                            <div class='searchable-container'>
                            <div class='itemss'>
                            <div class='ku col-md-3 col-sm-5 col-xs-5' style='color:#2898e0;padding-left:0px;'><strong>".$row->number."</strong></div>
                            <div class='ku col-md-3 col-xs-3 text-center' style='color:#d2021b;'><strong>".number_format($row->price)."</strong><sup>đ</sup></div>

                            <div class='ku col-md-3 col-sm-2 col-xs-2 text-center'>";
                            foreach($nm as $nmm){
                                if($nmm->id == $row->nhamang)
                                    {echo $nmm->name;}
                            }
                            
                            echo "</div>
                            <div class='ku col-md-3 col-sm-2 col-xs-2 text-center' style='color:#2898e0;'><a href='".url('mua-hang/'.$row->id)."' style='padding: 0px 46% 0px 46%; '><strong>MUA</strong></a></div>
                            </div>
                            </div>
                            </div>"; 
                        }
                    }
                }

            }
        }
