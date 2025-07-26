@extends('website.master')
@section('title','Orders')
@section('body')
    <section class="mt-2 mb-50">
        <div class="container p-2" style="background-color: #000000">
            @include('website.customer.layout.sidebar')
            <div class="row table-responsive" style="margin-right: 0; margin-left: 0; --bs-gutter-x: 0;">
                <div class="card bg-transparent text-white">
                    <div class="card-header text-center">
                        <h5>YOUR ORDERS</h5>
                    </div>
                    <div class="card-body text-white">
                        <div class="row">
                            <div class="col-md-12">
                                @if(count($orders) > 0)
                                <table id="basic-datatable" class="" style="">
                                    <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>ID</th>
                                        <th>Date & Time</th>
                                        <th>Qty</th>
                                        <th>Payment</th>
                                        <th>Status</th>
                                        <th>Total</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($orders as $order)
                                        <tr class="{{$order->delivery_status == 0 ? 'bg-warning text-dark':''}}{{$order->delivery_status == 1 ? 'bg-info text-white':''}}{{$order->delivery_status == 2 ? 'bg-primary':''}}{{$order->delivery_status == 3 ? 'bg-success':''}}{{$order->delivery_status == 4 ? 'bg-danger text-white':''}}">
                                            <td>{{$loop->iteration}}</td>
                                            <td><a class="text-white" href="{{ route('customer-order-details', $order->order_code) }}">{{$order->order_code}}</a></td>
                                            <td>{{$order->order_date}}</td>
                                            <td>{{$order->orderDetails->sum('product_qty')}}</td>
                                            <td>{{ $order->payment_status }}</td>
                                            <td>
                                                {{$order->order_status }}
                                            </td>
                                            <td>৳ {{ $order->order_total }} </td>
                                            <td class="d-flex justify-content-center">
                                                <a class="mx-1 d-block text-white" href="{{ route('customer-order-details', $order->order_code) }}"><i class="fi-rs-eye"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                @else
                                    <div class="text-center">Empty</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
