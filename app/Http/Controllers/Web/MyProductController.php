<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\SubCategory;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class MyProductController extends Controller
{
    public function __construct(ProductRepository $productRepo)
    {
        $this->productRepository = $productRepo;
//        $this->middleware('permission:user-dashboard');
    }
    public function myProduct()
    {
        if(Auth::check())
        {
            $user=Auth::user();
            $approved_products=Product::whereIn('status', [3,4])->where('user_id',$user->id)->orderby('updated_at','desc')->paginate(5);
            return view('web.myproducts.myproduct',compact('approved_products'));
        }



    }


    public function Orders()
    {
        if(Auth::check())
        {
            $user=Auth::user();
            $order_details=Order::join('order_details','order_details.order_id','orders.id')->join('products','order_details.product_id','products.id')->where('products.user_id',Auth::user()->id)->whereIn('order_details.status',[0,1,2,4,5,6])->select('order_details.*')->paginate(10);
            $my_orders=Order::where('user_id',Auth::user()->id)->paginate(10);
            return view('web.myproducts.orders',compact('order_details','my_orders'));
        }



    }
    public function Draft()
    {
        if(Auth::check())
        {
            $user=Auth::user();
            $myproducts=Product::where('status',1)->where('user_id',$user->id)->get();
            $unproducts=Product::where('status',4)->where('user_id',$user->id)->paginate(5);
            $approved_products=Product::where('status',3)->where('user_id',$user->id)->paginate(5);
            return view('web.myproducts.draft',compact('myproducts','approved_products','unproducts'));
        }



    }

    public function category()
    {
        $categories=Category::all();
        return view('web.product.category',compact('categories'));
    }
    public function add($slug)
    {
        $subcategory=SubCategory::where('slug',$slug)->first();
        return view('web.product.add',compact('subcategory'));
    }

    public function save(Request $request)
    {

        $user=Auth::user();
        if ($request->hasFile('featured_image')) {
            $image = request('featured_image')->store('products');

        }
        else{
            $image=$request->featured_image;

        }

        $input=$request->all();

        $input['slug']=Str::slug($input['title']);
        $input['product_code']=$input['slug'].rand(999,100000);
        $input['featured_image']=$image;
        $input['status']=1;
        $input['user_id']=$user->id;
        $product=Product::create($input);
        $subcategory=$request->sub_category_id;
        $product->sub_category()->sync((array)$subcategory);
        $data=[];
        if(isset($input['attribute_id']))
        {
            foreach($input['attribute_id'] as $key=>$attribute_id) {
                $data[$input['attribute_id'][$key]] = ['value' => $input['value'][$key]];
            }
            $product->attribute()->sync((array)$data);
        }

        return redirect()->route('web.myproducts.photo',['slug'=>$product->product_code]);
    }
    public function edit($slug)
    {
        if(Auth::check())
        {
            $user=Auth::user();
            $myproduct=Product::where('user_id',$user->id)->where('product_code',$slug)->first();

            if (empty($myproduct)) {

                return redirect(route('web.home'));
            }
            return view('web.myproducts.edit',compact('myproduct'));
        }


    }

    public function update($slug,Request $request)
    {
        $user=Auth::user();
        $myproduct=Product::where('user_id',$user->id)->where('product_code',$slug)->first();


        if (empty($myproduct)) {

            return redirect(route('web.home'));
        }

        if ($request->hasFile('featured_image')) {
            $image = request('featured_image')->store('products');

        }
        else{
            $image=$myproduct->featured_image;

        }
        $input=$request->all();
        $input['featured_image']=$image;
        $myproduct = $this->productRepository->update($input, $myproduct->id);
        $data=[];
        if(isset($input['attribute_id']))
        {
            foreach($input['attribute_id'] as $key=>$attribute_id) {
                $data[$input['attribute_id'][$key]] = ['value' => $input['value'][$key]];
            }
            $myproduct->attribute()->sync((array)$data);
        }

        return redirect()->route('web.myproducts.photo',['slug'=>$myproduct->product_code]);

    }

    public function photo_manager($slug)
    {

        $user=Auth::user();
        $product=Product::where('user_id',$user->id)->where('product_code',$slug)->first();
        return view('web.myproducts.photo',compact('product'));
    }
    public function requestView($slug)
    {

        $user=Auth::user();
        $product=Product::where('user_id',$user->id)->where('product_code',$slug)->first();
        return view('web.myproducts.request',compact('product'));
    }
    public function sendRequest($slug)
    {

        $user=Auth::user();
        $product=Product::where('user_id',$user->id)->where('product_code',$slug)->first();
        $product->status=2;
        $product->save();
        return redirect()->route('web.draft.myproducts')->with('success','Your product request sent suceessfully.Wait for the notification about your approval');

    }
    public function destroy($slug)
    {
        $user=Auth::user();
        $product=Product::where('user_id',$user->id)->where('product_code',$slug)->first();
        if (empty($product)) {

            return redirect()->route('web.home');
        }

        $product->delete($product->id);
        return redirect()->route('web.myproduct');
    }
}
