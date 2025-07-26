<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderDetail;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function OrderReport(){
       $products = Product::get();
        return view('admin.report.order_report',compact('products'));
    }
    public function OrderReportShow(Request $request){
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $product_id = $request->product_id;
        if ($end_date) {
            $end_date = \Carbon\Carbon::parse($end_date)->endOfDay();
        }

        $orders = OrderDetail::query()
            ->when($start_date && $end_date, function ($q) use ($start_date, $end_date) {
                return $q->whereBetween('created_at', [$start_date, $end_date]);
            })
            ->when($product_id, function ($q) use ($product_id) {
                return $q->where('product_id', $product_id);
            })
            ->get();

                return view('admin.report.order-reportshow',compact('orders'));
    }
    public function customerReport(){
       $products = Product::get();
       $orders = Order::get();
        return view('admin.report.customer_report',compact('products','orders'));
    }
    public function customerReportShow(Request $request){
        $order_code = $request->order_code;
        $product_id = $request->product_id;

        $orders = Order::query()
            ->when($order_code, function ($q) use ($order_code) {
                return $q->where('order_code', $order_code);
            })
            ->when($product_id, function ($q) use ($product_id) {
                return $q->whereHas('orderDetails', function ($query) use ($product_id) {
                    $query->where('product_id', $product_id);
                });
            })
            ->with('orderDetails.product', 'customer')
            ->get();

                return view('admin.report.customer_report_show',compact('orders'));
    }


}
