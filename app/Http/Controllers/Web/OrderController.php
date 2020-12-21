<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Shipping;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class OrderController extends Controller
{


    public function cartSession($type)
    {
        if(Auth::check()) {
            $check_product=[];

            if($type=='Multiple')
            {

                $allcarts__d = Cart::where('user_id', Auth::user()->id)->get();
                foreach($allcarts__d as $u_cart) {
                    $checkout_p=[];
                    $product = \App\Models\Product::where('id', $u_cart->product_id)->first();
                    $checkout_p['product_code']=$product->product_code;
                    $checkout_p['quantity']=$u_cart->quantity;
                    $check_product[]=$checkout_p;



                }
                \Illuminate\Support\Facades\Session::put('checkout_products', $check_product);
            }
            else
            {
                $single_product = \App\Models\Product::where('product_code',  $type)->first();
                if($single_product!=null)
                {
                    $checkout_p['product_code'] = $type;
                    $checkout_p['quantity'] = 1;
                    $check_product[] = $checkout_p;
                    \Illuminate\Support\Facades\Session::put('checkout_products', $check_product);
                }
            }


            return redirect()->route('web.order.checkout');
        }
    }

    public function updateSession(Request $request)
    {
        $check_product=[];
        if (request()->ajax()) {
            $product_code = $request->get('product_code');
            $quantity= $request->get('qty');
            $session_data=\Illuminate\Support\Facades\Session::get('checkout_products');
            foreach($session_data as $session)
            {
                $checkout_p=[];
                if($session['product_code']== $product_code)
                {
                    $checkout_p['product_code']=$product_code;
                    $checkout_p['quantity']=$quantity;
                }
                else
                {
                    $checkout_p['product_code']=$session['product_code'];
                    $checkout_p['quantity']=$session['quantity'];
                }
                $check_product[]=$checkout_p;



            }
            \Illuminate\Support\Facades\Session::put('checkout_products', $check_product);
        }

    }
    public function checkout(Request $request)
    {
        if(Auth::check())
        {
            $shipping=\App\Models\Shipping::where('user_id',Auth::user()->id)->first();
            if($shipping==null)
            {

                return view('web.shipping');
            }
            else
            {
                return view('web.order');
            }



        }



    }

    public function create(Request $request)
    {
       $input=$request->all();
       $input['order_number']=5;
        $input['order_date']=Carbon::now();
        $input['status']=0;
        $input['user_id']=Auth::user()->id;
        $order=Order::create($input);
        $order_products=\Illuminate\Support\Facades\Session::get('checkout_products');
        foreach($order_products as $order_product)
        {
            $product=\App\Models\Product::where('product_code',$order_product['product_code'])->first();

            if($product!=null)
            {
                $detail['order_id']=$order->id;
                $detail['product_id']=$product->id;
                $detail['quantity']=$order_product['quantity'];
                $detail['status']=0;
                $detail['total']=$order_product['quantity']*$product->price;
               OrderDetail::create($detail);

            }
        }
return redirect('/');

    }


    public function changeStatus(Request $request)
    {
        $order=OrderDetail::find($request->id);
        if($order)
        {
            $order->status=$request->status;
            $order->save();
            return redirect()->route('web.orders');
        }

    }



}
