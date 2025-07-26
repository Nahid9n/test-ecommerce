@extends('website.master')
@section('title','Customer Dashboard')
@section('body')

    <section class="mt-2 mb-50">
        <div class="container p-2" style="background-color: #000000">
            @include('website.customer.layout.sidebar')
            <div class="row" style="margin-right: 0; margin-left: 0">
                <div class="text-center col-6 col-md-3 my-1">
                    <div class="card card-body" style="background-color: #d4cfcf">
                        <a href="{{ route('customer.orders') }}">
                            <h5 class="my-2">Total Order</h5>
                            <h5 class="card-title">{{count($totalOrder)}}</h5>
                        </a>
                    </div>
                </div>
                <div class="text-center col-6 col-md-3 my-1">
                    <div class="card card-body" style="background-color: #f1d97b">
                        <a href="{{ route('customer.orders') }}">
                            <h5 class="my-2">Pending Order</h5>
                            <h5 class="card-title">{{$pendingOrder}}</h5>
                        </a>
                    </div>
                </div>
                <div class="text-center col-6 col-md-3 my-1">
                    <div class="card card-body" style="background-color: #30abed">
                        <a href="{{ route('customer.orders') }}">
                            <h5 class="my-2">On Shipment</h5>
                            <h5 class="card-title">{{$onShipmentOrder}}</h5>
                        </a>
                    </div>
                </div>
                <div class="text-center col-6 col-md-3 my-1">
                    <div class="card card-body" style="background-color: #3af109">
                        <a href="{{ route('customer.orders') }}">
                            <h5 class="my-2">Delivered</h5>
                            <h5 class="card-title">{{$completeOrder}}</h5>
                        </a>
                    </div>
                </div>
                <div class="text-center col-6 col-md-3 my-1">
                    <div class="card card-body" style="background-color: #f1776d">
                        <a href="{{ route('customer.orders') }}">
                            <h5 class="my-2">Canceled</h5>
                            <h5 class="card-title">{{$cancelOrder}}</h5>
                        </a>
                    </div>
                </div>
                <div class="text-center col-6 col-md-3 my-1">
                    <div class="card card-body" style="background-color: #f38353">
                        <a href="{{ route('customer.orders') }}">
                            <h5 class="my-2">Order Amount</h5>
                            <h5 class="card-title">{{$orderAmount}}</h5>
                        </a>
                    </div>
                </div>
                <div class="text-center col-6 col-md-3 my-1">
                    <div class="card card-body" style="background-color: #97f0a9">
                        <a href="{{ route('customer.orders') }}">
                            <h5 class="my-2">Refund Amount</h5>
                            <h5 class="card-title">৳ 0 Static</h5>
                        </a>
                    </div>
                </div>
                
                <div class="text-center col-6 col-md-3 my-1">
                    <div class="card card-body" style="background-color: #8ef3de">
                        <a href="{{ route('customer.orders') }}">
                            <h5 class="my-2">Review</h5>
                            <h5 class="card-title">0 Static</h5>
                        </a>
                    </div>
                </div>
                <div class="text-center col-6 col-md-3 my-1">
                    <div class="card card-body" style="background-color: #f1c96d">
                        <a href="{{ route('customer.orders') }}">
                            <h5 class="my-2">Product Request</h5>
                            <h5 class="card-title">0 Static</h5>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
