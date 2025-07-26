@extends('website.master')
@section('title','Customer Dashboard')
@section('body')
    <section class="mt-2 mb-50">
        <div class="container p-2" style="background-color: #000000">
            @include('website.customer.layout.sidebar')
            <div class="row" style="margin-right: 0; margin-left: 0">
                <div class="text-center col-6 col-md-3 my-1">
                    <div class="card card-body" style="background-color: #18bee9">
                        <a href="{{ route('customer.orders') }}">
                            <h5 class="my-2">Monthly Total Orders</h5>
                            <h5 class="card-title">{{$monthlyOrders}}</h5>
                        </a>
                    </div>
                </div>
                <div class="text-center col-6 col-md-3 my-1">
                    <div class="card card-body" style="background-color: #f1d97b">
                        <a href="{{ route('customer.orders') }}">
                            <h5 class="my-2">Monthly Total purchase amount</h5>
                            <h5 class="card-title">{{$monthlyPurchaseAmount}}</h5>
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-12">
                        <div class="card product-sales-main">
                            <div class="card-header border-bottom">
                                <h3 class="card-title mb-0">Top 05 purchase Product list</h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="data-table" class="table text-nowrap mb-0 table-bordered">
                                        <thead>
                                        <tr>
                                            <th class="bg-transparent border-bottom-0 wp-15">Product Name</th>
                                            <th class="bg-transparent border-bottom-0">Total Orders</th>
                                        </tr>
                                        </thead>
                                        <tbody class="table-body">
                                        @foreach($topProducts as $item)
                                            <tr>
                                                <td>{{ $item->product->name ?? 'N/A' }}</td>
                                                <td>{{ $item->total_quantity }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div><!-- COL END -->
                </div>

            </div>
        </div>
    </section>
@endsection
