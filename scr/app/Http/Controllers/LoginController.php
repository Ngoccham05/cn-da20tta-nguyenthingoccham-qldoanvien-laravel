<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\tkdoanvien;
use App\Models\tkadmin;

class LoginController extends Controller
{
    public function loginpage()
    {
        if(Auth::guard('doanvien')->check()){
            return view('doanvien.index');
        }
        else if(Auth::guard('admin')->check()){
            return redirect('/admin/home');
        }
        else{
            return view('login');
        }
    }

    public function logout()
    {
        Auth::guard('doanvien')->logout();
        Auth::guard('admin')->logout();
        return redirect()->route('loginpage');
    }

    public function home(Request $request)
    {   
        $name = $request->input('txtName');
        $pwd = $request->input('txtPwd');

        $doanvien = tkdoanvien::where('username', $name)->where('password', md5($pwd))->where('active', '1')->first();
        $admin = tkadmin::where('username_admin', $name)->where('password', $pwd)->where('active', '1')->first();

        if ($doanvien != null) {
            Auth::guard('doanvien')->login($doanvien);            
            return redirect('/ktcn');
        }
        elseif($admin != null){
            Auth::guard('admin')->login($admin);
            return redirect('/admin/home');
        }
        else {
            Session::flash('error', 'Thông tin đăng nhập không đúng');
            return view('login');
        }
    }
}
