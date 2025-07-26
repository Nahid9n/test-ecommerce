<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
//        return Auth::user()->role;
        $orders = Order::get(['payment_status','order_date','payment_amount']);
        $totalSale = $orders->where('payment_status','Complete')->sum('payment_amount');
        $todaySale = OrderDetail::whereDate('created_at', Carbon::today()->toDateString())->sum('product_price');
        $totalOrder = $orders->count();
        $todayOrder = $orders->where('order_date', Carbon::today()->toDateString())->count();
        $yesterdayOrders = $orders->where('order_date', Carbon::yesterday()->toDateString())->count();
        $WeeklyOrders = $orders->whereBetween('order_date', [Carbon::now()->startOfWeek()->toDateString(), Carbon::now()->endOfWeek()->toDateString()])->count();
        $monthlyOrder = Order::whereMonth('order_date', Carbon::now()->month)->whereYear('order_date', Carbon::now()->year)->count();
        $customer = Customer::where('status',1)->count();
        $products = Product::where('status',1)->get('stock_amount');
        $totalProduct = $products->count();
        $totalStockOutProduct = $products->where('stock_amount','<=',1)->count();
        $totalAlertProduct = $products->where('stock_amount','<=',5)->count();
        $pendingOrders = Order::whereIn('order_status',['Pending','Processing'])->latest()->get();
        return view('admin.home.index',compact('customer','totalSale',
            'todaySale','totalOrder','todayOrder','yesterdayOrders','WeeklyOrders',
            'monthlyOrder','totalProduct','totalStockOutProduct','totalAlertProduct','pendingOrders'
        ));
    }
}
