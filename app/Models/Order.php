<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    private static $order;

    public static function newOrder($request)
    {
        self::$order = new Order();
        self::$order->customer_id            = auth()->user()->id;
        self::$order->order_code             = rand(0,999999);
        self::$order->order_total            = $request->order_total;
        self::$order->tax_total              = $request->tax_total;
        self::$order->shipping_total         = $request->shipping_total;
        self::$order->discount               = $request->discount_total;
        self::$order->cod_charge               = $request->cod_charge_total;
        self::$order->order_date             = date('Y-m-d');
        self::$order->order_timestamp        = strtotime(date('Y-m-d')) ;
        self::$order->delivery_address       = $request->address;
        self::$order->mobile       = $request->mobile;
        self::$order->zip       = $request->zip;
        self::$order->house_road_area       = $request->house_road_area;
        self::$order->mobile       = $request->mobile;
        self::$order->payment_method         = $request->payment_method;
        self::$order->order_note             = $request->order_note;
        self::$order->save();
        return self::$order;
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class,'customer_id','user_id');
    }

    public function user()
        {
            return $this->belongsTo(User::class,'customer_id','id');
        }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public static function updateOrder($request , $id)
    {
        self::$order = Order::find($id);


//         self::$order->product_id;
//         $proInfo=Product::where('id',self::$order->product_id)->get();
//         $proInfo->vendor_id;



        if ($request->order_status == 'Pending'){
            self::$order->order_status = $request->order_status ;

            self::$order->delivery_status = $request->order_status ;
            self::$order->payment_status = $request->order_status ;




        }
        elseif ($request->order_status == 'Processing'){

            self::$order->order_status = $request->order_status ;
            self::$order->delivery_address = $request->delivery_address ;
            self::$order->delivery_status = $request->order_status ;
            self::$order->payment_status = $request->order_status ;
            self::$order->courier_id = $request->courier_id ;

        }
        elseif ($request->order_status == 'Complete'){
            self::$order->order_status = $request->order_status ;

            self::$order->delivery_status = $request->order_status ;
            self::$order->payment_status = $request->order_status ;
            self::$order->payment_date = date('Y-m-d');
            self::$order->payment_timestamp = strtotime(date('Y-m-d'));
            self::$order->payment_amount = self::$order->order_total ;
        }
        elseif ($request->order_status == 'Cancel'){
            self::$order->order_status = $request->order_status ;
            self::$order->delivery_status = $request->order_status ;
            self::$order->payment_status = $request->order_status ;
        }

        self::$order->save();
    }

    public static function deleteOrder($id)
    {
        self::$order = Order::find($id);
        self::$order->delete();
    }


}
