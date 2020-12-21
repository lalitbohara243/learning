@extends('web.layouts.app')
@section('styles')
    <style>
        .custom-select
        {
            height: calc(2.25rem + 7px);
            border-radius: 2.25rem;
            border: 1px solid #ebebeb;
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
        <div class="container">
            <div class="row">
                <div class="col-12">

                    <!-- Checkout Form s-->
                    <form action="{{route('web.shipping.add')}}" class="checkout-form" method="post">
                        @csrf




                                <!-- Billing Address -->
                                <div id="billing-form" class="mb-10">
                                    <h4 class="checkout-title">Shipping Address</h4>

                                    <div class="row">

                                        <div class="col-md-4 col-12 mb-20">
                                            <label>Name*</label>
                                            <input type="text" placeholder="Name" name="name">
                                        </div>

                                        <div class="col-md-4 col-12 mb-20">
                                            <label>Email Address*</label>
                                            <input type="email" placeholder="Email Address" name="email">
                                        </div>

                                        <div class="col-md-4 col-12 mb-20">
                                            <label>Phone no*</label>
                                            <input type="text" placeholder="Phone number" name="phone">
                                        </div>

                                        <div class="col-md-4 col-12 mb-20">
                                            <?php $cities=\App\Models\City::pluck('name','id');?>
                                            <label>City*</label>
                                                {{ Form::select('city_id', $cities,null, array('class' => 'browser-default custom-select')) }}
                                        </div>

                                        <div class="col-md-4 col-12 mb-20">
                                            <label>Address1*</label>
                                            <input type="text" placeholder="Town/City" name="address1">
                                        </div>

                                        <div class="col-md-4 col-12 mb-20">
                                            <label>Address2*</label>
                                            <input type="text" placeholder="State" name="address2">
                                        </div>
                                        <button class="place-order btn btn-lg btn-round">Next</button>


                                    </div>

                                </div>




                    </form>

                </div>
            </div>
        </div>


    </div><!-- Cart Section End -->

 @endsection

