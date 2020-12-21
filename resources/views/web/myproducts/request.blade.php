@extends('web.layouts.app1')
@section('title')
    My Products
@endsection
@section('content')
    <div class="col-lg-9 col-12 mb-30">
        <div class="myaccount-content">
            <div class="row">
                <div class="col">
                    <div class="shop-toolbar">
                        <div class="product-showing mr-auto">
                            <p style="margin-bottom: 20px;font-size: 19px;font-weight: bold;">Here are some of rules.Read it before sending request.</p>
                            <ul style="list-style-type: disc;margin-left: 50px;">
                                <li>
                                    Once u send request, you wont be able to edit.So you can go to myproduct section and check ur information there before sending.
                                </li>
                                <li>
                                    Your product will be expired after expiry date.
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div><!-- Shop Toolbar End -->
            <div class="row">
                <div class="col-md-12 mt-50">
                    <a href="{!! route('web.myproducts.send',['slug'=>$product->product_code]) !!}" class="btn btn-round btn-lg" type="submit">Send Request</a>

                    <a href="{!! route('web.draft.myproducts',['slug'=>$product->product_code]) !!}" class="btn btn-round btn-lg" type="submit">Go to Draft</a>
                </div>
            </div>
        </div>
    </div>
    </div>
        </div>
@endsection
@section('scripts')

    @endsection
