@extends('web.layouts.app1')
@section('title')
   Orders
@endsection

@section('content')
    <div class="myaccount-content" style="width:75%;">
    @if(isset($order_details))


            <h3>Order Details Of Your Product</h3>

            <div class="myaccount-table table-responsive text-center">
                <table class="table table-bordered">
                    <thead class="thead-light">
                    <tr>
                        <th>Product</th>
                        <th>User</th>
                        <th>Contact No.</th>
                        <th>Date</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($order_details as $key =>$order_detail)
                        <?php $order=\App\Models\Order::where('id',$order_detail->order_id)->first();
                            $product_order=\App\Models\Product::where('id',$order_detail->product_id)->first();
                            ?>
                        <tr>
                            <td class="pro-thumbnail"><a href="#"><img src="{{imageUrl('storage/'.$product_order->featured_image,90,100,100)}}" alt="Product"></a><br>
                                {{$product_order->title}}
                            </td>



                            <td>
                                {{$order->user->name}}</td>
                               <td> {{$order->user->phone}}</td>


                            <td>{{$order->order_date->format('M d, Y')}}</td>
                            <td>{{$order_detail->quantity}}</td>
                            <td>Rs.{{$order_detail->total}}</td>
                            <td>
                                @if($order_detail->status==0)
                                    <h4>New</h4>
                                @elseif($order_detail->status==1)
                                    <h4>Approved</h4>
                                @elseif($order_detail->status==2)
                                    <h4>Paid</h4>
                                @elseif($order_detail->status==4)
                                    <h4>Processing</h4>
                                @elseif($order_detail->status==5)
                                    <h4>Delivered</h4>
                                @elseif($order_detail->status==6)
                                    <h4>Cancelled</h4>
                                @endif
                            </td>
                            <td>
                                @if($order_detail->status==0)
                                <a href="{{route('web.order.status')}}?id={{$order_detail->id}}&status=1" class="btn btn-round">Approved</a><br>
                                <a href="{{route('web.order.status')}}?id={{$order_detail->id}}&status=6" class="btn btn-round" style="margin-top: 10px;">Cancelled</a>
                                 @endif
                                    @if($order_detail->status==1)
                                        <a href="{{route('web.order.status')}}?id={{$order_detail->id}}&status=4" class="btn btn-round">Processing</a><br>
                                        <a href="{{route('web.order.status')}}?id={{$order_detail->id}}&status=6" class="btn btn-round" style="margin-top: 10px;">Cancelled</a>

                                    @endif
                                    @if($order_detail->status==2)
                                        <a href="{{route('web.order.status')}}?id={{$order_detail->id}}&status=4" class="btn btn-round">Processing</a><br>
                                        <a href="{{route('web.order.status')}}?id={{$order_detail->id}}&status=6" class="btn btn-round" style="margin-top: 10px;">Cancelled</a>
                                    @endif
                                    @if($order_detail->status==6)
                                        <a href="{{route('web.order.status')}}?id={{$order_detail->id}}&status=1" class="btn btn-round">Approved</a>

                                    @endif
                                    @if($order_detail->status==4)
                                        <a href="{{route('web.order.status')}}?id={{$order_detail->id}}&status=5" class="btn btn-round" style="margin-top: 10px;">Delivered</a><br>
                                        <a href="{{route('web.order.status')}}?id={{$order_detail->id}}&status=6" class="btn btn-round" style="margin-top: 10px;">Cancelled</a>
                                    @endif

                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
                <div class="float-right mr-3">
                    {!! $order_details->links();  !!}


                </div>
            </div>





    @endif



    @if(isset($my_orders))

            <h3>Your Orders</h3>
            <div class="myaccount-table table-responsive text-center">
                <table class="table table-bordered">
                    <thead class="thead-light">
                    <tr>
                        <th>Product</th>
                        <th>Seller</th>
                        <th>Contact No.</th>
                        <th>Date</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($my_orders as $key =>$my_order)
                        <?php $my_order_details=\App\Models\OrderDetail::where('order_id',$my_order->id)->get();

                        ?>
                        @foreach($my_order_details as $my_order_detail)
                            <?php
                            $my_product_order=\App\Models\Product::find($my_order_detail->product_id);
                            ?>
                        <tr>
                            <td class="pro-thumbnail"><a href="#"><img src="{{imageUrl('storage/'.$my_product_order->featured_image,90,100,100)}}" alt="Product"></a><br>
                                {{$my_product_order->title}}
                            </td>
                            <td>
                                {{$my_product_order->user->name}}</td>
                            <td> {{$my_product_order->user->phone}}</td>


                            <td>{{$my_order->order_date->format('M d, Y')}}</td>
                            <td>{{$my_order_detail->quantity}}</td>
                            <td>Rs.{{$my_order_detail->total}}</td>
                            <td>
                                @if($my_order_detail->status==0 || $my_order_detail->status==1 || $my_order_detail->status==2)
                                    <a href="{{route('web.order.status')}}?id={{$my_order_detail->id}}&status=3" class="btn btn-round cancellation" style="margin-top: 10px;">Cancelled</a>
                                    @elseif($my_order_detail->status==3)
                                       Cancelled
                                    @elseif($my_order_detail->status==5)
                                        Delivered
                                    @elseif($my_order_detail->status==6)
                                    Cancelled By seller
                                    @endif

                            </td>
                        </tr>
                        @endforeach
                    @endforeach
                    </tbody>
                </table>
                <div class="float-right mr-3">
                    {!! $my_orders->links();  !!}


                </div>
            </div>

    @endif
    </div>

@endsection
@section('scripts')
    <script type="text/javascript">
        function SubmitForm(frm) {
            frm.submit();
        }
    </script>
    <script>
        $('.cancellation').click(function (e) {
            e.preventDefault();
            url = $(this).attr('href');

            if(confirm('Do u  want to cancel your order?')){
                location.href = url;
            }

        });
    </script>
@endsection
