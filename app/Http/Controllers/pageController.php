<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Title;
use App\Models\Category;
use App\Models\Logo;
class pageController extends Controller
{
    public function getIndex (){
        $logo = Logo::where('id',1)->first();
        $title = Title::where('stateid',1)->get();
        return view('page.trangchu',['title'=>$title,'logo'=>$logo]);
    }
    public function getdetail($slug){
        $row = Category::where('slug',$slug)->first();
        if(count($row)){
            return view('page.detail',['row'=>$row]);
        }else{
            return redirect()->route('trangchu');
        }
        
    }
    public function ketquatimkiem(Request $request){
        if($request->keyword==null)
            return redirect()->back()->with('message','Bạn chưa nhập từ khóa');
        else{
            $keyword = $request->keyword;
            $logo = Logo::where('id',1)->first();
            $cat = Category::where('name','like','%'.$request->keyword.'%')
            ->orwhere('price',$request->keyword)
            ->get();
            $cou = count($cat);
            return view('page.ketquatimkiem',compact('cat'),['keyword'=>$keyword,'cou'=>$cou,'logo'=>$logo]);
        }
    }
}
