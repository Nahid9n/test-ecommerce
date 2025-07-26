@extends('website.master')

@section('title','Customer Login Register')

@section('body')


    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="" rel="nofollow">Home</a>
                <span></span> Pages
                <span></span> Login / Register
            </div>
        </div>
    </div>
    <section class="pt-150 pb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 m-auto">
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="login_wrap widget-taber-content p-30 background-white border-radius-10 mb-md-5 mb-lg-0 mb-sm-5">
                                <div class="padding_eight_all bg-white">
                                    <div class="heading_s1">
                                        <h3 class="mb-30">Login</h3>
                                    </div>

                                    <p class="text-center text-danger">
                                        {{ session('message') }}
                                    </p>

                                    <form method="post" action="{{ route('login-check') }}">
                                        @csrf
                                        <div class="form-group">
{{--                                            This line is very Important And DANGER--}}
                                            <input type="text" required="" name="email" placeholder="Your Email Address">
                                        </div>
                                        <div class="form-group">
                                            <input required="" type="password" name="password" placeholder="Password">
                                        </div>
                                        <div class="login_footer form-group">
                                            <div class="chek-form">
                                                <div class="custome-checkbox">
                                                    <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox1" value="">
                                                    <label class="form-check-label" for="exampleCheckbox1"><span>Remember me</span></label>
                                                </div>
                                            </div>
                                            <a class="text-muted" href="#">Forgot password?</a>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-fill-out btn-block hover-up" name="login">Log in</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-1"></div>
                        <div class="col-lg-6">
                            <div class="login_wrap widget-taber-content p-30 background-white border-radius-5">
                                <div class="padding_eight_all bg-white">
                                    <div class="heading_s1">
                                        <h3 class="mb-30">Create an Account</h3>
                                    </div>
                                    <form method="post" action="{{ route('new-customer') }}">
                                        @csrf
                                        <div class="form-group">
                                            <input type="text" required name="name" placeholder="Full Name *">
                                        </div>
                                        <div class="form-group">
                                            <input type="email" name="email" placeholder="Email Address">
                                        </div>
                                        <div class="form-group">
                                            <input type="number" required name="mobile" placeholder="Mobile Number *">
                                        </div>
                                        <div class="form-group">
                                            <input required="" type="password" name="password" placeholder="Password *">
                                        </div>
                                        <input type="hidden" name="role" value="customer" readonly>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-fill-out btn-block hover-up" name="login">Submit &amp; Register</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



@endsection
