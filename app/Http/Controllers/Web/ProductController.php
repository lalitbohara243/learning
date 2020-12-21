<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
use App\Models\SubCategory;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProductController extends Controller
{


    public function index($slug)
    {
        $subcategories=SubCategory::where('slug',$slug)->first();
       $pro_price =json_encode($subcategories->product()->max('price'));

        if(empty($subcategories))
        {
            return redirect()->back();
        }
        else
        {
            $slug=json_encode($slug);
            $request = request();
            $page = $request->page ? $request->page : 1;
            $sort = $request->sort ? $request->sort : 0;
            $min_price = $request->get('minimum_price');
            $max_price = $request->get('maximum_price');
            $products =$subcategories->product()->where('status', '=', 3);
            if(!empty($request->name)) {
                $names = explode(' ', $request->name);
                $products = $products->where(function ($q) use ($names) {
                    foreach ($names as $name) {
                        $q->where('title', 'like', "%{$name}%");
                    }
                });
            }
            if(!empty($min_price)||!empty($max_price) ) {
                $products = $products->whereBetween('price', [$min_price, $max_price]);

            }

            $products = $products->orderby('updated_at', $sort ? 'asc' : 'desc')->paginate(3);
            if (request()->ajax()) {
                $view = view('web.product.ajaxView', compact('products', 'page','slug','sort','pro_price'))->render();
                return response()->json(['html' => $view]);
            }
            return view('web.product.index',compact('products', 'page','slug','sort','pro_price'));
        }


    }
    public function show($slug)
    {
        $product = Product::where('product_code', $slug)->whereIn('status', [3,4])->first();
        if (empty($product)) {
            return redirect()->back();
        }
        if (Auth::check()) {
            $rev = Review::where('product_id', $product->id)->where('user_id', Auth::user()->id)->first();
            if ($rev == Null) {
                $input['product_id'] = $product->id;
                $input['user_id'] = Auth::user()->id;
                $input['views'] = 1;
                Review::create($input);
            } else {
                $rev->views = 1;
                $rev->save();
            }

        }
        $rating = Review::where('product_id', $product->id)->avg('rating');
        $reviews = Review::where('product_id', $product->id)->where('rating', '!=', null)->get();


        foreach($product->sub_category as $subCat)
        {
            $allproducts=$subCat->product()->where('products.id','!=',$product->id)->where('products.status',3)->get();
        }

        return view('web.product.show',compact('product','reviews','rating','allproducts'));

    }

    public function changeStatus($product_code)
    {
        $product=Product::where('product_code',$product_code)->first();
        if($product)
        {
            $product->status=4;
            $product->save();
            return redirect()->route('web.product.show',['slug'=>$product_code]);
        }



    }



}
