<?php

namespace App\Http\Controllers\Branch;

use App\Models\Order;
use App\Models\Branch;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\ResetPasswordMail;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class DashBoardController extends Controller
{
    public function getbranchdashboard()
    {
        $branchId = Auth::guard('branch')->id();
        $pending = Order::where('status', 'Pending')
            ->whereHas('orderItem', function ($query) use ($branchId) {
                $query->where('branch_id', $branchId);
            })
            ->count();
        $oredrReady = Order::where('status', 'Order Ready')
            ->whereHas('orderItem', function ($query) use ($branchId) {
                $query->where('branch_id', $branchId);
            })
            ->count();
        $delivered = Order::where('status', 'Delivered')
            ->whereHas('orderItem',function ($query) use ($branchId) {
                    $query->where('branch_id', $branchId);
                }
            )->count();
        $orders = Order::whereHas('orderItem', function ($query) use ($branchId) {
            $query->where('branch_id', $branchId);
        })->count();
        $sumTotalAmount = Order::whereHas('orderItem', function ($query) use ($branchId) {
            $query->where('branch_id', $branchId);
        })
            ->sum('total_amount');
        return view('branch.index', compact('pending', 'oredrReady', 'delivered', 'orders', 'sumTotalAmount'));
    }
    public function getBranchProfile()
    {
        $data = Branch::find(Auth::guard('branch')->id());
        return view('branch.auth.profile', compact('data'));
    }
    public function updateBranchProfile(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
        ]);
        $data = $request->only(['name', 'email', 'phone_number', 'location','tax']);
        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename = time() . '.' . $extension;
            $file->move(public_path('/admin/assets/images/users/'), $filename);
            $data['image'] = 'public/admin/assets/images/users/' . $filename;
        }
        Branch::find(Auth::guard('branch')->id())->update($data);
        return back()->with(['status' => true, 'message' => 'Profile Updated Successfully']);
    }

    public function branchlogout()
    {
        Auth::guard('branch')->logout();
        return redirect()->route('branch')->with(['status' => true, 'message' => 'Logout Successfully']);
    }

}
