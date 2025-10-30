<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;

class AuthController extends Controller
{
    public function getLoginPage()
    {
        return view('admin.auth.login');
    }
    public function Login(Request $request)
    {

        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $remember_me = ($request->remember_me) ? true : false;
        if (!auth()->guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $remember_me)) {
            return back()->with(['status' => true, 'message' => 'Invalid Email or Password']);
        }
        return redirect('admin/dashboard')->with(['status' => true, 'message' => 'Login Successfully']);
    }
}
