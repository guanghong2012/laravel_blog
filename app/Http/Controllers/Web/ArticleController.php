<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Article;//这个必须有，引入model，不然无法获取数据库数据
use App\Models\Category;//这个必须有，引入model，不然无法获取数据库数据

class ArticleController extends Controller
{
    public function lists($pid)
    {
        $category = Category::where('id','=',$pid)->first();
        $articles = Article::where('pid','=',$pid)->paginate(1);

        return view('web/Article/lists',['title'=>'文章列表','category'=>$category,'articles'=>$articles]);
    }
}
