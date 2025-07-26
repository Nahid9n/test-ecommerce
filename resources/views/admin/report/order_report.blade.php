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
        <div class="row g-3 mb-3">
            <form method="GET" target="_blank" action="{{ route('admin.order.report.show') }}">
                <div class="card ">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="start_date">Start Date:</label>
                                <input type="date" name="start_date" id="start_date" value="{{ old('start_date') }}">
                            </div>
                            <div class="col-md-4">
                                <label for="end_date">End Date:</label>
                                <input type="date" name="end_date" id="end_date" value="{{ old('end_date') }}">
                            </div>
                            <div class="col-md-4">
                                <label for="end_date">Product</label>
                                <select class="form-control-sm" name="product_id">
                                    <option value="">Select Product</option>
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}">{{  $product->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>

                    </div>
                </div>
                <div class="my-3 text-center">
                    <button class="form-control-lg text-white bg-dark px-3"  type="submit">Generate Report</button>
                </div>
            </form>
    </div>
@endsection
