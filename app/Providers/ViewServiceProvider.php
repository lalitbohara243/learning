<?php

namespace App\Providers;

use App\Models\Cart;
use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        view()->composer("web.layouts.header",function($view){
            $user = Auth::id();
            $user_carts=Cart::where('user_id',$user)->take(3)->get();
            $view->with(compact('user_carts'));

        });
        view()->composer("web.layouts.header",function($view){
            $user = Auth::id();
            $user_notifications=Notification::where('user_id',$user)->take(9)->orderby('created_at','desc')->get();
            $view->with(compact('user_notifications'));

        });


    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
