@extends('admin.master')
@section('title','Order Report')
@section('body')
    <div class="row align-items-center">
        <div class="border-0 mb-4">
            <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                <h3 class="fw-bold mb-0 text-dark">Customer Report</h3>
            </div>
        </div>
    </div>
    <div class="row" style="margin-top: 4px;">
        <div class="row" style="margin-top: 20px;">
            <table style="width:100% ; text-align: center;" class="table table-bordered">
                <thead>
                <tr style="background-color: #a6a6f4; color: white; font-size: 11px; text-transform: uppercase">
                    <th>Date</th>
                    <th>Order Code</th>
                    <th>Customer Id </th>
                    <th>Customer Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    @foreach($order->orderDetails as $orderDetail)
                        <tr>
                            <td>{{ $orderDetail->created_at->format('Y-m-d') }}</td>
                            <td>{{ $order->order_code }}</td>
                            <td>{{ $order->customer->id }}</td>
                            <td>{{ $order->customer->name }}</td>
                            <td>{{ $order->customer->email }}</td>
                            <td>{{ $order->customer->mobile }}</td>
                        </tr>
                    @endforeach
                @endforeach
                </tbody>
            </table>
            <div class="text-end">
                <form method="GET" action="{{ route('admin.customer.report.download') }}" class="mt-2">
                    <input type="hidden" name="order_id" value="{{ request('order_id') }}">
                    <input type="hidden" name="product_id" value="{{ request('product_id') }}">
                    <button type="submit" class="btn btn-danger">Download PDF</button>
                </form>
            </div>
        </div>
    </div>
@endsection

