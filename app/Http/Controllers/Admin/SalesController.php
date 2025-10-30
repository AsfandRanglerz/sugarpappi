<?php

namespace App\Http\Controllers\admin;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Branch;
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
            ->where('status', 'Delivered')
            ->whereDate('created_at', $currentDate)
            ->groupBy('id', 'user_id', 'code', 'total_amount','redeemed', 'status', 'order_created_at', 'week_number', 'day_name', 'order_date')
            ->latest()
            ->get();
        $totalDailyEarnings = $data['dailySales']->sum('total_amount');
        $data['totalDailyEarnings'] = round($totalDailyEarnings, 2);
        $data['totalDailyAmount'] = number_format($totalDailyEarnings, 2, '.', '');
        $data['branches'] = Branch::all();

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
            ->where('status', 'Delivered')
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->groupBy('id',  'user_id', 'code', 'total_amount','redeemed', 'status', 'order_created_at', 'day_name', 'order_date', 'month_number')
            ->orderBy('created_at', 'desc')
            ->get();
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
            ->where('status', 'Delivered')
            ->whereYear('created_at', $currentYear)
            ->groupBy('id',  'user_id', 'code', 'total_amount','redeemed', 'status', 'order_created_at', 'year_number', 'order_date', 'day_name')
            ->orderBy('created_at', 'desc')
            ->get();
        $uniqueYears = $data['yearlySales']->pluck('year_number')->unique()->toArray();
        $data['totalYearlyEarnings'] = number_format(
            Order::where('status', 'Delivered')
                ->whereIn(DB::raw('YEAR(created_at)'), $uniqueYears)
                ->sum('total_amount'),
            2,
            '.',
            ''
        );
        $data['totalYearlyAmount'] = number_format($data['totalYearlyEarnings'], 2, '.', '');
        // #################Branches Sales################
        $branches = Branch::all();
        $data['branchSales'] = [];
        foreach ($branches as $branch) {
            $dailySales = OrderItem::with(['branch', 'product', 'order.user', 'order', 'orderToppings.toppings', 'orderToppings.category'])
                ->select(
                    'order_items.branch_id',
                    DB::raw('SUM(order_items.sub_total) as total_earnings'),
                    DB::raw('DATE(orders.created_at) as order_date'),
                    DB::raw('WEEK(orders.created_at) as week_number'),
                    DB::raw('MONTH(orders.created_at) as month_number'),
                    DB::raw('YEAR(orders.created_at) as year_number')
                )
                ->leftJoin('orders', 'order_items.order_id', '=', 'orders.id')
                ->where('orders.status', 'Delivered')
                ->where('order_items.branch_id', $branch->id)
                ->groupBy('order_date', 'week_number', 'month_number', 'year_number', 'order_items.branch_id')
                ->get();

            $weeklySales = $dailySales->groupBy('week_number');
            $monthlySales = $dailySales->groupBy('month_number');
            $yearlySales = $dailySales->groupBy('year_number');

            $totalDailyEarnings = $dailySales->sum('total_earnings');
            $totalWeeklyEarnings = $weeklySales->map->sum('total_earnings');
            $totalMonthlyEarnings = $monthlySales->map->sum('total_earnings');
            $totalYearlyEarnings = $yearlySales->map->sum('total_earnings');

            // Corrected code: Sum total amounts directly from orders table
            $totalDailyAmount = Order::where('status', 'Delivered')
                ->whereHas('orderItem', function ($query) use ($branch) {
                    $query->where('branch_id', $branch->id);
                })
                ->whereIn(DB::raw('DATE(orders.created_at)'), $dailySales->pluck('order_date')->toArray())
                ->sum('total_amount');

            $totalWeeklyAmount = Order::where('status', 'Delivered')
                ->whereHas('orderItem', function ($query) use ($branch) {
                    $query->where('branch_id', $branch->id);
                })
                ->whereIn(DB::raw('WEEK(created_at)'), $weeklySales->keys()->toArray())
                ->sum('total_amount');

            $totalMonthlyAmount = Order::where('status', 'Delivered')
                ->whereHas('orderItem', function ($query) use ($branch) {
                    $query->where('branch_id', $branch->id);
                })
                ->whereIn(DB::raw('MONTH(created_at)'), $monthlySales->keys()->toArray())
                ->sum('total_amount');

            $totalYearlyAmount = Order::where('status', 'Delivered')
                ->whereHas('orderItem', function ($query) use ($branch) {
                    $query->where('branch_id', $branch->id);
                })
                ->whereIn(DB::raw('YEAR(created_at)'), $yearlySales->keys()->toArray())
                ->sum('total_amount');

            $data['branchSales'][] = [
                'branch' => $branch,
                'dailySales' => $dailySales,
                'weeklySales' => $weeklySales,
                'monthlySales' => $monthlySales,
                'yearlySales' => $yearlySales,
                'totalDailyEarnings' => $totalDailyEarnings,
                'totalWeeklyEarnings' => $totalWeeklyEarnings,
                'totalMonthlyEarnings' => $totalMonthlyEarnings,
                'totalYearlyEarnings' => $totalYearlyEarnings,
                'totalDailyAmount' => number_format($totalDailyAmount, 2, '.', ''),
                'totalWeeklyAmount' => number_format($totalWeeklyAmount, 2, '.', ''),
                'totalMonthlyAmount' => number_format($totalMonthlyAmount, 2, '.', ''),
                'totalYearlyAmount' => number_format($totalYearlyAmount, 2, '.', ''),
            ];
        }
        // return  $data['branchSales'];
        $data['totalDeliveredAmount'] = Order::where('status', 'Delivered')->sum('total_amount');

        // Now $data['branchSales'] contains an array of sales data for each branch for daily, weekly, monthly, and yearly amounts


        return view('admin.sales.index', compact('data'));
    }
    public function showSales($id)
    {
        $dailySales = OrderItem::with(['branch', 'product.topping.gettoping', 'order.user', 'order'])
            ->findOrFail($id);

        return view('admin.sales.dailydetails', ['dailySales' => $dailySales]);
    }
    public function showWeeklySales($id)
    {
        $weeklySales = OrderItem::with(['branch', 'product.topping.gettoping', 'order.user', 'order'])
            ->findOrFail($id);
        return view('admin.sales.weeklydetails', ['weeklySales' => $weeklySales]);
    }
    public function showMonthlySales($id)
    {
        $monthlySales = OrderItem::with(['branch', 'product.topping.gettoping', 'order.user', 'order'])
            ->findOrFail($id);
        return view('admin.sales.monthlydetails', ['monthlySales' =>  $monthlySales]);
    }
    public function showYearlySales($id)
    {
        $yearlySales = OrderItem::with(['branch', 'product.topping.gettoping', 'order.user', 'order'])
            ->findOrFail($id);
        return view('branch.sales.yearlydetails', ['yearlySales' => $yearlySales]);
    }
}
