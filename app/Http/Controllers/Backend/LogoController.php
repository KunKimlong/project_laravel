<?php

namespace App\Http\Controllers\Backend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LogoController extends Controller
{
    public function openAdd(){
        
        return view('Backend.addLogo');
    }
    public function addLogo(Request $request){
        $user = Auth::user();
        $thumbnail = $request->thumbnail;

        if($thumbnail){
            $newthumbnail = date('d-m-y-h-i-s').'_'.$thumbnail->getClientOriginalName();
            $path = 'Image';
            $thumbnail->move($path,$newthumbnail);
            DB::table('website_logo')->insert([
                        'thumbnail'=>$newthumbnail,
                        'user_id'=>$user->id,
                        'created_at'=>date('y-m-d h-i-s'),
                        'updated_at'=>date('y-m-d h-i-s')
            ]);
            return redirect('/admin/add-logo')->with('success','');
        }
        else{
            return redirect('/admin/add-logo')->with('unsuccess','');
        }

        
    }
    public function viewLogo(){
        $data = DB::table("website_logo")
                ->select('website_logo.*','users.name')
                ->join('users','website_logo.user_id','=','users.id')
                ->orderByDesc('id')->get();
        // return $data;
        return view('Backend.list-logo',compact('data'));
    }
    public function openUpdate($id){
        // return $id;
        $data = DB::table('website_logo')->where('id',$id)->first();
        return view('Backend.update-logo',compact('data'));
    }
    public function UpdateLogo(Request $request){
        $update_id = $request->update_id;
        $thumbnail = $request->thumbnail;
        if($thumbnail){
            $newthumbnail = date('d-m-y-h-i-s').'_'.$thumbnail->getClientOriginalName();
            $path = 'Image';
            $thumbnail->move($path,$newthumbnail);
            DB::table('website_logo')->where("id",$update_id)->update([
                        'thumbnail'=>$newthumbnail,
                        'updated_at'=>date('y-m-d h-i-s')
            ]);
            
            return redirect('/admin/list-logo')->with('success','');
        }
        else{
            return redirect('/admin/update-logo/'.$update_id)->with('unsuccess','');
        }
    }
    public function DeleteLogo(Request $request){
        $remove_id = $request->remove_id;
        $check = DB::table('website_logo')->where('id',$remove_id)->delete();
        return redirect('/admin/list-logo')->with('deletesuccess','');
    }
}
