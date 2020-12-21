@extends('web.layouts.app')
@section('styles')
    <style>
        /*#price-range span*/
        /*{*/
            /*display: none!important;*/
        /*}*/
    </style>
    @endsection
@section('content')
<!--    --><?php // $brands =\App\Models\Attribute::join('attribute_sub_category', 'attribute_sub_category.attribute_id', '=', 'attributes.id')->join('attribute_product', 'attribute_product.attribute_id', '=', 'attributes.id')->join('sub_categories', 'sub_categories.id', '=','attribute_sub_category.sub_category_id')->where('attributes.feature' , 'Brand')->where('sub_categories.slug', json_decode($slug))->pluck('attribute_product.value','attribute_product.id')->toArray();
//   ;?>

    <!-- Product Section Start -->
    <div class="product-section section pt-90 pb-90 pt-lg-80 pb-lg-80 pt-md-70 pb-md-70 pt-sm-60 pb-sm-60 pt-xs-50 pb-xs-50">
        <div class="container">
            <div class="row">

                <div class="col-xl-9 col-lg-8 col-12 order-1 order-lg-2 product_detail">

                   @include('web.product.ajaxView')

                </div>

                <div class="col-xl-3 col-lg-4 col-12 order-2 order-lg-1 pr-30 pr-sm-15 pr-md-15 pr-xs-15">
                    <form action="#" method="get">
                        @csrf
                    <div class="sidebar">
                        <h4 class="sidebar-title">Search</h4>
                        <div class="sidebar-search desktop_search">

                                <input type="text" name="product_name" placeholder="Enter name"  id="product_name">
                                <input type="hidden" name="hidden_page" id="hidden_page" value="1" />

                            <input type="submit" value="search">
                        </div>
                    </div>


                    <div class="sidebar">
                        <h4 class="sidebar-title">Price</h4>
                        <input type="hidden" id="hidden_minimum_price" value="0" />
                        <input type="hidden" id="hidden_maximum_price" value="{{$pro_price}}" />
                        {{--<p id="price_show" style="font-size: 25px;">Rs0 - Rs10000</p>--}}
                        <div id="price-range"></div>
                    </div>
                    </form>
                    {{--<div class="sidebar">--}}
                        {{--<div class="banner"><a href="#"><img src="assets/images/banner/banner-3.jpg" alt=""></a></div>--}}
                    {{--</div>--}}

                    {{--<div class="sidebar">--}}
                        {{--<h4 class="sidebar-title">Tags</h4>--}}
                        {{--<div class="tag-cloud">--}}
                            {{--<a href="#">Oil</a>--}}
                            {{--<a href="#">Beard oil</a>--}}
                            {{--<a href="#">Beard</a>--}}
                            {{--<a href="#">Stylish</a>--}}
                            {{--<a href="#">Ecommerce</a>--}}
                            {{--<a href="#">Shop</a>--}}
                            {{--<a href="#">Shopping</a>--}}
                            {{--<a href="#">Store</a>--}}
                            {{--<a href="#">Online Store</a>--}}
                        {{--</div>--}}
                    {{--</div>--}}

                </div>

            </div>
        </div>
    </div><!-- Product Section End -->
@endsection
@section('scripts')
    <script>
        var pro_price={!! $pro_price !!};
        var name = '';
        var slug={!! $slug !!};
        $(document).ready(function(){

            function fetch_data()
            {
                $('.product_detail').html('<div id="loading" style="" ></div>');
                var minimum_price = $('#hidden_minimum_price').val();
                var maximum_price = $('#hidden_maximum_price').val();
                $.ajax({
                    url: "/allproducts/"+slug+"?page="+page+"&sort="+sort,
                    method:"GET",
                    data:{name:name,minimum_price:minimum_price, maximum_price:maximum_price},
                    success:function(data)
                    {
                        $('.product_detail').html(data.html);
                    }
                })
            }

            $(document).on('keyup', '#product_name', function(){
                name = $('#product_name').val();
                fetch_data();
            });

            $(document).on('click', '.pagination a', function(event){
                event.preventDefault();
                page = $(this).attr('href').split('page=')[1];
                fetch_data();
            });
            $(document).on('change', '#select_product', function(event){
                sort = $(this).val();
                fetch_data();
            });
            $('#price-range').slider({
                range:true,
                min:0,
                max:pro_price,
                values:[0, pro_price],
                step:500,
                stop:function(event, ui)
                {
                    $('.ui-slider-handle:eq(0)').html( '<span>' + 'Rs.' + ui.values[ 0 ] + '</span>');
                    $('.ui-slider-handle:eq(1)').html( '<span>' + 'Rs.' + ui.values[ 1 ] + '</span>');
                    $('#hidden_minimum_price').val(ui.values[0]);
                    $('#hidden_maximum_price').val(ui.values[1]);
                    fetch_data();
                }
            });
            $('.ui-slider-handle:eq(0)').html( '<span>' + 'Rs.' + $( "#price-range" ).slider( "values", 0 ) + '</span>' );
            $('.ui-slider-handle:eq(1)').html( '<span>' + 'Rs.' + $( "#price-range" ).slider( "values", 1 ) + '</span>' );



        });
    </script>
@endsection
