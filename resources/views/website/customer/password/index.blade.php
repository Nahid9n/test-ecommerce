@extends('website.master')
@section('title','Customer Password')
@section('body')
    <section class="mt-2 mb-50">
        <div class="container p-2" style="background-color: #000000">
            @include('website.customer.layout.sidebar')
            <div class="row table-responsive" style="margin-right: 0; margin-left: 0; --bs-gutter-x: 0;">
                <div class="card bg-transparent text-white">
                    <div class="card-header text-center">
                        <h5>CHANGE PASSWORD</h5>
                    </div>
                    <div class="card-body text-white">
                        <form method="post" action="{{ route('customer.password.change' , auth()->user()->id) }}" name="enq">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="form-group col-md-12 my-2">
                                    <label class="my-2">Current Password <span class="text-danger">*</span></label>
                                    <input class="form-control square text-white bg-transparent" name="old_password" type="password" autocomplete="off" placeholder="current password" required>
                                </div>
                                <div class="form-group col-md-12 my-2">
                                    <label class="my-2">New Password <span class="text-danger">*</span></label>
                                    <input class="form-control square text-white bg-transparent" name="new_password" type="password" placeholder="new password" required>
                                </div>
                                <div class="form-group col-md-12 my-2">
                                    <label class="my-2">Confirm New Password <span class="text-danger">*</span></label>
                                    <input class="form-control square text-white bg-transparent" name="confirm_password" type="password" placeholder="confirm new password" required>
                                </div>
                                <div class="col-md-12 my-3">
                                    <button type="submit" onclick="return confirm('are you sure to change password ?')" class="btn btn-success px-5 submit">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

