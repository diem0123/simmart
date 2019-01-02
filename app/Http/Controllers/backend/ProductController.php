<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\State;
use App\Models\Nhamang;
use App\Models\Simstyle;
use App\Models\Ship;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Input;
use Validator;
use DB;
use Session;


class ProductController extends Controller
{
    public function index(){
    	$data = Product::orderBy('id','desc')->get();
    	$dataa = Product::where('stateid',1)->get();
    	$cate = Category::all();
    	$count = count($data);
    	$count1 = count($dataa);
    	$state = State::all();
    	$nm = Nhamang::all();
      return view('admin.product.index',
         [
            'data'=>$data,
            'cate'=>$cate,
            'state'=>$state,
            'count'=>$count,
            'count1'=>$count1,
            'nm'=>$nm
        ]);
  }
  public function import_excel(Request $request){
    $nhamang = Nhamang::all();
    $loaikhuyenmai = Category::all();
    $loaisim = Simstyle::all();

    $rules =[
        'file'=>'required',
    ];
    $messages =[
        'file.required'=>'File Import không hợp lệ',

    ];
    $validator = Validator::make($request->all(), $rules, $messages);
    if ($validator->fails()){
        return redirect('admin/product')->withErrors($validator)->withInput();
    }else{
        if(Input::hasFile('file')){
            $path = Input::file('file')->getRealPath();
            $data = Excel::load($path, function($reader){})->get()->toArray();

            foreach ($data[0] as $key => $value){
                if($value['loaikhuyenmai']!=null){
                    $catid = null;
                    $styleid = null;
                    $nm = null;
                    if(isset($value['loaikhuyenmai'])){
                       foreach ($loaikhuyenmai as $value1) {
                        if($value1->name==$value['loaikhuyenmai']){
                            $catid = $value1->id;
                            break;
                        }
                    } 
                }
                if(isset($value['loaisim'])){
                    foreach ($loaisim as $value2) {
                        if($value2->name==$value['loaisim']){
                            $styleid = $value2->id;
                            break;
                        }
                    }
                }

                if(isset($value['nhamang'])){
                    foreach ($nhamang as $value3) {
                     if($value3->name==$value['nhamang']){
                        $nm = $value3->id;
                        break;
                    }
                }
            }
            $items[] = [
                'nhamang'=>$nm,
                'styleid' =>$styleid,
                'number'=>'0'.$value['so'],
                'price' =>$value['gia'],
                'stateid'=>1,
                'catid'=>$catid,
                'created_by'=>Session::get('login')->id,
                'updated_by'=>Session::get('login')->id,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
        }


    }
    if(!empty($items)){
        DB::table('db_product')->insert($items);
    }
}
return redirect()->back()->with('message','Import thành công');
}
}


public function shipping(){
    $data = Product::orderBy('id','desc')->where('stateid',5)->get();
    $cate = Category::all();
    $count = count($data);
    $state = State::all();
    $nm = Nhamang::all();
    return view('admin.product.shipping',
     [
        'data'=>$data,
        'cate'=>$cate,
        'state'=>$state,
        'count'=>$count,
        'nm'=>$nm
    ]);
}
public function trash(){
    $data = Product::orderBy('id','desc')->where('stateid',2)->get();
    $cate = Category::all();
    $count = count($data);
    $state = State::all();
    $nm = Nhamang::all();
    return view('admin.product.trash',
     [
        'data'=>$data,
        'cate'=>$cate,
        'state'=>$state,
        'count'=>$count,
        'nm'=>$nm
    ]);
}
public function state($id){
    $items = Product::find($id);
    $ik = ($items->stateid==1)?2:1;
    $items->stateid = $ik;
    $items->save();
    return redirect()->route('getproduct');
}
public function delete($id){
    $items = Product::find($id);
    $items->delete();
    return redirect()->route('getproduct');
}

public function getinsert(){
    $nm = Nhamang::all();
    $cat = Category::where('stateid',1)->get();
    $style = Simstyle::all();
    $state = State::where('id','<',3)->get();
    return view('admin.product.insert',['nm'=>$nm,'cat'=>$cat,'style'=>$style,'state'=>$state]);
}

public function postinsert(Request $request){
    $rules =['number'=>'unique:db_product',];
    $messages =['number.unique' => 'Số sim đã tồn tại',];
    $validator = Validator::make($request->all(), $rules, $messages);
    if ($validator->fails()) {
        return redirect('admin/product/insert')->withErrors($validator)->withInput();
    }else{
        $items = new Product;
        $items->number = $request->number;
        $items->price = $request->price;
        $items->catid = $request->catid;
        $items->styleid = $request->styleid;
        $items->nhamang = $request->nhamang;
        $items->stateid = $request->stateid;
        $items->created_by =Session::get('login')->id;
        $items->created_at =date('Y-m-d H:i:s');
        $items->updated_by =Session::get('login')->id;
        $items->updated_at =date('Y-m-d H:i:s');
        $items->save();
        return redirect()->route('getproduct')->with('message','Thêm thành công');
    }
}

public function getupdate($id){
    $row = Product::find($id);

    $nm = Nhamang::all();
    $cat = Category::where('stateid',1)->get();
    $style = Simstyle::all();
    $state = State::where('id','<',3)->get();
    return view('admin.product.update',['nm'=>$nm,'cat'=>$cat,'style'=>$style,'state'=>$state,'row'=>$row]);
}

public function postupdate(Request $request, $id){
    $items = Product::find($id);
    $reqnumber = $request->number;
    $dtnumber = $items->number;
    if($reqnumber == $dtnumber){
        $items->price = $request->price;
        $items->catid = $request->catid;
        $items->styleid = $request->styleid;
        $items->nhamang = $request->nhamang;
        $items->stateid = $request->stateid;
        $items->created_by =Session::get('login')->id;
        $items->created_at =date('Y-m-d H:i:s');
        $items->updated_by =Session::get('login')->id;
        $items->updated_at =date('Y-m-d H:i:s');
        $items->save();
        return redirect()->route('getproduct')->with('message','Sửa thành công');
    }else{
        $rules =['number'=>'unique:db_product',];
        $messages =['number.unique' => 'Số sim đã tồn tại',];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect('admin/product/update/'.$items->id)->withErrors($validator)->withInput();
        }else{
            $items->number = $request->number;
            $items->price = $request->price;
            $items->catid = $request->catid;
            $items->styleid = $request->styleid;
            $items->nhamang = $request->nhamang;
            $items->stateid = $request->stateid;
            $items->created_by = Session::get('login')->id;
            $items->created_at = date('Y-m-d H:i:s');
            $items->updated_by = Session::get('login')->id;
            $items->updated_at = date('Y-m-d H:i:s');
            $items->save();
            return redirect()->route('getproduct')->with('message','Sửa thành công');
        }
    }

}
public function deleteall(){
    $data = Product::all();
    foreach ($data as $key){
        $id = Product::find($key->id);
        if($id->id!=0){
            $id->delete();
        }
    }
    return redirect()->route('getproduct')->with('message','Xóa tất cả thành công');

}
public function deleteallship(){
    $data = Product::all();
    foreach ($data as $key){
        $id = Product::find($key->id);
        if($id->stateid==5){
            $id->delete();
        }
    }
    return redirect()->route('getshippingproduct')->with('message','Xóa tất cả thành công');

}

}
