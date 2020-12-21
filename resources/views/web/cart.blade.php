@extends('web.layouts.app')
@section('content')


    <!-- Cart Section Start -->
    <div class="cart-section section position-relative pt-90 pb-60 pt-lg-80 pb-lg-50 pt-md-70 pb-md-40 pt-sm-60 pb-sm-30 pt-xs-50 pb-xs-20 fix">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    @if($messages=Session::get('success'))

                        <div class="alert alert-success">
                            <p>{{$messages}}</p>
                        </div>

                    @endif
                    @if($messages=Session::get('danger'))
                        <div class="alert alert-danger">
                            <p>{{$messages}}</p>
                        </div>
                    @endif
                    @if(isset($message))
                        <div class="col-12">
                            <div class="alert alert-success">
                                <p>{{$message}}</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div></div>
        <div class="container">
            <div class="row">
                <div class="col-12">

                    <form action="#">
                        <!-- Cart Table -->
                        <div class="cart-table table-responsive mb-30">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th class="pro-thumbnail">Image</th>
                                    <th class="pro-title">Product</th>
                                    <th class="pro-price">Price</th>
                                    <th class="pro-quantity">Quantity</th>
                                    <th class="pro-subtotal">Total</th>
                                    <th class="pro-remove">Remove</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($carts as $key => $cart)

                                    <?php $product=\App\Models\Product::where('id',$cart->product_id)->first(); ?>
                                <tr>
                                    <td class="pro-thumbnail"><a href="#"><img src="{{imageUrl('storage/'.$product->featured_image,90,100,100)}}" alt="Product"></a></td>
                                    <td class="pro-title"><a href="#">{{$product->title}}</a></td>
                                    <td class="pro-price"><span>Rs.{{$product->price}}</span></td>

                                    <td class="pro-quantity">
                                        <div class="pro-qty"><input type="text" value="{{$cart->quantity}}" name="quantity">
                                            <input type="hidden" value="{{$cart->id}}" name="cart-id">
                                            <input type="hidden" value="{{$product->price}}" name="cart-price">
                                            <input type="hidden" value="{{$key}}" name="cart-key"></div>
                                    </td>
                                    <td class="pro-subtotal" id="cart-total{{$key}}"><span>Rs.{{$cart->quantity*$product->price}}</span></td>
                                    <td class="pro-remove"><a href="{{route('web.cart.delete',['id'=>$cart->id])}}"><i class="fa fa-trash-o"></i></a></td>
                                </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </form>

                    <div class="row">


                        <!-- Cart Summary -->
                        <div class="col-lg-6 col-12 mb-30 d-flex">
                            <div class="cart-summary">
                                  <a href="{{route('web.order.session',['type'=>'Multiple'])}}" class="btn checkout-btn">Checkout</a>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>

    </div><!-- Cart Section End -->

 @endsection
@section('scripts')
    <script>
        $('.pro-qty').prepend('<span class="dec qtybtn">-</span>');
        $('.pro-qty').append('<span class="inc qtybtn">+</span>');
        $('.qtybtn').on('click', function() {
            var $button = $(this);
            var oldValue = $button.parent().find("input[name='quantity']").val();
            var id = $button.parent().find("input[name='cart-id']").val();
            var price=$button.parent().find("input[name='cart-price']").val();
            var key=$button.parent().find("input[name='cart-key']").val();
            if ($button.hasClass('inc')) {
                var newVal = parseFloat(oldValue) + 1;
            } else {
                // Don't allow decrementing below zero
                if (oldValue > 0) {
                    var newVal = parseFloat(oldValue) - 1;
                }

                else {
                    newVal = 0;
                }
            }
            var total=newVal*price;
            $button.parent().find("input[name='quantity']").val(newVal);
            $.ajax({
                url:"{!! route('web.cart.update') !!}",
                method:"GET",
                data:{id:id,total:total,qty:newVal},
                success:function(data){
                    $("#cart-total"+key).html('Rs.'+total);
                }
            });
        });
    </script>
@endsection
