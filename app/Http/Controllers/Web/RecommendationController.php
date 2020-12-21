<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Review;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;


class RecommendationController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::check()) {
            $view_products = Review::where('user_id', Auth::user()->id)->where('rating', '!=', null)->pluck('product_id')->toArray();


            $allproducts = Product::where('status', 3)->get();
            $allusers = User::get();
            $avg_ratings = [];
            foreach ($allproducts as $item) {
                $avg_ratings[$item->id] = Review::where('product_id', $item->id)->where('rating', '!=', null)->avg('rating');
            }


            $sub_ratings = [];
            foreach ($allproducts as $single) {
                foreach ($allusers as $single_user) {
                    $user_rating = Review::where('product_id', $single->id)->where('user_id', $single_user->id)->pluck('rating')->first();
                    foreach ($avg_ratings as $key => $avg_rating) {
                        if ($key == $single->id) {
                            if ($user_rating != null)
                                $sub_ratings[$single->id][$single_user->id] = round($user_rating - $avg_rating, 2);
                            else
                                $sub_ratings[$single->id][$single_user->id] = 0;

                        }
                    }

                }
            }
            $pro_key = [];
            $user_keys = [];


            $pro_keys = array_keys($sub_ratings);
            foreach ($view_products as $view_product) {

                foreach ($sub_ratings as  $sub_rating) {
                    $user_keys = array_keys($sub_rating);
                    $k = 0;
                    $similarities = [];
                    while ($k < count($pro_keys)) {

                        $total = 0;
                        $bt = 0;
                        $ct = 0;
                        for ($i = 0; $i < count($user_keys); $i++) {
                            $a = ($sub_ratings[$view_product][$user_keys[$i]]) * ($sub_ratings[$pro_keys[$k]][$user_keys[$i]]);
                            $total += $a;
                            $b = ($sub_ratings[$view_product][$user_keys[$i]]) * ($sub_ratings[$view_product][$user_keys[$i]]);
                            $bt += $b;
                            $c = ($sub_ratings[$pro_keys[$k]][$user_keys[$i]]) * ($sub_ratings[$pro_keys[$k]][$user_keys[$i]]);
                            $ct += $c;
                        }
                        $similarities[$pro_keys[$k]] = $total / (sqrt($bt) * sqrt($ct));

                        $k++;
                    }
                    $similarities=collect($similarities)->sortDesc()->toArray();
                    $sim[$view_product]=$similarities;


                }
            }
            $recommend_IDS=[];
foreach($sim as $s_id => $recommends)
{
   $recommends=array_slice($recommends,0,4,true);
    foreach($recommends as $r_id =>  $recommend) {

        if ($s_id != $r_id) {
            $recommend_IDS[]=$r_id;
        }

    }
}
$recommend_IDS=array_unique($recommend_IDS);
            $allrecommend_IDS=[];
   foreach($recommend_IDS as $recommend_ID)
   {
       if(!in_array($recommend_ID,$view_products))
       {
           $allrecommend_IDS[]=$recommend_ID;
       }
   }


            $allrecommend_IDS=array_filter($allrecommend_IDS);
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $itemCollection = collect($allrecommend_IDS);
            $perPage = 4;
            $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
            $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);
            $paginatedItems->setPath($request->url());



            return view('web.recommend-page',['allrecommend_IDS' => $paginatedItems]);
        }

    }





}
