<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ShippingController extends Controller
{


    public function add(Request $request)
    {
        $input=$request->except('product');
        $input['user_id']=Auth::user()->id;
        Shipping::create($input);


        return redirect()->route('web.order.session',['type'=>'Multiple']);


    }
    public function update($id,Request $request)
    {
        $s_details=Shipping::find($id);
        $input=$request->all();
        if($s_details)
        {
            $s_details->update($input);
        }

        return redirect()->route('web.order.session',['type'=>'Multiple']);


    }

}
