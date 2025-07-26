@extends('website.master')
@section('title','Customer Dashboard')
@section('body')
    <section class="mt-2 mb-50">
        <div class="container p-2" style="background-color: #000000">
            @include('website.customer.layout.sidebar')
            <div class="row" style="">
                    <div style="border-top: 1px solid black; border-left: 1px solid #000000; border-right: 1px solid black; ">
                        <h5 class="text-white" style="padding:15px; margin: 0; text-transform: uppercase;" align="center">Order Report </h5>
                    </div>
                    <table style=" text-align: center;" class="text-white">
                        <thead>
                        <tr style="background-color: #5c636a; color: white; font-size: 11px; text-transform: uppercase">
                            <th>SL</th>
                            <th>Order id</th>
                            <th>Product name</th>
                            <th>Price</th>
                            <th>Date</th>

                        </tr>
                        </thead>
                        <tbody>
                        @forelse($orders as $order)
                            <tr style="font-size: 11px">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $order->order_id }}</td>
                                <td>{{ $order->product->name }}</td>
                                <td>{{ $order->product_price }}</td>
                                <td>{{ $order->created_at }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center" colspan="9">No Data Found</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            <div class="text-end">
                <form method="GET" action="{{ route('customer.order.report.download') }}" class="mt-2">
                    <input type="hidden" name="start_date" value="{{ request('start_date') }}">
                    <input type="hidden" name="end_date" value="{{ request('end_date') }}">
                    <input type="hidden" name="product_id" value="{{ request('product_id') }}">
                    <button type="submit" class="btn btn-danger">Download PDF</button>
                </form>
            </div>
        </div>
    </section>
@endsection
