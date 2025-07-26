<?php

namespace App\Http\Controllers;
use App\Models\Address;
use App\Models\Area;
use App\Models\District;
use App\Models\Product;
use App\Models\User;
use Exception;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\CouponUsed;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use Brian2694\Toastr\Facades\Toastr;


use Illuminate\Http\Request;


class CheckoutController extends Controller
{
    private $customer, $order, $orderDetail, $sslCommerzPayment;
    public function index()
    {
        if (auth()->check()) {
            $this->customer = Customer::where('user_id',auth()->user()->id)->first();
            $cartItems = Cart::where('customer_id',auth()->user()->id)->get();

            return view('website.checkout.index',[
                'customer' =>  $this->customer,
                'cartItems' =>  $cartItems,

            ]);
        }
        else{
            return back()->with('error',"Please login/register.");
        }

    }
    public function getAddressDetails(Request $request){
        $address = Address::with('district', 'place')->find($request->id);
        return response()->json([
            'success' => true,
            'address' => $address,
        ]);
    }
    public function newOrder( Request $request){
        $order = Order::newOrder($request);
        $items = Cart::where('customer_id',auth()->user()->id)->get();
        foreach ($items as $item){
                $product = Product::find($item->product_id);
                $orderDetail = new OrderDetail();
                $orderDetail->order_id                  = $order->id;
                $orderDetail->product_id                = $item->product_id;
                $orderDetail->product_name              = $product->name;
                $price = $product->regular_price;
                $orderDetail->product_price             = $price;
                $orderDetail->product_qty               = $item->qty;
                $orderDetail->save();

                $item->delete();


            }
        return redirect()->route('complete-order')->with('message','Congratulation... your order success. Please check your mail and wait we will contact with you soon.');
    }
    public function completeOrder()
    {
        return view('website.checkout.complete-order');
    }


}
