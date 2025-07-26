@extends('admin.master')
@section('title','Manage Order Page')
@section('body')

    <!-- PAGE-HEADER -->
    <div class="page-header">
        <div>
            <h1 class="page-title">Order Module</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Orders</a></li>
            </ol>
        </div>
    </div>
    <!-- PAGE-HEADER END -->

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header border-bottom">
                    <h3 class="card-title">All Order Info</h3>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table id="example3" class="table table-bordered text-nowrap border-bottom">
                            <thead>
                            <tr>
                                <th class="border-bottom-0">Order No</th>
                                <th class="border-bottom-0">Customer</th>
                                <th class="border-bottom-0 text-center">Status</th>
                                <th class="border-bottom-0">Payment Info</th>
                                <th class="border-bottom-0 text-center">Total Amount</th>
                                <th class="border-bottom-0 text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td>
                                        #<a class="text-dark fw-bold" href="{{route('order.show', $order->order_code)}}">{{ $order->order_code }}</a><br>
                                        <small class="text-muted">{{\Illuminate\Support\Carbon::parse($order->created_at)->format('d M ,Y h:i A')}}</small>
                                    </td>
                                    <td>
                                        <span class="text-dark fw-bold">{{ $order->customer->name}}</span><br>
                                        <small class="text-muted">{{ $order->customer->mobile}}</small>
                                    </td>
                                    <td class="text-center">
                                        <small class="text-dark fw-bold">{{ $order->order_status }}</small>
                                    </td>
                                    <td>
                                        <span class="fw-bold">{{ ucfirst($order->payment_method == 'Cash' ? 'Cash On Delivery':'Online') }}</span><br>
                                        <small class="{{$order->payment_status == 'Paid' ? 'text-success':'text-danger' }}">{{ ucfirst($order->payment_status)}}</small>

                                    </td>
                                    <td class="text-center">
                                        {{$order->order_total}}
                                    </td>
                                    {{--                                    <td>{{$order->status == 'Pending' ? 'Pending' : 'Complete'}}</td>--}}
                                    <td class="text-center">
                                        <a href="{{route('order.show', $order->order_code)}}" class="btn btn-info btn-sm float-start m-1" title="View Order Detail">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a href="{{route('order.invoice-show', [ 'id' => $order->id ] )}}" class="btn btn-primary btn-sm float-start m-1" title="View Order Invoice">
                                            <i class="fa fa-info"></i>
                                        </a>
                                        {{--<!-- <a href="{{route('order.invoice-download', $order->id)}}" target="_blank" class="btn btn-warning btn-sm float-start m-1" title="Download Order Invoice">
                                            <i class="fa fa-download"></i>
                                        </a> -->--}}


{{--
                                        @if($product->status ==1 )
                                            <a href="{{ route('product.show',$product->id ) }}" class="btn btn-warning btn-sm float-start m-1" > <i class="fa fa-lock"></i></a>
                                        @else
                                            <a href="{{ route('product.show',$product->id ) }}" class="btn btn-blue btn-sm float-start m-1" > <i class="fa fa-unlock"></i></a>
                                        @endif

                                       --}}

                                        <form action="{{ route('order.destroy',$order->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm float-start m-1" {{ $order->order_status == 'Complete' ? 'disabled' : '' }}
                                                    onclick="return confirm('Are you want to delete this !!!')">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>


                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
