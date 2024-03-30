<?php

namespace App\Http\Controllers\Backend;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\Auth;
class ProductController extends Controller
{
    
    public function viewProduct(){
        
        $data = Product::select('products.*','category.name as cateName','users.name as userName')
                ->join('category','products.category_id','=','category.id')
                ->join('users','products.user_id','=','users.id')
                ->orderByDesc('id')
                ->get();

        $total = Product::count('id');

        // return $data;
        return view('Backend.list-product',compact('data','total'));
    }
    public function openAdd(){
        $category = DB::table("category")->get();
        // return $category;
        return view('Backend.addProduct',compact('category'));
    }
    public function addProduct(Request $request){
        $name  = $request->name;
        $qty   = $request->qty;
        $regular_price = $request->regular_price;
        $discount = $request->discount;
        $size   = $request->size;
        $color  = $request->color;
        $category = $request->category;
        $description = $request->description;
        $thumbnail = $request->thumbnail; 
       
        $strSize = '';
        $strColor = ''; 
        if($color){
            $strColor = implode(',',$color);
        }
        if($size){
            $strSize = implode(',',$size);
        }
        
        if($thumbnail){
            $newthumbnail = date('d-m-y-h-i-s').'_'.$thumbnail->getClientOriginalName();
            $path = 'Image';
            $thumbnail->move($path,$newthumbnail);
        }


        $sale_price = $regular_price - ($regular_price*$discount)/100;
        $user_id    = Auth::user()->id; 

        try{
            Product::create([
                'name'=>$name,
                'description'=>$description,
                'color'=>$strColor,
                'size'=>$strSize,
                'regular_price'=>$regular_price,
                'discount'=>$discount,
                'thumbnail'=>$newthumbnail,
                'stock_qty'=>$qty,
                'sale_price'=>$sale_price,
                'user_id'=>$user_id,
                'category_id'=>$category,
            ]);

            return redirect('/admin/add-product')->with('success','');
        }catch(Exception $e){
            return redirect('/admin/add-product')->with('unsuccess','');
        }

    }

    public function openUpdate($id){
        $category = DB::table("category")->get();
        $data = Product::select('*')->where('id',$id)->first();
        return view('Backend.update-product',compact('category','data'));
    }

    public function updateProduct(Request $request){
        $update_id = $request->update_id;
        $name  = $request->name;
        $qty   = $request->qty;
        $regular_price = $request->regular_price;
        $discount = $request->discount;
        $size   = $request->size;
        $color  = $request->color;
        $category = $request->category;
        $description = $request->description;
        $thumbnail = $request->thumbnail; 
       
        $strSize = '';
        $strColor = ''; 
        if($color){
            $strColor = implode(',',$color);
        }
        if($size){
            $strSize = implode(',',$size);
        }
        
        if($thumbnail){
            $newthumbnail = date('d-m-y-h-i-s').'_'.$thumbnail->getClientOriginalName();
            $path = 'Image';
            $thumbnail->move($path,$newthumbnail);
        }
        else{
            $newthumbnail = $request->old_thumbnail;
        }

        $sale_price = $regular_price - ($regular_price*$discount)/100;


        try{
            Product::where('id',$update_id)->update([
                'name'=>$name,
                'description'=>$description,
                'color'=>$strColor,
                'size'=>$strSize,
                'regular_price'=>$regular_price,
                'discount'=>$discount,
                'thumbnail'=>$newthumbnail,
                'stock_qty'=>$qty,
                'sale_price'=>$sale_price,
                'category_id'=>$category,
            ]);
            return redirect('/admin/list-product')->with('success','');
        }catch(Exception $e){
            return redirect('/admin/update-product')->with('un  success','');
        }
    }

    public function deleteProduct(Request $request){
        $remove_id = $request->remove_id;
        Product::where('id',$remove_id)->delete();
        return redirect('/admin/list-product')->with('deletesuccess','');
    }

}


