<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Article;//这个必须有，引入model，不然无法获取数据库数据

class ArticleController extends Controller
{
    //文章列表 路由 newwebadmin/article
    public function index(Request $request)
    {
        $input = $request;
        if($input->name){
            $articles = Article::where('name','like','%'.$input->name.'%')->orderBy('id','desc')->paginate(10);
        }else{
            $articles = Article::orderBy('id','desc')->paginate(10);
        }

        return view('admin/Article/index',['title' => '文章列表','article_active' => 'active','articles' => $articles]);
    }
    
}
