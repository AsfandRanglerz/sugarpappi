<?php

namespace App\Http\Controllers\Branch;

use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;



class OrderController extends Controller
{
    public function orderIndex()
    {

        $branchId = Auth::guard('branch')->id();
        $orders = Order::with(['orderItem.orderToppings.category', 'orderItem.orderToppings.toppings', 'user', 'orderItem.branch'])
            ->whereHas('orderItem', function ($query) use ($branchId) {
                $query->where('branch_id', $branchId);
            })
            ->latest()
            ->get();
        return view('branch.order.index', compact('orders'));
    }
}
