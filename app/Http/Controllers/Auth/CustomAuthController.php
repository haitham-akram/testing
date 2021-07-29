<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
class CustomAuthController extends Controller
{
    public function adult(){
        return view('customAuth.index');
    }
    public function notadult(){
        return view('customAuth.ErrorMessage');
    }
    public function admin(){
        return view('multi_guards.admin');
    }
    public function site(){
        return view('multi_guards.site');
    }
    public function login(){
        return view('auth.admin_login');
    }
    public function checklogin(Request $request){
        $this->validate($request,[
            'email'=>'required|email',
            'password'=>'required|min:8'
        ] );
        if (Auth::guard('admin')->attempt(['email'=>$request->email,'password'=>$request->password])){
        return redirect()->intended('/custom/admin');}
        return back()->withInput($request->only('email'));
    }


}
