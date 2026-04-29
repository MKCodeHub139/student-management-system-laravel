<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    //
    public function index(){
        return view('auth.login');
    }
    public function login(Request $request){
        $credentials =$request->only('email','password');
        if(Auth::guard('student')->attempt($credentials)){
            return redirect('/student/dashboard');
        }
           if (Auth::guard('teacher')->attempt($credentials)) {
            return redirect('/teacher/dashboard');
        }

        if (
            $request->email === env('ADMIN_EMAIL') &&
            $request->password === env('ADMIN_PASSWORD')
        ) {
            Session::put('is_admin', true);
            return redirect('/admin');
        }

        return back()->with('error','Invalid Login');
    }
    public function logout()
    {
         Auth::guard('student')->logout();
    Auth::guard('teacher')->logout();
    Auth::guard('web')->logout();

    Session::forget('is_admin');
    Session::invalidate();
    Session::regenerateToken();

    return redirect('/login');
    }

}
