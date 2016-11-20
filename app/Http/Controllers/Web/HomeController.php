<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    //首页
    public function index()
    {

        return view('web.home',['title'=>'博客首页']);
    }
    
    //注册 
    public function register()
    {
        return view('web.register');
    }
    
    
}
