@extends('web.layouts.app1')
@section('title')
    My Products
@endsection
@section('styles')
    <style>
        .top a{
            padding-left: 28px;
            padding-right: 16px;
        }
    </style>
    @endsection
@section('content')
    <div class="col-lg-9 col-12 mb-30">
        <div class="myaccount-content">
        @if(isset($approved_products))
            <!-- Shop Toolbar Start -->
                <div class="row">
                    <div class="col">
                        <div class="shop-toolbar">
                            <div class="product-showing mr-auto">
                                <h3 style="margin-left: 20px;">Your Products</h3>
                            </div>
                        </div>
                    </div>
                </div><!-- Shop Toolbar End -->



                <div class="shop-product-wrap grid row">

                @foreach($approved_products as $product)
                    <?php  $product_rating=\App\Models\Review::where('product_id',$product->id)->avg('rating');?>
                    <!-- Product Item Start -->
                        <div class="col-xl-4 col-sm-6 col-12 mb-30">
                            <div class="product-item grid">
                                <!-- Image -->
                                <div class="product-image">
                                    <!-- Image -->
                                    <a href="{!! route('web.product.show',['slug'=>$product->product_code]) !!}" class="image"><img src="{{imageUrl('storage/'.$product->featured_image,230,278,100)}}" alt=""></a>


                                    @if($product->status==3)
                                    <!-- Product Action -->
                                    <div class="product-action">
                                        <a href="{{route('web.cart.add',['product_code'=>$product->product_code])}}" class="cart"><span></span></a>
                                        <a href="#" class="wishlist"><span></span></a>
                                        <a href="#" class="quickview"><span></span></a>
                                    </div>
                                        @endif
                                </div>
                                <!-- Content -->
                                <div class="product-content">
                                    <div class="head">
                                        <!-- Title-->
                                        <div class="top">
                                            <h4 class="title"><a href="{!! route('web.product.show',['slug'=>$product->product_code]) !!}">{!! $product->title !!}</a> @if($product->status==4)(Sold Out)@endif</h4>
                                        </div>
                                        <!-- Price & Ratting -->
                                        <div class="bottom">
                                            <span class="price">Rs.{!! $product->price !!}</span>
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

                        {!! $approved_products->links()!!}

                    </div>
                </div>



            @else
                <div class="shop-product-wrap list row">
                    <h2>No magazines</h2>
                </div>
            @endif
    </div>
    </div>

@endsection
@section('scripts')
    <script>
        $('.delete').click(function (e) {
            e.preventDefault();
            url = $(this).attr('href');

            if(confirm('Confirm delete')){
                location.href = url;
            }

        });
        $('.send_r').click(function (e) {
            e.preventDefault();
            url = $(this).attr('href');

            if(confirm('Do u really want to send request?')){
                location.href = url;
            }

        });
    </script>
    @endsection
