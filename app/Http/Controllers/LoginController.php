<?php

namespace App\Http\Controllers;

use App\Models\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function auth(Request $request)
    {
        $username=$request->username;
        $pass=$request->password;        
        if(Auth::attempt(['username' => $username, 'password' => $pass])){
            $request->session()->regenerate();
            return redirect()->intended('admin');
        }
        return back()->with('errorLogin','Login gagal!!!, Periksa username dan password anda');
    }
    
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');        
    }
}
