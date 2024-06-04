<footer class="main">
        <section class="section-padding footer-mid">
            <div class="container pt-15 pb-20">
                <div class="row">
                    <div class="col">
                        <div class="widget-about font-md mb-md-3 mb-lg-3 mb-xl-0 wow animate__animated animate__fadeInUp" data-wow-delay="0">
                            <div class="logo mb-30">
                                <a href="index.html" class="mb-15"><img src="{{ asset('frontend/assets/imgs/theme/logo.png') }}" alt="logo" /></a>
                            </div>
                        </div>
                    </div>
                    <div class="footer-link-widget col wow animate__animated animate__fadeInUp" data-wow-delay=".2s">
                        <h4 class="widget-title">Account</h4>
                        <ul class="footer-list mb-sm-5 mb-md-0">
                            <li><a href="{{route('login')}}">Sign In</a></li>
                            <li><a href="{{ route('mycart') }}">View Cart</a></li>
                            <li><a href="{{ route('wishlist') }}">My Wishlist</a></li>
                            <li><a href="{{route('user.track.order')}}">Track My Order</a></li>
                        </ul>
                    </div>
                    <div class="footer-link-widget col wow animate__animated animate__fadeInUp" data-wow-delay=".3s">
                        <h4 class="widget-title">Corporate</h4>
                        <ul class="footer-list mb-sm-5 mb-md-0">
                            <li><a href="{{route('become.vendor')}}">Become a Vendor</a></li>
                        </ul>
                    </div>

                </div>
        </section>
        <div class="container pb-30 wow animate__animated animate__fadeInUp" data-wow-delay="0">
            <div class="row align-items-center">
                <div class="col-12 mb-30">
                    <div class="footer-bottom"></div>
                </div>
                <div class="col-xl-4 col-lg-6 text-center d-none d-xl-block">
                </div>
            </div>
        </div>
    </footer>