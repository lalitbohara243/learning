@extends('web.layouts.app')


@section('content')
<!-- Hero Section Start -->
<div class="hero-slider section">
    <!-- Hero Item Start -->
    <div class="hero-item" style="background-image: url(assets/images/slider/slider-bg-1.jpg)">
        <div class="container">
            <div class="row">

                <div class="hero-content-wrap col">
                    <div class="hero-content text-center">
                        <h2>BEARD OIL</h2>
                        <h1>FOR GLOSSY AND <br>STYLISH BEARD</h1>
                        <a class="btn btn-round btn-lg btn-theme" href="shop-4-column.html">SHOP NOW</a>
                    </div>
                    <div class="hero-image">
                        <img src="assets/images/slider/slider-product-1.png" alt="">
                    </div>
                </div>

            </div>
        </div>
    </div><!-- Hero Item End -->
    <!-- Hero Item Start -->
    <div class="hero-item" style="background-image: url(assets/images/slider/slider-bg-1.jpg)">
        <div class="container">
            <div class="row">

                <div class="hero-content-wrap col">
                    <div class="hero-content text-center">
                        <h2>BEARD OIL</h2>
                        <h1>FOR GLOSSY AND <br>STYLISH BEARD</h1>
                        <a class="btn btn-round btn-lg btn-theme" href="shop-4-column.html">SHOP NOW</a>
                    </div>
                    <div class="hero-image">
                        <img src="assets/images/slider/slider-product-1.png" alt="">
                    </div>
                </div>

            </div>
        </div>
    </div><!-- Hero Item End -->
</div><!-- Hero Section End -->

<!-- About Section Start -->
<div class="about-section section position-relative pt-90 pb-60 pt-lg-80 pb-lg-50 pt-md-70 pb-md-40 pt-sm-60 pb-sm-30 pt-xs-50 pb-xs-20 fix">

    <!-- About Section Shape -->
    <div class="about-shape one rellax" data-rellax-speed="-5" data-rellax-percentage="0.5"><img src="assets/images/shape/about-shape-1.png" alt=""></div>
    <div class="about-shape two rellax" data-rellax-speed="3" data-rellax-percentage="0.5"><img src="assets/images/shape/about-shape-2.png" alt=""></div>

    <div class="container">
        <div class="row align-items-center">

            <!-- About Image Start -->
            <div class="col-lg-6 col-12 order-1 order-lg-2 mb-30">
                <div class="about-image masonry-grid row row-7">
                    <div class="col-6 col"><img src="assets/images/about/about-1-1.jpg" alt=""></div>
                    <div class="col-6 col"><img src="assets/images/about/about-1-2.jpg" alt=""></div>
                    <div class="col-6 col"><img src="assets/images/about/about-1-3.jpg" alt=""></div>
                    <div class="col-6 col"><img src="assets/images/about/about-1-4.jpg" alt=""></div>
                </div>
            </div><!-- About Image End -->

            <!-- About Content Start -->
            <div class="col-lg-6 col-12 mr-auto order-2 order-lg-1 mb-30">
                <div class="about-content about-content-1">
                    <h3>Provide the best</h3>
                    <h1>Beard Oil For You</h1>
                    <div class="desc">
                        <p>We provide the best Beard oil all over the worl. We are the world best store for Beard Oil. You can buy our product witho ut any hegitation because we always consus about our product quality and always maintain it properly so your can trust</p>
                        <p>Some of our customer say’s that they trust us and buy our product without any hagitation because they belive</p>
                    </div>
                    <a href="about.html" class="btn btn-lg btn-round">Learn More</a>
                </div>
            </div><!-- About Content End -->

        </div>
    </div>

</div><!-- About Section End -->

@include('web.product-section')




@endsection
