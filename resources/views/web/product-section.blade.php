{{--<!-- Product Section Start -->--}}
{{--<div class="product-section section pb-90 pb-lg-80 pb-md-70 pb-sm-60 pb-xs-50">--}}
    {{--<div class="container">--}}

        {{--<!-- Section Title Start -->--}}
        {{--<div class="row">--}}
            {{--<div class="col">--}}
                {{--<div class="section-title left mb-60 mb-xs-40">--}}
                    {{--<h1>New Arrivals</h1>--}}
                    {{--<p>Some of our customer say’s that they trust us and buy our product without any hagitation because they belive us and always happy to buy our product.</p>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div><!-- Section Title End -->--}}

        {{--<div class="row">--}}

            {{--<!-- Product Slider 4 Column Start-->--}}
            {{--<div class="product-slider product-slider-4 section">--}}

                {{--@foreach($allrecommend_IDS as $allrecommend_ID)--}}
                {{--<!-- Product Item Start -->--}}
                {{--<?php $r_product=\App\Models\Product::find($allrecommend_ID); ?>--}}
                {{--<div class="col">--}}
                    {{--<div class="product-item">--}}
                        {{--<!-- Image -->--}}
                        {{--<div class="product-image">--}}
                            {{--<!-- Image -->--}}
                            {{--<a href="{!! route('web.product.show',['slug'=>$r_product->product_code]) !!}" class="image"><img src="{{imageUrl('storage/'.$r_product->featured_image,230,278,100)}}" alt=""></a>--}}
                            {{--<!-- Product Action -->--}}
                            {{--<div class="product-action">--}}
                                {{--<a href="#" class="cart"><span></span></a>--}}
                                {{--<a href="#" class="wishlist"><span></span></a>--}}
                                {{--<a href="#" class="quickview"><span></span></a>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<!-- Content -->--}}
                        {{--<div class="product-content">--}}
                            {{--<div class="head">--}}
                                {{--<!-- Title -->--}}
                                {{--<div class="top">--}}
                                    {{--<h4 class="title"><a href="#">{!! $r_product->title !!}</a></h4>--}}
                                {{--</div>--}}
                                {{--<!-- Price & Ratting -->--}}
                                {{--<div class="bottom">--}}
                                    {{--<span class="price">${!! $r_product->price !!} <span class="old">$65</span></span>--}}
                                    {{--<span class="ratting">--}}
                                            {{--<i class="fa fa-star"></i>--}}
                                            {{--<i class="fa fa-star"></i>--}}
                                            {{--<i class="fa fa-star"></i>--}}
                                            {{--<i class="fa fa-star"></i>--}}
                                            {{--<i class="fa fa-star"></i>--}}
                                        {{--</span>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div><!-- Product Item End -->--}}
                {{--@endforeach--}}

            {{--</div><!-- Product Slider 4 Column Start-->--}}

        {{--</div>--}}

    {{--</div>--}}
{{--</div><!-- Product Section End -->--}}
