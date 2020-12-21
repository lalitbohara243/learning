@extends('web.layouts.app')
@section('styles')
    <style>
        .modal-dialog {

            max-width: 733px;
        }
        .modal {

            top: 120px;
        }
        .pay-btn
        {
            margin-left: 28px;

            background-color: #d0a97e;

            color: #222;

            border-color: #d0a97e;
        }
        .pay-btn:hover
        {

            background-color: #222;

            color: #d0a97e;

            border-color: #222;
        }
        .cash-btn
        {
            border-radius: 4px!important;

            margin-top: 2px!important;

            margin-right: 19px!important;
        }
    </style>
@endsection

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

        <?php $user=\Illuminate\Support\Facades\Auth::user();
$shipping_details=\App\Models\Shipping::where('user_id',$user->id)->first();
        ?>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row">

                        <div class="col-lg-6 col-12 mb-5">
                            <div class="cart-table">
                            <table class="table">
                                <tbody>
                                <?php
                                $allitems=\Illuminate\Support\Facades\Session::get('checkout_products');
                                $total_amt=0;
                                $shipping_amt=0;



                                ?>
                                @foreach($allitems as $l=> $u_cart)
                              <?php
                              $product=\App\Models\Product::where('product_code',$u_cart['product_code'])->first(); ?>

                                @if($product!=null)
                                    <tr>
                                        <td class="pro-thumbnail"><img src="{{imageUrl('storage/'.$product->featured_image,490,700,100)}}" alt="Product"></td>
                                        <td class="pro-title"><a href="#" onclick="return false;">{{$product->title}}</a></td>
                                        <td class="pro-price"><span>Rs.{{$product->price}}</span></td>
                                        <td class="pro-quantity">
                                            <div class="pro-qty"><input type="text" value="{{$u_cart['quantity']}}" name="quantity">
                                                <input type="hidden" value="{{$product->price}}" name="price">
                                                <input type="hidden" value="{{$product->product_code}}" name="product_code">
                                                <input type="hidden" value="{{$l}}" name="key"></div></td>
                                        <td class="pro-subtotal" id="cart-total{{$l}}"><span>Rs.{{$u_cart['quantity']*$product->price}}</span></td>
                                        <?php $total_amt+=$u_cart['quantity']*$product->price;?>
                                    </tr>
                                   @endif
                               @endforeach

                                </tbody>
                            </table>
                            </div>

                        </div>










                        <!-- Cart Summary -->
                        <div class="col-lg-6 col-12 mb-30 d-flex">
                            <div class="cart-summary">
                                <div class="cart-summary-wrap">
@if($shipping_details!=null)
                                    <h4>Shipping & Billing</h4>
                                   <p><i class="fa fa-user" style="color:#d0a97e;"></i></i>&nbsp;{{$shipping_details->name}}<span class="btn" data-toggle="modal" data-target="#exampleModal">Edit</span></p>
                                    <p><i class="fa fa-map-marker" style="color:#d0a97e;"></i></i>&nbsp;{{$shipping_details->address1}},{{$shipping_details->address2}},{{$shipping_details->city_id}},Nepal<span class="btn" data-toggle="modal" data-target="#exampleModal">Edit</span></p>
                                    <p><i class="fa fa-phone" style="color:#d0a97e;"></i></i>&nbsp;{{$shipping_details->phone}}<span class="btn" data-toggle="modal" data-target="#exampleModal">Edit</span></p>
                                    <p><i class="fa fa-envelope" style="color:#d0a97e;"></i></i>&nbsp;{{$shipping_details->email}}<span class="btn" data-toggle="modal" data-target="#exampleModal">Edit</span></p>



                                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Edit your shipping address</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <form action="{{route('web.shipping.update',['id'=>$shipping_details->id])}}" class="checkout-form" method="post">
                                                            @csrf
                                                        <div class="row">
                                                            <div class="col-md-4 col-12 mb-20">
                                                                <label>Name*</label>
                                                                <input type="text" placeholder="Name" name="name" value="{{$shipping_details->name}}">
                                                            </div>

                                                            <div class="col-md-4 col-12 mb-20">
                                                                <label>Email Address*</label>
                                                                <input type="email" placeholder="Email Address" name="email" value="{{$shipping_details->email}}">
                                                            </div>

                                                            <div class="col-md-4 col-12 mb-20">
                                                                <label>Phone no*</label>
                                                                <input type="text" placeholder="Phone number" name="phone" value="{{$shipping_details->phone}}">
                                                            </div>

                                                            <div class="col-md-4 col-12 mb-20">
                                                                <?php $cities=\App\Models\City::pluck('name','id');?>
                                                                <label>City*</label>
                                                                {{ Form::select('city_id', $cities,$shipping_details->city_id, array('class' => 'browser-default custom-select')) }}
                                                            </div>

                                                            <div class="col-md-4 col-12 mb-20">
                                                                <label>Address1*</label>
                                                                <input type="text" placeholder="Town/City" name="address1" value="{{$shipping_details->address1}}" >
                                                            </div>

                                                            <div class="col-md-4 col-12 mb-20">
                                                                <label>Address2*</label>
                                                                <input type="text" placeholder="State" name="address2" value="{{$shipping_details->address2}}">
                                                            </div>



                                                        </div>
                                                            <button class="btn btn-primary">Save changes</button>
                                                        </form>
                                                    </div>


                                                </div>
                                            </div>
                                        </div>
                                      <h2 style="margin-top: 10px;"></h2>
                                    @endif











                                    <h4 style="margin-top: 35px;">Order Summary</h4>
                                    <p>Sub Total <span>Rs.{{$total_amt}}</span></p>
                                    <p>Shipping Cost <span>$00.00</span></p>
                                    <h2>Grand Total <span>Rs.{{$total_amt}}</span></h2>
                                </div>
                                <div class="cart-summary-button">
                                    <div class="row">
                                        <div class="col-md-6">
                                    <form action="https://uat.esewa.com.np/epay/main" method="POST">
                                        <input value="{{$total_amt}}" name="tAmt" type="hidden">
                                        <input value="{{$total_amt}}" name="amt" type="hidden">
                                        <input value="0" name="txAmt" type="hidden">
                                        <input value="0" name="psc" type="hidden">
                                        <input value="0" name="pdc" type="hidden">
                                        <input value="testmerchant" name="scd" type="hidden">
                                        <input value="hamrobajar123456" name="pid" type="hidden">
                                        <input value="" type="hidden" name="su">
                                        <input value="" type="hidden" name="fu">
                                        <input value="Pay With Esewa" type="submit" class="pay-btn btn checkout-btn">
                                    </form>
                                        </div>
                                        <div class="col-md-6">
                                            <button class="btn cash-btn checkout-btn" data-toggle="modal" data-target="#cod">Cash on Delivery</button>
                                            <div class="modal fade" id="cod" tabindex="-1" role="dialog" aria-labelledby="codLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="codLabel">Modal title</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{route('web.order.create')}}" class="checkout-form" method="post">
                                                                @csrf
                                                                <div class="row">

                                                                        <input type="hidden" name="total" value="{{$total_amt}}" >
                                                                        <input type="hidden" name="shipping_id" value="{{$shipping_details->id}}" >





                                                                            <button class="btn order-btn pay-btn">Confirm Order</button>
                                                                                                                           </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                </div>

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
            var key=$button.parent().find("input[name='key']").val();
            var price=$button.parent().find("input[name='price']").val();
            var code=$button.parent().find("input[name='product_code']").val();
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
                url:"{!! route('web.order.update.session') !!}",
                method:"GET",
                data:{product_code:code,qty:newVal},
                success:function(data){
                    $("#cart-total"+key).html('Rs.'+total);
                }
            });
        });
    </script>
@endsection
