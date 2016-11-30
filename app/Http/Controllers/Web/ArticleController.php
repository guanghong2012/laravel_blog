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
        $articles = Article::where('pid','=',$pid)->orderBy('sort','desc')->paginate(10);
        //最新文章
        $new_article = Article::take(8)->orderBy('created_at','desc')->get();//最新文章8篇
        //点击排行
        $hot_article = Article::take(5)->orderBy('click','desc')->get();//点击排行5篇
        return view('web/Article/lists',[
            'title'=>'文章列表',
            'category'=>$category,
            'articles'=>$articles,
            'new_article' => $new_article,
            'hot_article' => $hot_article
        ]);
    }

    /*
     * 文章详情页
     */
    public function detail($id)
    {
        if(!$id){
            return back();
        }
        Article::where('id','=',$id)->increment('click');//浏览数自增
        $info = Article::where('id','=',$id)->first();
        $category = Category::where('id','=',$info->pid)->first();
        //上一篇 下一篇
        $all_article = Article::where('pid','=',$info->pid)->orderBy('sort','desc')->pluck('id')->toArray();
        foreach($all_article as $key=>$val){
            if($val==$id){
                if($key-1>=0){
                    $pre = $all_article[$key-1];
                    $pre_info = Article::where('id','=',$pre)->pluck('title')->toArray();
                    $pre_title = $pre_info[0];
                }else{
                    $pre = 0;
                    $pre_title = '没有了';
                }
                if($key+1 <= count($all_article)-1){
                    $next = $all_article[$key+1];
                    $next_info = Article::where('id','=',$next)->pluck('title')->toArray();
                    $next_title = $next_info[0];
                }else{
                    $next = 0;
                    $next_title = '敬请期待';
                }
                break;
            }
        }



        return view('web/Article/detail',[
            'title' => $info->title,
            'info' => $info,
            'category' => $category,
            'pre' => $pre,
            'pre_title' => $pre_title,
            'next' => $next,
            'next_title' => $next_title
        ]);
    }

}
