<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\State;
use App\Models\Title;
use Validator;
use DB;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Facades\Excel;
use Session;

class CategoryController extends Controller
{
    public function index(){
        $data = Category::orderBy('id','desc')->get();
        $title = Title::all();
        $state = State::where('id','<',3)->get();
        return view('admin.category.index',['data'=>$data,'state'=>$state,'title'=>$title]);
    }
    public function getinsert(){
        $state = State::where('id','<',3)->get();
        $title = Title::all();
        return view('admin.category.insert',['state'=>$state,'title'=>$title]);
    }
    public function postinsert(Request $request){
        $items = new Category();
        $rules =[
            'name'=>'unique:db_category',
        ];
        $messages =['name.unique' => 'Tên gói đã tồn tại',];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()){
            return redirect('admin/category/insert')->withErrors($validator)->withInput();
        }else {
            $items->name = $request->name;
            $items->titid = $request->title;
            if($request->slug != null){
                $items->slug = $request->slug;
            }else{
                $items->slug = str_slug($request->name);
            }

            $items->data = $request->data;
            $items->datadetail = $request->datadetail;
            $items->salesmsin = $request->salesmsin;
            $items->salesmsout = $request->salesmsout;
            $items->salecallin = $request->salecallin;
            $items->salecallout = $request->salecallout;
            $items->minutecall = $request->minutecall;
            $items->saletime = $request->saletim;
            $items->parentid = 0;
            $items->cycle = $request->cycle;
            $items->cuphap = $request->cuphap;
            $items->price = $request->price;
            $items->price_sale = $request->price_sale;
            $items->title1 = $request->title1;
            $items->title2 = $request->title2;
            $items->saleother = $request->saleother;
            $items->chuthich = $request->chuthich;
            $items->detail = $request->detail;
            $items->stateid = $request->stateid;
            $items->metadesc = $request->metadesc;
            $items->metakeyword = $request->metakeyword;
            $items->created_at = date('Y-m-d H:i:s');
            $items->updated_at = date('Y-m-d H:i:s');
            $items->created_by = 1;
            $items->updated_by = 1;

            if($request->hasFile('photo')) {


                $file = $request->file('photo')->getClientOriginalExtension();
                $name = str_slug($items->name).'-'.time().'.'.$file;
                $path = public_path('images');
                $request->file('photo')->move('images', $name);
            }
            else {
                $name = "";
            }
            if($request->hasFile('photores')) {
                $file = $request->file('photores')->getClientOriginalExtension();
                $nameres = str_slug($items->nameres).'-'.time().'.'.$file;
                $path = public_path('images');
                $request->file('photores')->move('images', $nameres);
            }
            else {
                $nameres = "";
            }
            $items->img = $name;
            $items->img_res = $nameres;
            $items->save();

        }
        return redirect()->route('getcategory')->with('message','Thêm thành công');
    }

    public function getupdate($id){
        $row = Category::find($id);
        $state = State::where('id','<',3)->get();
        $title = Title::all();
        return view('admin.category.update',['row'=>$row,'state'=>$state,'title'=>$title]);
    }
    public function postupdate(Request $request,$id){
        $items = Category::find($id);
        $items->name = $request->name;
        $items->titid = $request->title;
        if($request->slug != null){
            $items->slug = $request->slug;
        }else{
            $items->slug = str_slug($request->name);
        }
        $items->data = $request->data;
        $items->datadetail = $request->datadetail;
        $items->salesmsin = $request->salesmsin;
        $items->salesmsout = $request->salesmsout;
        $items->salecallin = $request->salecallin;
        $items->salecallout = $request->salecallout;
        $items->minutecall = $request->minutecall;
        $items->saletime = $request->saletim;
        $items->parentid = 0;
        $items->cycle = $request->cycle;
        $items->cuphap = $request->cuphap;
        $items->price = $request->price;
        $items->price_sale = $request->price_sale;
        $items->title1 = $request->title1;
        $items->title2 = $request->title2;
        $items->saleother = $request->saleother;
        $items->chuthich = $request->chuthich;
        $items->detail = $request->detail;
        $items->stateid = $request->stateid;
        $items->metadesc = $request->metadesc;
        $items->metakeyword = $request->metakeyword;
        $items->stateid = $request->stateid;
        $items->created_at = date('Y-m-d H:i:s');
        $items->updated_at = date('Y-m-d H:i:s');
        $items->created_by = 1;
        $items->updated_by = 1;
        if($request->hasFile('photo')) {
            if(($items->img)==""){
                unlink('images/'.$items->img);
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
            $name = $items->img;
        }
        if($request->hasFile('photores')) {
            if(($items->img_res)==""){
               unlink('images/'.$items->img_res);
               $file = $request->file('photores')->getClientOriginalExtension();
               $nameres = str_slug($items->nameres).'-'.time().'.'.$file;
               $path = public_path('images');
               $request->file('photores')->move('images', $nameres);
           }else{
            $file = $request->file('photores')->getClientOriginalExtension();
            $nameres = str_slug($items->nameres).'-'.time().'.'.$file;
            $path = public_path('images');
            $request->file('photores')->move('images', $nameres);
        }
        
    }
    else {
        $nameres = $items->img_res;
    }
    $items->img = $name;
    $items->img_res = $nameres;
    $items->save();
    return redirect()->route('getcategory')->with('message','Cập nhật '.$items->name.' thành công');
}
public function delete($id){
   $items = Category::find($id);
   $items->delete();
   return redirect()->route('getcategory');
}
public function deleteall(){
    $data = Category::all();
    foreach ($data as $key){
        $id = Category::find($key->id);
        if($id->id!=0){
            $id->delete();
        }
    }
    return redirect()->route('getcategory')->with('message','Xóa tất cả thành công');

}
public function import_excel(Request $request){
    $title = Title::all();
    $rules =['file'=>'required',];
    $messages =['file.required'=>'File Import không hợp lệ',];
    $validator = Validator::make($request->all(), $rules, $messages);
    if ($validator->fails()){
        return redirect('admin/product')->withErrors($validator)->withInput();
    }else{
        if(Input::hasFile('file')){
            $path = Input::file('file')->getRealPath();
            $data = Excel::load($path, function($reader){})->get()->toArray();

            foreach ($data[0] as $key => $value) {
                $titid = null;
                if(isset($value['thong_tin_goi_cuoc'])){
                   foreach ($title as $value1) {
                    if($value1->name==$value['thong_tin_goi_cuoc']){
                        $titid = $value1->id;
                        break;
                    }
                } 
            }/*else{
                return redirect()->back()->with('message','Định dạng File Import sai');
            }*/
            $price_sale = null;
            if(isset($value['giakm'])){
                $price_sale = $value['giakm'];
            }else{
                $price_sale = 0;
            }
            $slug = null;
            if(isset($value['ten_goi_cuoc'])){
                if(isset($value['link'])){
                    $slug = $value['link'];
                }else{
                    $slug = str_slug($value['ten_goi_cuoc']);
                }}
                $items[] = [
                    'titid'=>$titid,
                    'name'=>$value['ten_goi_cuoc'],
                    'price_sale' =>$price_sale,
                    'slug'=>$slug,
                    'data'=>$value['data'],
                    'datadetail'=>$value['chi_tiet_data'],
                    'salesmsin'=>$value['sms_noi_mang'],
                    'salesmsout'=>$value['sms_ngoai_mang'],
                    'salecallin'=>$value['phut_noi_mang'],
                    'salecallout'=>$value['phut_ngoai_mang'],
                    'minutecall'=>$value['phut_goi'],
                    'saletime'=>$value['thoi_gian_km'],
                    'cycle'=>$value['chu_ki'],
                    'phigoi'=>$value['phi_goi'],
                    'cuphap'=>$value['cu_phap'],
                    'price'=>$value['gia'],
                    'saleother'=>$value['km_khac'],
                    'chuthich'=>$value['chu_thich'],
                    'detail'=>$value['noi_dung_chi_tiet'],
                    'title1'=>$value['tieu_de_km_1'],
                    'title2'=>$value['tieu_de_km_2'],
                    'metadesc'=>$value['meta_desc'],
                    'metakeyword'=>$value['meta_keyword'],
                    'parentid'=>0,
                    'stateid'=>1,
                    'created_by'=>Session::get('login')->id,
                    'updated_by'=>Session::get('login')->id,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
            }
            print_r($items);
            if(!empty($items)){
                DB::table('db_category')->insert($items);
            }
        }
        return redirect()->back()->with('message','Import thành công');
    }
}
}
