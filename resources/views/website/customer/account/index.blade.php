@extends('website.master')
@section('title','Customer Account Details')
@section('body')
    <section class="mt-2 mb-50">
        <div class="container p-2" style="background-color: #000000">
            @include('website.customer.layout.sidebar')
            <div class="row text-white"  style="margin-right: 0; margin-left: 0; --bs-gutter-x: 0;">
                <div class="card" style="background-color: #080101">
                    <div class="card-header text-center">
                        <h5 class="text-uppercase">Account Details</h5>
                    </div>
                    <div class="card-body p-0 m-0 pb-2">
                        <form method="post" action="{{ route('update.customer.info' , auth()->user()->id) }}" name="enq" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row p-0 m-0">
                                <div class="form-group col-md-12 text-center">
                                    <img style=" max-width: 200px; width: 100%; height: auto;" src="{{ asset($customer->image) }}" alt="">
                                    <input class="text-white bg-transparent" name="image" type="file">
                                    <input name="old_image" value="{{ $customer->image }}" type="hidden">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Display Name</label>
                                    <input class="form-control square bg-transparent text-white" name="name" type="text" value="{{ auth()->user()->name }}">
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Phone</label>
                                    <input class="form-control square bg-transparent text-white" name="mobile" type="number" min="0" value="{{ $customer->mobile }}">
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Company</label>
                                    <input class="form-control square bg-transparent text-white" name="company" type="text" value="{{ $customer->company }}">
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Address</label>
                                    <textarea class="form-control bg-transparent square text-white" name="address" id="" cols="30" rows="5">{{ $customer->address }}</textarea>
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Gender</label>
                                    <select class="form-control bg-transparent text-white square" name="gender">
                                        <option class="text-dark" value="">Select</option>
                                        <option class="text-dark" value="Male" {{$customer->gender == 'Male' ? 'selected' : ''}}>Male</option>
                                        <option class="text-dark" value="Female" {{$customer->gender == 'Female' ? 'selected' : ''}}>Female</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>marital status</label>
                                    <select class="form-control square bg-transparent text-white" name="marital_status">
                                        <option class="text-dark" value="">Select</option>
                                        <option class="text-dark" value="1" {{$customer->marital_status == '1' ? 'selected' : ''}}>Single</option>
                                        <option class="text-dark" value="2" {{$customer->marital_status == '2' ? 'selected' : ''}}>Married</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Blood Group</label>
                                    <select class="form-control square bg-transparent text-white" name="blood_group">
                                        <option class="text-dark" value="">Select</option>
                                        <option class="text-dark" value="A+" {{$customer->blood_group == 'A+' ? 'selected' : ''}}>A+</option>
                                        <option class="text-dark" value="A-" {{$customer->blood_group == 'A-' ? 'selected' : ''}}>A-</option>
                                        <option class="text-dark" value="B+" {{$customer->blood_group == 'B+' ? 'selected' : ''}}>B+</option>
                                        <option class="text-dark" value="B-" {{$customer->blood_group == 'B-' ? 'selected' : ''}}>B-</option>
                                        <option class="text-dark" value="O+" {{$customer->blood_group == 'O+' ? 'selected' : ''}}>O+</option>
                                        <option class="text-dark" value="O-" {{$customer->blood_group == 'O-' ? 'selected' : ''}}>O-</option>
                                        <option class="text-dark" value="AB+" {{$customer->blood_group == 'AB+' ? 'selected' : ''}}>AB+</option>
                                        <option class="text-dark" value="AB-" {{$customer->blood_group == 'AB-' ? 'selected' : ''}}>AB-</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label>State</label>
                                    <input class="form-control square bg-transparent text-white" name="state" type="text" value="{{ $customer->state }}">
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Post</label>
                                    <input class="form-control square bg-transparent text-white" name="post" type="number" value="{{ $customer->post }}">
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Country</label>
                                    <input class="form-control square bg-transparent text-white" name="country" type="text" value="{{ $customer->country }}">
                                </div>

                                <div class="form-group col-md-6">
                                    <label>SSN</label>
                                    <input class="form-control square bg-transparent text-white" name="ssn" type="text" value="{{ $customer->ssn }}">
                                </div>

                                <div class="form-group col-md-6">
                                    <label>City</label>
                                    <input class="form-control square bg-transparent text-white" name="city" type="text" value="{{ $customer->city }}">
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Email Address</label>
                                    <input class="form-control square bg-transparent text-white" name="email" type="email" value="{{ auth()->user()->email }}" readonly>
                                </div>

                                <div class="form-group col-md-6">
                                    <label>website Address</label>
                                    <input class="form-control square bg-transparent text-white" name="website" type="url" value="{{ $customer->website }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>facebook</label>
                                    <input class="form-control square bg-transparent text-white" name="facebook" type="url" value="{{ $customer->facebook }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>linkedIn</label>
                                    <input class="form-control square bg-transparent text-white" name="linkedIn" type="url" value="{{ $customer->linkedIn }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>twitter</label>
                                    <input class="form-control square bg-transparent text-white" name="twitter" type="url" value="{{ $customer->twitter }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>youtube</label>
                                    <input class="form-control square bg-transparent text-white" name="youtube" type="url" value="{{ $customer->youtube }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>instagram</label>
                                    <input class="form-control square bg-transparent text-white" name="instagram" type="url" value="{{ $customer->instagram }}">
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Date of Birth</label>
                                    <input class="form-control square bg-transparent text-white" name="dob" type="date" value="{{ $customer->date_of_birth }}">
                                </div>

                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-fill-out submit">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

