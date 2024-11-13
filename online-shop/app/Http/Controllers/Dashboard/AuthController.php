<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(){
        if(Auth::check()){
            return redirect()->route('dashboard.index');
        }
        return view("back-end.login");
    }

    public function authenticate(Request $request){
        $validator = Validator::make($request->all(),[
            'email' => 'required',
            'password' => 'required',
        ]);

        if($validator->passes()){
            $credentials = $request->only('email' , 'password');
            if(Auth::attempt($credentials)){
                if(Auth::user()->role == 1){
                    return redirect()->route('dashboard.index');
                }
                elseif(Auth::user()->role == 0){
                    return redirect()->route('category.index');
                }
                return redirect()->route('dashboard.index')->with('Success' , 'Login successful');
            }
            else{
                return redirect()->back()->with(['error' => 'Invalid email or password']);
            }
        }
        else{
            return redirect()->back()->withInput()->withErrors($validator);
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('auth.index'); 
    }
}
