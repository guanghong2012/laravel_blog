<?php

namespace App\Http\Controllers\Web;

use App\Models\ArticleComment;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Article;//这个必须有，引入model，不然无法获取数据库数据
use App\Models\Category;//这个必须有，引入model，不然无法获取数据库数据

class ArticleController extends Controller
{
    public $module = 'article'; // 标识当前模块为'article'
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }
    /*
     * 文章列表
     */
    public function lists($pid)
    {
        $category = Category::where('id','=',$pid)->first();
        $articles = Article::where('pid','=',$pid)->orderBy('sort','desc')->paginate(5);
        if($articles){
            foreach($articles as $k=>$val){
                $total_comment = ArticleComment::where('articleid','=',$val->id)->count();
                $articles[$k]['total_comment'] = $total_comment;
            }
        }
        //最新文章
        $new_article = Article::take(8)->orderBy('created_at','desc')->get();//最新文章8篇
        //点击排行
        $hot_article = Article::take(5)->orderBy('click','desc')->get();//点击排行5篇
        return view('newtpl/Article/lists',[
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

        //最新文章
        $new_article = Article::take(8)->orderBy('created_at','desc')->get();//最新文章8篇
        //点击排行
        $hot_article = Article::take(5)->orderBy('click','desc')->get();//点击排行5篇

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

        //网站公告
        $notice = Article::where('pid','=',8)->take(3)->get();
        //文章评论
        $articlecomment = ArticleComment::where('articleid','=',$id)->orderBy('created_at','asc')->paginate(10);
        $total_comment = ArticleComment::where('articleid','=',$id)->count();
        $info->total_comment = $total_comment;
        return view('newtpl/Article/detail',[
            'title' => $info->title,
            'info' => $info,
            'category' => $category,
            'pre' => $pre,
            'pre_title' => $pre_title,
            'next' => $next,
            'next_title' => $next_title,
            'new_article' => $new_article,
            'hot_article' => $hot_article,
            'notice' => $notice,
            'articlecomment' => $articlecomment
        ]);
    }
    
    /*
     * 一级分类下面的所有分类
     */
    public function allcategory($pid)
    {
        if(empty($pid)){
            //默认分类
            $default_cate = Category::where('pid','=',0)->orderBy('sort','desc')->first();
            $son = Category::where('pid','=',$default_cate->id)->get();
            $title = '所有文章分类';
        }else{
            $son = Category::where('pid','=',$pid)->get();
            $cate = Category::where('id','=',$pid)->first();
            $title = $cate->name;
        }
        //所有一级分类
        $all_cate = Category::where('pid','=',0)->orderBy('sort','desc')->get();

        if($son){
            foreach($son as $key=>$item){
                $article_num = Article::where('pid','=',$item->id)->count();
                $son[$key]['article_num'] = $article_num;
            }
        }

        return view('newtpl/Article/category',['title'=>$title, 'category'=>$son,'all_cate'=>$all_cate]);
    }
    
    /*
     * 评论文章
     */
    public function addcomment(Request $request)
    {
        $user_id = session()->get('user_id');
        $username = session()->get('user_name');
        if(empty($user_id)){
            $status = 0;
            $msg = '请登录！';
            return response()->json(array('msg'=> $msg,'status'=>$status), 200);
        }
        $data = [
            'user_id' => $user_id,
            'username' => $username,
            'articleid' => $request->id,
            'ip' => $request->getClientIp(),
            'content' => $request->commentContent,
        ];
        $res = ArticleComment::create($data);
        if($res){
            $status = 1;
            $msg = '评论成功！';

        }else{
            $status = 1;
            $msg = '评论失败！';
        }
        return response()->json(array('msg'=> $msg,'status'=>$status), 200);
    }

}
