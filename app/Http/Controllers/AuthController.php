<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{


    public function logout()
    {
        Auth::logout();  
        session()->flush(); 

        return redirect()->route('login');  
    }

    public function layout()
    {
        return view('auth.layout');
    }
}
