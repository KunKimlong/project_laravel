<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ShopController extends Controller
{
    public function index(Request $request){

        $page = $request->page;
        $cate_id = $request->cat;
        $price = $request->price;
        $promotion = $request->promotion;

        $rsProduct  = ($page-1)*6;

        if(!empty($cate_id)){
            $total      = DB::table('products')->where('category_id',$cate_id)->count();
            $total_page = ceil($total/6);

            $product = DB::table('products')
                    ->where('category_id',$cate_id)
                    ->orderByDesc('id')
                    ->offset($rsProduct)
                    ->limit(6)->get();
        }
        else if($price == "min"){
            $total      = DB::table('products')->count();
            $total_page = ceil($total/6);

            $product = DB::table('products')
                    ->orderBy('sale_price')
                    ->offset($rsProduct)
                    ->limit(6)->get();
        }
        else if($price == "max"){
            $total      = DB::table('products')->count();
            $total_page = ceil($total/6);

            $product = DB::table('products')
                    ->orderBy('sale_price','DESC')
                    ->offset($rsProduct)
                    ->limit(6)->get();
        }
        else if($promotion == "true"){
            $total      = DB::table('products')->where('discount','>',0)->count();
            $total_page = ceil($total/6);

            $product = DB::table('products')
                    ->where('discount','>',0)
                    ->orderBy('id','DESC')
                    ->offset($rsProduct)
                    ->limit(6)->get();
        }
        else{
            $total      = DB::table('products')->count();
            $total_page = ceil($total/6);
            $product = DB::table('products')
                    ->orderByDesc('id')
                    ->offset($rsProduct)
                    ->limit(6)->get();  
        }

        $category = DB::table("category")->get();
        
        return view('FrontEnd.shop',compact('product','cate_id','promotion','price','total_page','category'));
    }
}
