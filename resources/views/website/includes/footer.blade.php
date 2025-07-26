<footer class="" style="background-color: #8eb4f4">
    <section class="section-padding footer-mid">
        <div class="container pt-15 pb-20">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="widget-about font-md mb-md-5 mb-lg-0">
                        <div class="logo logo-width-1 wow fadeIn animated">
                            <a class="" href="{{route('home')}}">
                                @if(!isset($setting->logo_png))
                                    <h4>{{$setting->company_name}}</h4>
                                @else
                                    <img src="{{asset($setting->logo_png)}}" alt="{{$setting->company_name}}">
                                @endif
                            </a>
                        </div>
                        <h5 class="mt-20 mb-10 fw-600 wow fadeIn animated ">Contact</h5>
                        <p class="wow fadeIn animated ">
                            <strong>Address: </strong>{{$setting->copany_address}}
                        </p>
                        <p class="wow fadeIn animated ">
                            <strong>Phone: </strong> {{$setting->support_phone}}
                        </p>
                        <p class="wow fadeIn animated ">
                            <strong>Hours: </strong>{{$setting->office_hour}}
                        </p>
                        <h5 class="mb-10 mt-30 fw-600  wow fadeIn animated">Follow Us</h5>
                        <div class="mobile-social-icon wow fadeIn animated mb-sm-5 mb-md-0">
                            <a class="" href="{{$setting->facebook_url}}"><img src="{{asset('/')}}website/assets/imgs/theme/icons/icon-facebook.svg" alt=""></a>
                            <a href="{{$setting->twitter_link}}"><img src="{{asset('/')}}website/assets/imgs/theme/icons/icon-twitter.svg" alt=""></a>
                            <a href="{{$setting->instagram_link}}"><img src="{{asset('/')}}website/assets/imgs/theme/icons/icon-instagram.svg" alt=""></a>
                            <a href="{{$setting->linkedin_link}}"><img src="{{asset('/')}}website/assets/imgs/theme/icons/linkedin.png" alt=""></a>
                            <a href="{{$setting->youtube_link}}"><img src="{{asset('/')}}website/assets/imgs/theme/icons/icon-youtube.svg" alt=""></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3">
                    <h5 class="widget-title wow fadeIn animated">About</h5>
                    <ul class="footer-list wow fadeIn animated mb-sm-5 mb-md-0">
                    
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Contact Us</a></li>
                        <li><a href="#">Support Center</a></li>
                    </ul>
                </div>
                <div class="col-lg-2  col-md-3">
                    <h5 class="widget-title wow fadeIn animated">My Account</h5>
                    <ul class="footer-list wow fadeIn animated">
                        <li><a href="#">Sign In</a></li>
                        <li><a href="#">View Cart</a></li>
                        <li><a href="#">My Wishlist</a></li>
                        <li><a href="#">Track My Order</a></li>
                        <li><a href="#">Help</a></li>
{{--                        <li><a href="{{route('vendor-login-register')}}">Vendor Sign In</a></li>--}}
                    </ul>
                </div>
                <div class="col-lg-4">
                    <h5 class="widget-title wow fadeIn animated">Install App</h5>
                    <div class="row">
                        <div class="col-md-8 col-lg-12">
                            <p class="wow fadeIn animated">From App Store or Google Play</p>
                            <div class="download-app wow fadeIn animated">
                                <a href="{{$setting->ios_app_url}}" class="hover-up mb-sm-4 mb-lg-0"><img class="active" src="{{asset($setting->ios_app_image)}}" alt=""></a>
                                <a href="{{$setting->android_app_url}}" class="hover-up"><img src="{{asset($setting->android_app_image)}}" alt=""></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container pt-15 pb-2">
            <img class="wow fadeIn animated" src="{{asset($setting->payment_method_image)}}" alt="">
        </div>
    </section>
    <div class="container pb-20 wow fadeIn animated">
        <div class="row">
            <div class="col-12 mb-20">
                <div class="footer-bottom"></div>
            </div>
            <div class="col-lg-6">
                <p class="float-md-left font-sm text-muted mb-0">&copy; {{date('Y')}}, <strong class="text-brand"> {{$setting->company_name}} </strong> </p>
            </div>
            <div class="col-lg-6">
                <p class="text-lg-end text-start font-sm text-muted mb-0">
                    Designed by <a href="{{route('home')}}" target="_blank">  {{$setting->company_name}}  </a>. All rights reserved
                </p>
            </div>
        </div>
    </div>
</footer>


<!-- Preloader Start -->
<div id="preloader-active">
    <div class="preloader d-flex align-items-center justify-content-center">
        <div class="preloader-inner position-relative">
            <div class="text-center">
                <h5 class="mb-10">Now Loading</h5>
                <div class="loader">
                    <div class="bar bar1"></div>
                    <div class="bar bar2"></div>
                    <div class="bar bar3"></div>
                </div>
            </div>
        </div>
    </div>
</div>

