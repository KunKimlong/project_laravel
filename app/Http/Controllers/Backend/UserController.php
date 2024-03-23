<?php

namespace App\Http\Controllers\Backend;

use Exception;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function openRegister(){
        return view('Backend.register');
    }
    public function register(Request $request){
        $username = $request->input('name');
        $email    = $request->email;
        $password = Hash::make($request->password);
        $profile  = $request->profile;
        
        if($profile){
            $newProfile = date('dmyhis').'-'.$profile->getClientOriginalName();
            $path = 'Image';
            $profile->move($path,$newProfile);
        }

        try{
            DB::table('users')->insert([
                                'name'=>$username,
                                'email'=>$email,
                                'password'=>$password,
                                'thumbnail'=>$newProfile,
                            ]);
                                return redirect('/login');
            
        }catch(Exception $e){
            return redirect('/register')->with('unsuccess',$e->getMessage());
        }
    }
    public function openLogin(){
        return view("Backend.login");        
    }
    public function login(Request $request){
        // return Auth::user();
        if(Auth::attempt(
            [
                'name'=>$request->name_email,
                'password'=>$request->password
            ]
            )){
                return redirect('/admin');
        }
        else if(Auth::attempt(
            [
                'email'=>$request->name_email,
                'password'=>$request->password
            ]
            )){
                return redirect('/');
        }
        else {
            return redirect('/login')->with('unsuccess','');
        }
    }
    public function logout(){

    }
}
