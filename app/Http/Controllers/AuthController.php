<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index(){
        return view('login'); 
    }

    public function index2(){
        return view('signup'); 
    }

    public function login(Request $request){
        $data = $request->only('email','password');
        if(Auth::attempt($data)){
            return redirect('/dashboard');
        }
        return back();
    }

    public function logout(Request $request){
       Auth::logout(); 
       $request->session()->invalidate();
       return redirect('/login');
    }

    public function signup(Request $request){
        User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=> $request->password,
        ]);
        return redirect('/login');
    }
}
