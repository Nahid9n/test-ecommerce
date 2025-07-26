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
                            <h3 class="mb-2 text-black fw-semibold">৳ {{$totalSale ?? 0}}</h3>
                            <p class="fs-13 fw-semibold text-black mb-0">Total Sale</p>
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
                            <h3 class="mb-2 text-black fw-semibold">৳ {{$todaySale ?? 0}}</h3>
                            <p class="fs-13 fw-semibold text-black mb-0">Today's Sale</p>
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
            <div class="card overflow-hidden" style="background-color: #b1aaaa">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h3 class="mb-2 text-black fw-semibold">{{$todayOrder ?? 0}}</h3>
                            <p class="text-black fw-semibold fs-13 mb-0">Today's Order</p>
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
            <div class="card overflow-hidden" style="background-color: #f08d2f">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h3 class="mb-2  text-black fw-semibold">{{$yesterdayOrders ?? 0}}</h3>
                            <p class=" text-black fw-semibold fs-13 mb-0">Yesterday's Orders</p>
                        </div>
                        <div class="col col-auto top-icn dash">
                            <div class="counter-icon bg-secondary dash ms-auto box-shadow-primary">
                                <i class="fa fa-user-circle-o"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12 col-md-6 col-xl-3">
            <div class="card overflow-hidden" style="background-color: #7ab788">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h3 class="mb-2 text-black fw-semibold">{{$WeeklyOrders ?? 0}}</h3>
                            <p class="text-black fw-semibold fs-13 mb-0">Weekly Order</p>
                        </div>
                        <div class="col col-auto top-icn dash">
                            <div class="counter-icon bg-success dash ms-auto box-shadow-primary">
                                <i class="fa fa-compass"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12 col-md-6 col-xl-3">
            <div class="card overflow-hidden" style="background-color: #06c8f5">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h3 class="mb-2 text-black fw-semibold">{{$monthlyOrder ?? 0}}</h3>
                            <p class="text-black fw-semibold fs-13 mb-0">Order This Month</p>
                        </div>
                        <div class="col col-auto top-icn dash">
                            <div class="counter-icon bg-success dash ms-auto box-shadow-primary">
                                <i class="fa fa-compass"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12 col-md-6 col-xl-3">
            <div class="card overflow-hidden" style="background-color: #59cdc8">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h3 class="mb-2 text-black fw-semibold">{{$totalOrder ?? 0}}</h3>
                            <p class=" text-black fw-semibold fs-13 mb-0">Total Order</p>
                        </div>
                        <div class="col col-auto top-icn dash">
                            <div class="counter-icon bg-secondary dash ms-auto box-shadow-primary">
                                <i class="fa fa-user-circle-o"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12 col-md-6 col-xl-3">
            <div class="card overflow-hidden" style="background-color: #ed91c7">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h3 class="mb-2  text-black fw-semibold">{{$customer ?? 0}}</h3>
                            <p class=" text-black fw-semibold fs-13 mb-0">Total Customer</p>
                        </div>
                        <div class="col col-auto top-icn dash">
                            <div class="counter-icon bg-secondary dash ms-auto box-shadow-primary">
                                <i class="fa fa-user-circle-o"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-sm-12 col-md-6 col-xl-3">
            <div class="card overflow-hidden" style="background-color: #8ef3de">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h3 class="mb-2 text-black fw-semibold">{{$totalStockOutProduct ?? 0}}</h3>
                            <p class=" text-black fw-semibold fs-13 mb-0">Stock Out Products</p>
                        </div>
                        <div class="col col-auto top-icn dash">
                            <div class="counter-icon bg-secondary dash ms-auto box-shadow-primary">
                                <i class="fa fa-user-circle-o"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12 col-md-6 col-xl-3">
            <div class="card overflow-hidden" style="background-color: #f45555">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h3 class="mb-2  text-black fw-semibold">{{$totalAlertProduct ?? 0}}</h3>
                            <p class=" text-black fw-semibold fs-13 mb-0">Alert Product Number</p>
                        </div>
                        <div class="col col-auto top-icn dash">
                            <div class="counter-icon bg-secondary dash ms-auto box-shadow-primary">
                                <i class="fa fa-user-circle-o"></i>
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
                    <h3 class="card-title mb-0">New Orders List</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="data-table" class="table text-nowrap mb-0 table-bordered">
                            <thead class="table-head">
                            <tr>
                                <th class="bg-transparent border-bottom-0 wp-15">Order No</th>
                                <th class="bg-transparent border-bottom-0">Customer</th>
                                <th class="bg-transparent border-bottom-0">Status</th>
                                <th class="bg-transparent border-bottom-0">Payment</th>
                                <th class="bg-transparent border-bottom-0">Total Amount</th>
                                <th class="bg-transparent border-bottom-0 no-btn">Action</th>
                            </tr>
                            </thead>
                            <tbody class="table-body">
                            @forelse($pendingOrders as $order)
                                <tr>
                                    <td class="fs-14 fw-semibold"><a href="{{route('order.show', $order->id)}}" class="text-dark" ># {{$order->order_code}}</a></td>
                                    <td>
                                    <div class="d-flex align-items-center">
                                        <div class="user-details ms-2">
                                            <h6 class="mb-0">{{ isset($order->customer->name) ? $order->customer->name: ''}}</h6>
                                            <span class="fs-12">{{ isset($order->customer->mobile) ? $order->customer->mobile: ''}}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="fs-13 fw-semibold">{{ $order->order_status }}</td>
                                <td class="fs-14 fw-semibold">{{ $order->payment_status == 'Complete' ? 'Paid':'Unpaid' }}</td>
                                <td>{{$order->order_total}}</td>
                                <td>
                                    <div class="d-flex align-items-stretch">
                                        <a href="{{route('order.show', $order->id)}}" class="btn btn-info btn-sm float-start m-1" title="View Order Detail">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a href="{{route('order.edit', $order->id)}}" class="btn btn-success btn-sm float-start m-1 {{ $order->order_status == 'Complete' ? 'disabled' : '' }}" title="Order Edit">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <form action="{{ route('order.destroy',$order->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm float-start m-1" {{ $order->order_status == 'Complete' ? 'disabled' : '' }}
                                            onclick="return confirm('Are you want to delete this !!!')">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td>

                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div><!-- COL END -->
    </div>
    <!-- ROW-4 END -->


@endsection
