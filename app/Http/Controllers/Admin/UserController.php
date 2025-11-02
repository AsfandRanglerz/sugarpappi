<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Reward;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function userView()
    {
        $users = User::orderBy('id', 'DESC')->get();
        return view('admin.users.index', compact('users'));
    }

    public function rewards($id){
        $user = User::find($id);
        $userRewards = Reward::where('user_id', $id)->first();
        $remaining = null;
        if ($userRewards) {
            $remaining = $userRewards->rewards - $userRewards->redeemed;
        }
        return view('admin.users.rewards',compact('userRewards' , 'remaining','user'));
    }

    public function destroy($id){
        User::destroy($id);
        return redirect()->back()->with(['status' => true, 'message' => 'Deleted Successfully']);

    }
}
