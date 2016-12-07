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
    
    //文章编辑 get newwebadmin/article/{id}/edit
    public function edit($id)
    {
        if(!$id){
            return back();
        }
        $article = Article::where('id','=',$id)->first();
        return view('admin/Article/edit',['title' => '编辑文章','article_active' => 'active','article' => $article]);
    }
    
}
