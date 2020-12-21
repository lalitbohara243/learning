<?php

namespace App\Http\Controllers;

use App\Mail\mailtrap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function index(){
        Mail::to('lalitbohara243@gmail.com')->send(new mailtrap());
    }
}
