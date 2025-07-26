<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Area;
use App\Models\Cart;
use App\Models\Courier;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
//use Barryvdh\DomPDF\Facade\Pdf;

use PDF;

class OrderController extends Controller
{
    public function index()
    {
        return view('admin.order.index',[
//            'orders' => Order::all()
            'orders' => Order::orderby('id','desc')->get()
        ]);
    }


    public function show(string $order_code)
    {
        return view('admin.order.show',[
            'order' => Order::where('order_code',$order_code)->first(),
            
        ]);
    }
    public function edit(string $id)
    {
        return view('admin.order.edit',[
            'order' => Order::find($id),
        ]);
    }
    public function update(Request $request, $orderCode)
    {
        $order = Order::where('order_code', $orderCode)->first();
        $order->order_total = $request->order_total;
        $order->discount = $request->discount;
        $order->special_discount = $request->special_discount;
        $order->cod_charge = $request->cod_charge;
        $order->shipping_total = $request->shipping_total;
        $order->shipping_discount_amount = $request->shipping_discount_amount;
        $order->tax_total = $request->tax_total;
        $order->delivery_address = $request->delivery_address;
        $order->payment_method = $request->payment_method;
        switch ($request->order_status){
            case "Pending":
                $order->order_status = $request->order_status;
                $order->delivery_status = $request->order_status;
            case "Confirmed":
                $order->order_status = $request->order_status;
                $order->delivery_status = $request->order_status;

            case "Out_For_Delivery":
                $order->order_status = $request->order_status;
                $order->delivery_status = $request->order_status;

            case "Delivered":
                $order->order_status = $request->order_status;
                $order->delivery_status = $request->order_status;

            case "Canceled":
                $order->order_status = $request->order_status;
                $order->delivery_status = $request->order_status;
        }
        if ($request->is_paid){
            $order->payment_status = $request->is_paid;
            $order->payment_amount = $request->order_total;
            $order->payment_date = date('Y-m-d');
            $order->payment_timestamp = strtotime(date('Y-m-d'));
        }
       
        $order->save();

        return back()->with('message', 'Order info update successfully.');
    }
    public function destroy(string $id)
    {
        Order::deleteOrder($id);
        OrderDetail::deleteOrderDetailInfo($id);

        return back()->with('message', 'Order Information delete successfully');

    }
    public function showInvoice( string $id)
    {
        return view('admin.order.invoice-show',[
            'order' => Order::find($id)
        ]);
    }
    public function showDownload( string $id)
    {
//        $pdf = PDF::loadHTML('<h1>Test</h1>'); // make pdf
        // $pdf = pdf::loadView('admin.order.invoice-download',[
        //     'order' => Order::find($id)
        // ]); // make pdf
        // return $pdf->download('invoice.pdf');

        $pdf = PDF::loadView('admin.order.invoice-download',[
           'order' => Order::find($id)
       ]);
       return  $pdf->download('invoice.pdf');
    //    return view('admin.order.invoice-download',[
    //        'order' => Order::find($id)
    //    ]);
    }
    public function getAddress($customerId){
        $addresses = Address::with('district', 'place')->where('user_id', $customerId)->get();
        return response()->json([
            'success' => true,
            'data' => $addresses,
        ]);
    }
    public function getAddressDetails(Request $request){
        $address = Address::with('district', 'place')->find($request->id);
        return response()->json([
            'success' => true,
            'address' => $address,
        ]);
    }




}
