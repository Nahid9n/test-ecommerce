@extends('admin.master')
@section('title','Order Report')
@section('body')
    <div class="row align-items-center">
        <div class="border-0 mb-4">
            <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                <h3 class="fw-bold mb-0 text-dark">Order Report</h3>
            </div>
        </div>
    </div>
    <div class="row" style="margin-top: 4px;">
        <div class="row" style="margin-top: 20px;">
            <table style="width:100% ; text-align: center;" class="table table-bordered">
                <thead>
                <tr style="background-color: #a6a6f4; color: white; font-size: 11px; text-transform: uppercase">
                    <th>SL</th>
                    <th>Order id</th>
                    <th>Product name</th>
                    <th>Price</th>
                    <th>Date</th>

                </tr>
                </thead>
                <tbody>
                @forelse($orders as $order)
                    <tr style="">
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
            <div class="text-end">
                <form method="GET" action="{{ route('admin.order.report.download') }}" class="mt-2">
                    <input type="hidden" name="start_date" value="{{ request('start_date') }}">
                    <input type="hidden" name="end_date" value="{{ request('end_date') }}">
                    <input type="hidden" name="product_id" value="{{ request('product_id') }}">
                    <button type="submit" class="btn btn-danger">Download PDF</button>
                </form>
            </div>
        </div>
    </div>
@endsection

