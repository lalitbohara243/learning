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
    @if($unproducts->count()!=0)
        <!-- Shop Toolbar Start -->
            <div class="row">
                <div class="col">
                    <div class="shop-toolbar">
                        <div class="product-showing mr-auto">
                            <h3 style="margin-left: 20px;">Unapproved Product</h3>
                        </div>
                    </div>
                </div>
            </div><!-- Shop Toolbar End -->


                <div class="shop-product-wrap grid row">
                @foreach($unproducts as $unproduct)
                    <!-- Product Item Start -->
                        <div class="col-xl-4 col-sm-6 col-12 mb-30">
                            <div class="product-item grid">
                                <!-- Image -->
                                <div class="product-image">
                                    <!-- Image -->
                                    <a href="{{route('web.myproducts.edit',['slug'=>$unproduct->product_code])}}" class="image"><img src="{{imageUrl('storage/'.$unproduct->featured_image,230,278,100)}}" alt=""></a>
                                    <!-- Product Action -->
                                </div>
                                <!-- Content -->
                                <div class="product-content">
                                    <div class="head">
                                        <!-- Title-->
                                        <div class="top">
                                            <h4 class="title"><a href="{{route('web.myproducts.edit',['slug'=>$unproduct->product_code])}}">{!! $unproduct->title !!}</a></h4>
                                            <a href="{!! route('web.myproducts.send',['slug'=>$unproduct->product_code]) !!}" class="send_r"><i class="fa fa-arrow-up" title="Send Request" style="font-size: 25px;"></i></a>
                                        </div>
                                        <!-- Price & Ratting -->
                                        <div class="top">
                                            <a href="{{route('web.myproducts.edit',['slug'=>$unproduct->product_code])}}" class="cart"><i class="fa fa-edit" title="Edit"></i></a>
                                            <a href="{{route('web.myproducts.photo',['slug'=>$unproduct->product_code])}}" class="cart"><i class="fa fa-photo" title="Add Photos"></i></a>
                                            <a href="{{route('web.myproducts.destroy',['slug'=>$unproduct->product_code])}}" class="delete"><i class="fa fa-trash" title="Delete"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- Product Item End -->

                    @endforeach
                </div>
            <div class="row mt-20">
                <div class="col">

                    {!! $unproducts->links()!!}

                </div>
            </div>
            @endif
















        @if($myproducts->count()!=0)
            <!-- Shop Toolbar Start -->
                <div class="row">
                    <div class="col">
                        <div class="shop-toolbar">
                            <div class="product-showing mr-auto">
                                <h3 style="margin-left: 20px;">Your Drafts</h3>
                            </div>
                        </div>
                    </div>
                </div><!-- Shop Toolbar End -->

                @if($myproducts->count()>=3)
                <div class="product-slider product-slider-3 section">
                @foreach($myproducts as $product)
                    <!-- Product Item Start -->
                        <div class="col-xl-4 col-sm-6 col-12 mb-30">
                            <div class="product-item grid">
                                <!-- Image -->
                                <div class="product-image">
                                    <!-- Image -->
                                    <a href="{{route('web.myproducts.edit',['slug'=>$product->product_code])}}" class="image"><img src="{{imageUrl('storage/'.$product->featured_image,230,278,100)}}" alt=""></a>
                                    <!-- Product Action -->
                                </div>
                                <!-- Content -->
                                <div class="product-content">
                                    <div class="head">
                                        <!-- Title-->
                                        <div class="top">
                                            <h4 class="title"><a href="{{route('web.myproducts.edit',['slug'=>$product->product_code])}}">{!! $product->title !!}</a></h4>
                                            <a href="{!! route('web.myproducts.send',['slug'=>$product->product_code]) !!}" class="send_r"><i class="fa fa-arrow-up" title="Send Request" style="font-size: 25px;"></i></a>
                                        </div>
                                        <!-- Price & Ratting -->
                                        <div class="top">
                                            <a href="{{route('web.myproducts.edit',['slug'=>$product->product_code])}}" class="cart"><i class="fa fa-edit" title="Edit"></i></a>
                                            <a href="{{route('web.myproducts.photo',['slug'=>$product->product_code])}}" class="cart"><i class="fa fa-photo" title="Add Photos"></i></a>
                                            <a href="{{route('web.myproducts.destroy',['slug'=>$product->product_code])}}" class="delete"><i class="fa fa-trash" title="Delete"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- Product Item End -->

                    @endforeach


                </div>

                    @else
                    <div class="shop-product-wrap grid row">
                    @foreach($myproducts as $product)
                        <!-- Product Item Start -->
                            <div class="col-xl-4 col-sm-6 col-12 mb-30">
                                <div class="product-item grid">
                                    <!-- Image -->
                                    <div class="product-image">
                                        <!-- Image -->
                                        <a href="{{route('web.myproducts.edit',['slug'=>$product->product_code])}}" class="image"><img src="{{imageUrl('storage/'.$product->featured_image,230,278,100)}}" alt=""></a>
                                        <!-- Product Action -->
                                    </div>
                                    <!-- Content -->
                                    <div class="product-content">
                                        <div class="head">
                                            <!-- Title-->
                                            <div class="top">
                                                <h4 class="title"><a href="{{route('web.myproducts.edit',['slug'=>$product->product_code])}}">{!! $product->title !!}</a></h4>
                                                <a href="{!! route('web.myproducts.send',['slug'=>$product->product_code]) !!}" class="send_r"><i class="fa fa-arrow-up" title="Send Request" style="font-size: 25px;"></i></a>
                                            </div>
                                            <!-- Price & Ratting -->
                                            <div class="top">
                                                <a href="{{route('web.myproducts.edit',['slug'=>$product->product_code])}}" class="cart"><i class="fa fa-edit" title="Edit"></i></a>
                                                <a href="{{route('web.myproducts.photo',['slug'=>$product->product_code])}}" class="cart"><i class="fa fa-photo" title="Add Photos"></i></a>
                                                <a href="{{route('web.myproducts.destroy',['slug'=>$product->product_code])}}" class="delete"><i class="fa fa-trash" title="Delete"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- Product Item End -->

                        @endforeach
                    </div>
@endif


            @else
                <div class="shop-toolbar">
                    <div class="product-showing mr-auto">
                        <h3 style="margin-left: 20px;">No Draft</h3>
                    </div>
                </div>
            @endif
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
