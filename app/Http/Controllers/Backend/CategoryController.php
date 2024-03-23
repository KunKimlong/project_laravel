<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use LDAP\Result;

class CategoryController extends Controller
{
    public function VeiwCategory(){

        $data = DB::table("category")
                ->select('category.*','users.name AS username')
                ->join('users','category.user_id','=','users.id')
                ->orderBy("id",'DESC')->get();
        return view('Backend.list-category',compact('data'));
    }
    public function openAdd(){
        return view('Backend.addCategory');
    }
    public function AddCategory(Request $request){
        $category = $request->input('category');
        $user_id  = Auth::user()->id;
        // return $user_id;
        if($category){
            DB::table('category')->insert([
                'name'=>$category,
                'user_id'=>$user_id,
                'created_at'=>date('y-m-d h-i-s'),
                'updated_at'=>date('y-m-d h-i-s')
            ]);
    
            return redirect('/admin/add-category')->with('success','');
        }
        else{
            return redirect('/admin/add-category')->with('unsuccess','');
        }
    }
    public function openUpdate($id){
        // return $id;
        $data = DB::table('category')->select('*')->where('id',$id)->first();
        return view('Backend.update-category',compact('data'));
    }
    public function UpdateCategory(Request $request){
        $update_id = $request->update_id;
        $category  = $request->category;

        if($category){
            DB::table('category')->where('id',$update_id)->update([
                'name'=>$category,
                'updated_at'=>date('y-m-d h-i-s'),
            ]);
            return redirect('/admin/list-category')->with('success','');
        }
        else{
            return redirect('/admin/update-category/'.$update_id)->with('unsuccess','');
        }

    }
    public function DeleteCategory(Request $request){
        $id = $request->remove_id;
        DB::table("category")->where('id',$id)->delete();
        return redirect('/admin/list-category')->with('deletesuccess','');
    }
}
