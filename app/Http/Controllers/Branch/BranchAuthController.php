<?php

namespace App\Http\Controllers\Branch;

use App\Models\Branch;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\ResetPasswordMail;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class BranchAuthController extends Controller
{
    public function getLoginPage()
    {
        return view('branch.auth.login');
    }
    public function Login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::guard('branch')->attempt($credentials)) {
            $user = Auth::guard('branch')->user();
            $request->session()->put('branch_user', $user);
            return redirect('branch/dashboard')->with(['status' => true, 'message' => 'Login Successfully']);
        }

        return back()->with(['status' => true, 'message' => 'Invalid Email or Password']);
    }

    public function forgetBranchPassword()
    {
        return view('branch.auth.forgetPassword');
    }
    public function branchResetPasswordLink(Request $request)
    {
        $request->validate([
            'email' => 'required|exists:branches,email',
        ]);
        $exists = DB::table('password_resets')->where('email', $request->email)->first();
        if ($exists) {
            return back()->with(['status' => true, 'message' => 'Reset Password Link Already Send Successfully']);
        } else {
            $token = Str::random(30);
            DB::table('password_resets')->insert([
                'email' => $request->email,
                'token' => $token,
            ]);

            $data['url'] = url('change_password', $token);
            Mail::to($request->email)->send(new ResetPasswordMail($data));
            return back()->with(['status' => true, 'message' => 'Reset Password Link Send Successfully']);
        }
    }
    public function change_password($id)
    {

        $user = DB::table('password_resets')->where('token', $id)->first();

        if (isset($user)) {
            return view('branch.auth.chnagePassword', compact('user'));
        }
    }

    public function resetPassword(Request $request)
    {

        $request->validate([
            'password' => 'required|min:8',
            'confirmed' => 'required',

        ]);
        if ($request->password != $request->confirmed) {

            return back()->with(['error_message' => 'Password not matched']);
        }
        $password = bcrypt($request->password);
        $tags_data = [
            'password' => bcrypt($request->password)
        ];
        if (Branch::where('email', $request->email)->update($tags_data)) {
            DB::table('password_resets')->where('email', $request->email)->delete();
            return redirect('branch')->with(['status' => true, 'message' => 'Reset Password Successfully']);
        }
    }
}
