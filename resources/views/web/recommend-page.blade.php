@extends('web.layouts.app')
@section('content')

<!-- Product Section Start -->
<div class="product-section section pt-40 pb-50">
    <div class="container">
        <div class="section-title left mb-30 mb-xs-40">
            <h1>Recommendation For You</h1>
        </div>

        <div class="shop-product-wrap grid row">




        @foreach($allrecommend_IDS as $allrecommend_ID)
            <!-- Product Item Start -->
            <?php $r_product=\App\Models\Product::find($allrecommend_ID);
            $product_rating=\App\Models\Review::where('product_id',$r_product->id)->avg('rating');?>
            <!-- Product Item Start -->
            <div class="col-xl-3 col-lg-4 col-sm-6 col-12 mb-30">
                <div class="product-item">
                    <!-- Image -->
                    <div class="product-image">
                        <!-- Image -->
                        <a href="{!! route('web.product.show',['slug'=>$r_product->product_code]) !!}" class="image"><img src="{{imageUrl('storage/'.$r_product->featured_image,230,278,100)}}" alt=""></a>
                        <!-- Product Action -->
                        <div class="product-action">
                            <a href="{{route('web.cart.add',['product_code'=>$r_product->product_code])}}" class="cart"><span></span></a>
                        </div>
                    </div>
                    <!-- Content -->
                    <div class="product-content">
                        <div class="head">
                            <!-- Title-->
                            <div class="top">
                                <h4 class="title"><a href="{!! route('web.product.show',['slug'=>$r_product->product_code]) !!}">{{$r_product->title}}</a></h4>
                            </div>
                            <!-- Price & Ratting -->
                            <div class="bottom">
                                <span class="price">Rs.{!! $r_product->price !!}</span>
                                <span class="ratting">
                                               @for($x = 5; $x > 0; $x--)
                                        @php
                                            if($product_rating > 0.5){
                                                echo ' <i class="fa fa-star"></i>';
                                            }elseif($product_rating <= 0 ){
                                                echo '<i class="fa fa-star-o"></i>';
                                            }else{
                                                echo '<i class="fa fa-star-half-o"></i>';
                                            }
                                            $product_rating--;
                                        @endphp
                                    @endfor
                                            </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- Product Item End -->
        @endforeach





        </div>

        <div class="row mt-20">
            <div class="col">

                {!! $allrecommend_IDS->links()!!}

            </div>
        </div>

    </div>
</div><!-- Product Section End -->
@endsection
