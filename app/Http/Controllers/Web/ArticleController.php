<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Article;//这个必须有，引入model，不然无法获取数据库数据
use App\Models\Category;//这个必须有，引入model，不然无法获取数据库数据

class ArticleController extends Controller
{
    /*
     * 文章列表
     */
    public function lists($pid)
    {
        $category = Category::where('id','=',$pid)->first();
        $articles = Article::where('pid','=',$pid)->paginate(10);

        return view('web/Article/lists',['title'=>'文章列表','category'=>$category,'articles'=>$articles]);
    }

    /*
     * 文章详情页
     */
    public function detail($id)
    {
        if(!$id){
            return back();
        }
        $info = Article::where('id','=',$id)->first();
        $category = Category::where('id','=',$info->pid)->first();
        return view('web/Article/detail',['title' => $info->title,'info' => $info, 'category' => $category]);
    }

}
