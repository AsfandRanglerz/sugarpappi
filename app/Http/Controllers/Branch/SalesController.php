<?php

namespace App\Http\Controllers\branch;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SalesController extends Controller
{
    public function salesIndex()
    {
        //############### Daily Earning ############
        $branchId = Auth::guard('branch')->id();
        $currentDate = Carbon::now()->toDateString();
        $data['dailySales'] = Order::select(
            'id',
            'user_id',
            'code',
            'total_amount',
            'redeemed',
            'status',
            'created_at as order_created_at',
            DB::raw('WEEK(created_at) as week_number'),
            DB::raw('DAYNAME(created_at) as day_name'),
            DB::raw('DATE(created_at) as order_date'),
            DB::raw('COUNT(*) as order_count'),
            DB::raw('SUM(total_amount) as total_earnings')
        )
            ->with(['orderItem.orderToppings.category', 'orderItem.orderToppings.toppings', 'user', 'orderItem.branch'])
            ->whereHas('orderItem', function ($query) use ($branchId) {
                $query->where('branch_id', $branchId);
            })
            ->where('status', 'Delivered')
            ->whereDate('created_at', $currentDate)
            ->groupBy('id',  'user_id', 'code', 'total_amount', 'redeemed','status', 'order_created_at', 'week_number', 'day_name', 'order_date')
            ->latest()
            ->get();

        $data['totalDailyEarnings'] = $data['dailySales']->sum('total_amount');
        $data['totalDailyAmount'] = number_format($data['totalDailyEarnings'], 2, '.', '');
        // ################# Weekly Earning###########
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();
        $data['weeklySales'] = Order::select(
            'id',
            'user_id',
            'code',
            'total_amount',
            'redeemed',
            'status',
            'created_at as order_created_at',
            DB::raw('WEEK(created_at) as week_number'),
            DB::raw('DAYNAME(created_at) as day_name'),
            DB::raw('DATE(created_at) as order_date'),
            DB::raw('COUNT(*) as order_count'),
            DB::raw('SUM(total_amount) as total_earnings')
        )
            ->with(['orderItem.orderToppings.category', 'orderItem.orderToppings.toppings', 'user', 'orderItem.branch'])
            ->whereHas('orderItem', function ($query) use ($branchId) {
                $query->where('branch_id', $branchId);
            })
            ->where('status', 'Delivered')
            ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->groupBy('id',  'user_id', 'code', 'total_amount','redeemed', 'status', 'order_created_at', 'week_number', 'day_name', 'order_date')
            ->orderBy('created_at', 'desc')
            ->get();

        // Calculate total weekly earnings
        $data['totalWeeklyEarnings'] = $data['weeklySales']->sum('total_amount');
        $data['totalWeeklyAmount'] = number_format($data['totalWeeklyEarnings'], 2, '.', '');

        //############# Monthly Earnings #################
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        $data['monthlySales'] = Order::select(
            'id',
            'user_id',
            'code',
            'total_amount',
            'redeemed',
            'status',
            'created_at as order_created_at',
            DB::raw('MONTH(created_at) as month_number'),
            DB::raw('DAYNAME(created_at) as day_name'),
            DB::raw('DATE(created_at) as order_date'),
            DB::raw('COUNT(*) as order_count'),
            DB::raw('SUM(total_amount) as total_earnings')
        )
            ->with(['orderItem.orderToppings.category', 'orderItem.orderToppings.toppings', 'user', 'orderItem.branch'])
            ->whereHas('orderItem', function ($query) use ($branchId) {
                $query->where('branch_id', $branchId);
            })
            ->where('status', 'Delivered')
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->groupBy('id',  'user_id', 'code', 'total_amount','redeemed', 'status', 'order_created_at', 'day_name', 'order_date', 'month_number')
            ->orderBy('created_at', 'desc')
            ->get();

        // Calculate total monthly earnings
        $data['totalMonthlyEarnings'] = $data['monthlySales']->sum('total_amount');
        $data['totalMonthlyAmount'] = number_format($data['totalMonthlyEarnings'], 2, '.', '');

        //############## Yearly Earnings ################
        $currentYear = now()->year;

        $data['yearlySales'] = Order::select(
            'id',
            'user_id',
            'code',
            'total_amount',
            'redeemed',
            'status',
            'created_at as order_created_at',
            DB::raw('YEAR(created_at) as year_number'),
            DB::raw('DAYNAME(created_at) as day_name'),
            DB::raw('COUNT(*) as order_count'),
            DB::raw('SUM(total_amount) as total_earnings'),
            DB::raw('DATE(created_at) as order_date'),

        )
            ->with(['orderItem.orderToppings.category', 'orderItem.orderToppings.toppings', 'user', 'orderItem.branch'])
            ->whereHas('orderItem', function ($query) use ($branchId) {
                $query->where('branch_id', $branchId);
            })
            ->where('status', 'Delivered')
            ->whereYear('created_at', $currentYear)
            ->groupBy('id',  'user_id', 'code', 'total_amount','redeemed', 'status', 'order_created_at', 'year_number', 'order_date', 'day_name')
            ->orderBy('created_at', 'desc')
            ->get();
        $uniqueYears = $data['yearlySales']->pluck('year_number')->unique()->toArray();
        $data['totalYearlyEarnings'] = number_format(
            Order::where('status', 'Delivered')
                ->whereHas('orderItem', function ($query) use ($branchId) {
                    $query->where('branch_id', $branchId);
                })
                ->whereIn(DB::raw('YEAR(created_at)'), $uniqueYears)
                ->sum('total_amount'),
            2,
            '.',
            ''
        );
        $data['totalYearlyAmount'] = number_format($data['totalYearlyEarnings'], 2, '.', '');

        return view('branch.sales.index', compact('data'));
    }
    public function showSales($id)
    {
        $dailySales = OrderItem::with(['branch', 'product.topping.gettoping', 'order.user', 'order'])
            ->findOrFail($id);

        return view('branch.sales.dailydetails', ['dailySales' => $dailySales]);
    }
    public function showWeeklySales($id)
    {
        $weeklySales = OrderItem::with(['branch', 'product.topping.gettoping', 'order.user', 'order'])
            ->findOrFail($id);
        return view('branch.sales.weeklydetails', ['weeklySales' => $weeklySales]);
    }
    public function showMonthlySales($id)
    {
        $monthlySales = OrderItem::with(['branch', 'product.topping.gettoping', 'order.user', 'order'])
            ->findOrFail($id);
        return view('branch.sales.monthlydetails', ['monthlySales' =>  $monthlySales]);
    }
    public function showYearlySales($id)
    {
        $yearlySales = OrderItem::with(['branch', 'product.topping.gettoping', 'order.user', 'order'])
            ->findOrFail($id);
        return view('branch.sales.yearlydetails', ['yearlySales' => $yearlySales]);
    }
}
