@extends('website.master')
@section('title','Customer Address Dashboard')
@section('body')
    <section class="mt-2 mb-50">
        <div class="container p-2" style="background-color: #000000">
            @include('website.customer.layout.sidebar')
            <div class="row" style="margin-right: 0; margin-left: 0; --bs-gutter-x: 0;">
                <div class="card bg-transparent text-white">
                    <div class="card-header text-center">
                        <h5>YOUR ADDRESSES</h5>
                    </div>
                    <div class="card-body text-white">
                        <div class="row">
                            <div class="d-grid justify-content-end">
                                <button class="btn btn-sm" data-bs-target="#addressAdd" data-bs-toggle="modal"><i class="fa fa-plus"></i> Add Address</button>
                            </div>
                            <div class="col-md-12 table-responsive">
                                <table id="basic-datatable" class="" style="">
                                        <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Type</th>
                                            <th>Name</th>
                                            <th>Number</th>
                                            <th>Zip</th>
                                            <th>Address</th>
                                            <th>City</th>
                                            <th>Area</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($addresses as $key => $address)
                                            <tr class="">
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$address->type}}</td>
                                                <td>{{$address->customer_name}}</td>
                                                <td>{{$address->number}}</td>
                                                <td>{{$address->zip}}</td>
                                                <td>{{ $address->address }}</td>
                                                <td>{{$address->district->name }}</td>
                                                <td>{{ $address->place->name }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <a class="mx-2 d-block text-white" data-bs-target="#addressEdit{{$key}}" data-bs-toggle="modal" href=""><i class="fi-rs-edit text-success"></i></a>
                                                        <form action="{{ route('customer.address.destroy',$address->id) }}" method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button onclick="return confirm('Are You Sure To Delete ?')" class="bg-transparent" style="border: none"><i class="fi-rs-trash text-danger"></i></button>
                                                        </form>
                                                    </div>

                                                </td>
                                            </tr>
                                            <div  class="modal fade" id="addressEdit{{$key}}" tabindex="-1" aria-labelledby="onloadModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-md">
                                                    <div class="modal-content">
                                                        <div class="d-grid justify-content-end">
                                                            <button type="button" class="btn-close float-end p-2" id="close-popup" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <h5 class="my-2 text-center">EDIT ADDRESS</h5>
                                                            <hr class="text-black" style="border: 1px solid black">
                                                            <form action="{{route('customer.address.update',$address->id)}}" method="post" class="" id="">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="mb-15">
                                                                    <label class="text-dark" for="">Address Type <span class="text-danger">*</span></label>
                                                                    <select class="form-control border-1" style="border: 1px solid black;" name="type" id="" required>
                                                                        <option disabled value="">Select Address Type</option>
                                                                        <option {{$address->type == 'home' ? 'selected':''}} value="home">Home</option>
                                                                        <option {{$address->type == 'office' ? 'selected':''}} value="office">Office</option>
                                                                    </select>
                                                                </div>
                                                                <div class="mb-15">
                                                                    <label class="text-dark" for="">Name <span class="text-danger">*</span></label>
                                                                    <input type="text" name="customer_name" value="{{$address->customer_name}}" class="form-control" style="border: 1px solid black;" required placeholder="Customer Name">
                                                                </div>
                                                                <div class="mb-15">
                                                                    <label class="text-dark" for="">Phone Number</label>
                                                                    <input type="text" name="number" class="form-control" value="{{$address->number}}" style="border: 1px solid black;" placeholder="Customer Phone Number">
                                                                </div>
                                                                <div class="mb-15">
                                                                    <label class="text-dark" for="">Zip</label>
                                                                    <input type="number" name="zip" class="form-control" value="{{$address->zip}}" style="border: 1px solid black;" placeholder="Zip">
                                                                </div>
                                                                <div class="mb-15">
                                                                    <label class="text-dark" for="">Address</label>
                                                                    <input type="text" name="address" class="form-control" value="{{$address->address}}" style="border: 1px solid black;" placeholder="House No , Road , Area ,Landmark">
                                                                </div>
                                                                <div class="mb-15">
                                                                    <label class="text-dark" for="">Select City/District <span class="text-danger">*</span></label>
                                                                    <select class="form-control border-1 district" style="border: 1px solid black;" name="city" id="" required>
                                                                        <option disabled  value=""> Select City/District </option>
                                                                        @foreach($districts as $district)
                                                                            <option {{$district->id == $address->city ? 'selected':''}} value="{{$district->id}}">{{$district->name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="mb-15">
                                                                    <label class="text-dark" for="">Select Area <span class="text-danger">*</span></label>
                                                                    <select class="form-control border-1 area" style="border: 1px solid black;" name="area" id="" required>
                                                                        <option disabled value="">Select Area</option>
                                                                        @foreach($areas as $area)
                                                                            <option {{$area->id == $address->area ? 'selected':''}} value="{{$area->id}}">{{$area->name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <button aria-label="" class="btn btn-success mx-1 my-2 rounded-3">Save</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        </tbody>
                                    </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div  class="modal fade" id="addressAdd" tabindex="-1" aria-labelledby="onloadModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="d-grid justify-content-end">
                    <button type="button" class="btn-close float-end p-2" id="close-popup" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5 class="my-2 text-center">CREATE NEW ADDRESS</h5>
                    <hr class="text-black" style="border: 1px solid black">
                    <form action="{{route('customer.address.store')}}" method="post" class="" id="">
                        @csrf
                        <div class="mb-15">
                            <label class="text-dark" for="">Address Type <span class="text-danger">*</span></label>
                            <select class="form-control border-1" style="border: 1px solid black;" name="type" id="" required>
                                <option disabled selected value="">Select Address Type</option>
                                <option value="home">Home</option>
                                <option value="office">Office</option>
                            </select>
                        </div>
                        <div class="mb-15">
                            <label class="text-dark" for="">Name <span class="text-danger">*</span></label>
                            <input type="text" name="customer_name" class="form-control" style="border: 1px solid black;" placeholder="Customer Name" required>
                        </div>
                        <div class="mb-15">
                            <label class="text-dark" for="">Phone Number</label>
                            <input type="text" name="number" class="form-control" style="border: 1px solid black;" placeholder="Customer Phone Number">
                        </div>
                        <div class="mb-15">
                            <label class="text-dark" for="">Zip</label>
                            <input type="number" name="zip" class="form-control" style="border: 1px solid black;" placeholder="Zip">
                        </div>
                        <div class="mb-15">
                            <label class="text-dark" for="">Address</label>
                            <input type="text" name="address" class="form-control" style="border: 1px solid black;" placeholder="House No , Road , Area ,Landmark">
                        </div>
                        <div class="mb-15">
                            <label class="text-dark" for="">Select City/District <span class="text-danger">*</span></label>
                            <select class="form-control border-1 district" style="border: 1px solid black;" name="city" id="" required>
                                <option disabled selected value=""> Select City/District </option>
                                @foreach($districts as $district)
                                <option value="{{$district->id}}">{{$district->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-15">
                            <label class="text-dark" for="">Select Area <span class="text-danger">*</span></label>
                            <select class="form-control border-1 area" style="border: 1px solid black;" name="area" id="" required>
                                <option disabled selected value="">Select Area</option>
                            </select>
                        </div>
                        <button aria-label="" class="btn btn-success mx-1 my-2 rounded-3">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function () {
            $('.district').on('change', function () {
                let districtId = $(this).val();
                if (districtId) {
                    $.ajax({
                        url: `/district/${districtId}/areas`,
                        type: 'GET',
                        success: function (response) {
                            if (response.success) {
                                let areaOptions = '<option value="">Select Area</option>';
                                response.data.forEach(function (area) {
                                    areaOptions += `<option value="${area.id}">${area.name}</option>`;
                                });
                                $('.area').html(areaOptions);
                            }
                        },
                        error: function () {
                            alert('Error fetching areas. Please try again.');
                        }
                    });
                } else {
                    $('.area').html('<option value="">Select Area</option>');
                }
            });
        });
    </script>
@endpush
