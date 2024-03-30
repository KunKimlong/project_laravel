<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index(){
        $NewProduct = DB::table('products')->orderByDesc('id')->limit(4)->get();
        $Promotion  = DB::table('products')->where('discount','>',0)->orderByDesc('id')->limit(4)->get();
        $Popular    = DB::table('products')->orderByDesc('viewer')->limit(4)->get();
        return view('Frontend.home',compact('NewProduct','Promotion','Popular'));
    }
    public function productDetail($id){

        $product = DB::table('products')->where('id',$id)->first();
        DB::table('products')->where('id',$id)->update([
            'viewer'=>$product->viewer+1,
        ]);
        $related = DB::table('products')
                    ->where('category_id',$product->category_id)
                    ->where('id','!=',$product->id)
                    ->limit(4)->get();
        // return $related;
        return view('FrontEnd.productDetail',compact('product','related'));
    }
    public function search(Request $request){
        $rsSearch = $request->rsSearch;

        $product = DB::table('products')->where('name','LIKE','%'.$rsSearch.'%')->get();
        $news    = DB::table('news')->where('title','LIKE','%'.$rsSearch.'%')->get();

        return view('FrontEnd.search',compact('product','news'));
    }
}
