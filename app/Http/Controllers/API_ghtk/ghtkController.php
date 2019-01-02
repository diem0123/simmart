<?php

namespace App\Http\Controllers\API_ghtk;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\api_ghtk_cau_hinh;
use App\api_order;
use App\api_kho_hang;
use App\Models\User;
use App\Models\Order;
use App\Models\Ship;
use App\Models\Product;
use Session;
use Symfony\Component\HttpFoundation\Cookie;
use DB;
use Validator;
use Mail;


class ghtkController extends Controller
{

    public function __construct(){
        /* ========== > AUTH < ========== */
        /*$value = Request()->cookie('trangthailogin');
        $trueOrFalse = (string)(substr($value,0,strpos($value,'|')));
        $id_login = trim(substr($value,strpos($value,'|')+1,strlen($value)));

        if ($trueOrFalse == 'true') {
            $data = DB::table('db_user')->where('id',$id_login)->first();
            Session::put('login', $data);
        }if ($trueOrFalse == 'false'){
            Session::forget('login');
            return redirect()->route('getlogin');
        }*/
        /* ========== > / AUTH < ========== */
    }


    public function cauhinhGet(){
        $data['cauhinh'] = api_ghtk_cau_hinh::firstOrCreate([
            'id' => 1,
        ],[
            'token' => '',
            'pick_name' => '',
            'pick_tel' => '',
            'pick_address' => '',
            'pick_province' => '',
            'pick_district' => ''
        ]);
        return view('API_ghtk.cauhinh',$data);
    }

    public function cauhinhPost(Request $req){
        $validation = Validator::make( $req->all(), 
            [
                'token'=>'required',
                'pick_name'=>'required',
                'pick_tel'=>'required',
                'pick_address'=>'required',
                'pick_province'=>'required',
                'pick_district'=>'required'
            ],
            [
                'token.required'=>'Bạn chưa nhập Token',
                'pick_name.required'=>'Bạn chưa nhập tên',
                'pick_tel.required'=>'Bạn chưa nhập số điện thoại',
                'pick_address.required'=>'Bạn chưa nhập địa chỉ',
                'pick_province.required'=>'Bạn chưa nhập Tỉnh/TP',
                'pick_district.required'=>'Bạn chưa nhập Quận/Huyện'
            ]
        );

        if ($validation->fails()) {
            return redirect()->back()
            ->withErrors($validation)
            ->withInput();
        } else {
            $add_or_update = api_ghtk_cau_hinh::updateOrCreate([
                'id' => 1,
            ],[
                'token' => $req->token,
                'pick_name' => $req->pick_name,
                'pick_tel' => $req->pick_tel,
                'pick_address' => $req->pick_address,
                'pick_province' => $req->pick_province,
                'pick_district' => $req->pick_district
            ]);
            return redirect()->back()->with('thong_bao','Bạn đã lưu dữ liệu thành công');
        }
    }


    public function trangthaiGet(){
        $cauhinh = api_ghtk_cau_hinh::firstOrCreate([
            'id' => 1,
        ],[
            'token' => '',
            'pick_name' => '',
            'pick_tel' => '',
            'pick_address' => '',
            'pick_province' => '',
            'pick_district' => ''
        ]);


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://services.giaohangtietkiem.vn/services/shipment",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_HTTPHEADER => array(
                "Token: " . $cauhinh->token,
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $data['obj'] = json_decode($response);
        return view('API_ghtk.trangthai',$data);
    }

    public function huydonhangGet(Request $req){
        $code = $req->code;
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://services.giaohangtietkiem.vn/services/shipment/cancel/".$code,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_HTTPHEADER => array(
                "Token: 2e6F18B676Db18ffEF95304ED8eae05e83e6086d",
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        echo $response;
    }

    public function tinhcuocvanchuyenGet(Request $req){
        $cauhinh = api_ghtk_cau_hinh::find(1);
        $pick_province = $cauhinh->pick_province;
        $pick_district = $cauhinh->pick_district;
        $weight = 1;

        $province = $req->province;
        $district = $req->district;
        $address = $req->address;

        $data = array(
            "pick_province" => $pick_province,
            "pick_district" => $pick_district,
            "province" => $province,
            "district" => $district,
            "address" => $address,
            "weight" => $weight,
        );
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://services.giaohangtietkiem.vn/services/shipment/fee?" . http_build_query($data),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_HTTPHEADER => array(
                "Token: ".$cauhinh->token,
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        echo $response;
    }

    public function taodonhangGet(Request $req){
        $kho_hang = api_kho_hang::find($req->id_kho_hang);
        $order = api_order::find($req->id_order);
        $pick_province = $kho_hang->tinh_thanh;
        $pick_district = $kho_hang->quan_huyen;
        $pick_name = $kho_hang->ten_chu_shop;
        $pick_address = $kho_hang->dia_chi;
        $pick_tel = $kho_hang->sdt_shop;

        $province = $order->tinh_tp;
        $district = $order->quan_huyen;
        $address = $order->dia_chi;
        $name = $order->ten_kh;
        $tel = $order->sdt_kh;
        $id = $order->so_sim;
        $pick_money = $order->tien_thu_ho;


        $order = <<<HTTP_BODY
        {
            "order": {
                "id": "$id",
                "pick_name": "$pick_name",
                "pick_address": "$pick_address",
                "pick_province": "$pick_province",
                "pick_district": "$pick_district",
                "pick_tel": "$pick_tel",
                "tel": "$tel",
                "name": "$name",
                "address": "$address",
                "province": "$province",
                "district": "$district",
                "is_freeship": "0",
                "pick_money": $pick_money
            }
        }
HTTP_BODY;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://services.giaohangtietkiem.vn/services/shipment/order",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $order,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Token: 2e6F18B676Db18ffEF95304ED8eae05e83e6086d",
                "Content-Length: " . strlen($order),
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        echo $response;
        $order = api_order::find($req->id_order);
        $add_or_update = api_order::updateOrCreate([
            'id' => $req->id_order,
        ],[
            'trang_thai' => 'Đã gửi',
        ]);
    }

    /* ========== > QUẢN LÝ FILE < ========== */
    public function file(){
        return view('API_ghtk.file');
    }
    /* ========== > / QUẢN LÝ FILE < ========== */

    /* =============== > Duyệt đơn hàng < =============== */
    public function duyetdonhangGet(){
        $data['data'] = api_order::all();
        $data['kho_hang'] = api_kho_hang::all();
        return view('API_ghtk.duyet_don_hang',$data);
    }
    /* =============== > / Duyệt đơn hàng < =============== */

    /* =============== > XÓA Duyệt đơn hàng < =============== */
    public function delduyetdonhangGet(Request $req){
        api_order::where('id', $req->id)->delete();
        return 'ok';
    }
    /* =============== > / XÓA Duyệt đơn hàng < =============== */

    /* ========== > Lưu đơn hàng < ========== */
    public function luudonhangGet(Request $req){
        $validation = Validator::make( $req->all(), 
            [
                'name'=>'required',
                'tel'=>'required',
                'province'=>'required',
                'district'=>'required',
                'address'=>'required',
                'id'=>'required',
                'pick_money'=>'required'
            ]
        );
        
        if ($validation->fails()) {
            return 'false';
        } else {
            $add = new api_order;
            $add->ten_kh = $req->name;
            $add->sdt_kh = $req->tel;
            $add->tinh_tp = $req->province;
            $add->quan_huyen = $req->district;
            $add->dia_chi = $req->address;
            $add->id_don_hang = $req->id;
            $add->tien_thu_ho = $req->pick_money;
            $add->so_sim = $req->so_sim;
            $add->phi_ship = $req->phi_ship;
            
            
            // Loi sua
            $add->save();
            $sim = $add->so_sim;
            $gia_sim = $req->gia_sim;
            Mail::send('order',['sim'=>$sim,'order'=>$add,'shipdate'=>$req->shipdate,'gioi_tinh'=>$req->gioi_tinh,'gia_sim'=>$gia_sim],function($msg) use ($sim){
            $msg->from('hethongsimsodep@gmail.com','Thông báo đặt hàng');
            $msg->to('hcuong994@gmail.com');
            $msg->subject('Đây là mail hệ thống');
            });
            //
            return 'ok';
        }
        /* ========== > / Lưu đơn hàng < ========== */

    }

}