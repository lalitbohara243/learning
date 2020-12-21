<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class HomeController extends Controller
{
   public function index()
   {
    return view('web.index');
   }

   public function Notification($id)
   {
      $notify=Notification::find($id);
      $notify->status=2;
      $notify->save();
      return redirect($notify->url);
   }
}
