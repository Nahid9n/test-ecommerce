@extends('admin.master')
@section('title','dashboard')
@section('body')

    <!-- PAGE-HEADER -->
    <div class="page-header">
        <div>
            <h1 class="page-title">Dashboard</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
        </div>
    </div>
    <!-- PAGE-HEADER END -->

    <!-- ROW-1 -->
    <div class="row">
        <div class="col-lg-6 col-sm-12 col-md-6 col-xl-3">
            <div class="card overflow-hidden bg-success">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h3 class="mb-2 text-black fw-semibold">৳ {{$monthlyOrders ?? 0}}</h3>
                            <p class="fs-13 fw-semibold text-black mb-0">Monthly Total Orders</p>
                        </div>
                        <div class="col col-auto top-icn dash">
                            <div class="counter-icon bg-primary dash ms-auto box-shadow-primary">
                                <i class="fa fa-product-hunt"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12 col-md-6 col-xl-3">
            <div class="card overflow-hidden" style="background-color: #7e7eed">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h3 class="mb-2 text-black fw-semibold">৳ {{$monthlySales ?? 0}}</h3>
                            <p class="fs-13 fw-semibold text-black mb-0">Monthly Total Sales amount</p>
                        </div>
                        <div class="col col-auto top-icn dash">
                            <div class="counter-icon bg-primary dash ms-auto box-shadow-primary">
                                <i class="fa fa-product-hunt"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ROW-1 END-->

    <!-- ROW-4 -->
    <div class="row">
        <div class="col-12 col-sm-12">
            <div class="card product-sales-main">
                <div class="card-header border-bottom">
                    <h3 class="card-title mb-0">Top 5 Order List</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="data-table" class="table text-nowrap mb-0 table-bordered">
                            <thead>
                                <tr>
                                    <th class="bg-transparent border-bottom-0 wp-15">Product Name</th>
                                    <th class="bg-transparent border-bottom-0 wp-15">Product Code</th>
                                    <th class="bg-transparent border-bottom-0 wp-15">Stock Amount</th>
                                    <th class="bg-transparent border-bottom-0">Total Orders</th>
                                </tr>
                            </thead>
                            <tbody class="table-body">
                            @foreach($topProducts as $item)
                                <tr>
                                    <td>{{ $item->product->name ?? 'N/A' }}</td>
                                    <td>{{ $item->product->code ?? 'N/A' }}</td>
                                    <td>{{ $item->product->stock_amount ?? 'N/A' }}</td>
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
    <!-- ROW-4 END -->


@endsection
