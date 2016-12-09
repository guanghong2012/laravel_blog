<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Article;//这个必须有，引入model，不然无法获取数据库数据
use Illuminate\Support\Facades\Input;

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

    //文章更新 put/patche (需要在表单里面用一个隐藏的<input name="_method" type="hidden" value="put" />) newwebadmin/article/{id}
    public function update(Request $request,$id)
    {
        if(!$id){
            return back();
        }
        $data = $request->all();
        $this->validate($request,[
            'pid' => 'required',
            'name' => 'required',
            'title' => 'required',
            'content' => 'required',

        ],[
            "pid.required" => "请选择文章分类",
            "name.required" => "文章名称不能为空",
            "title.required" => "文章标题不能为空",
            "content.required" => "文章内容不能为空",


        ]);

        $article = Article::where('id','=',$id)->first();
        unset($data['_token']);
        unset($data['_method']);
        if($article->update($data)){
            return redirect('newwebadmin/article/'.$id.'/edit')->with('pageSuccess','文章更新成功！');
        }else{
            back()->with('pageMsg','更新失败！')->withInput();
        }

    }

    /*
     * 文章添加
     * 路由方法：get
     * 路由：newwebadmin/article/create
     */
    public function create()
    {
        return view('admin/Article/add',['title' => '文章添加','article_active' => 'active']);
    }

    /*
     * 文章添加保存操作
     * 路由方法：post
     * 路由：newwebadmin/article
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $this->validate($request,[
            'name' => 'required',
            'title' => 'required',
            'content' => 'required',
        ],[
            "name.required" => "信息名称不能为空",
            "title.required" => "标题不能为空",
            "content.required" => "文章内容不能为空",

        ]);

        unset($$data['_token']);
        $article = Article::create($data);
        if($article){
            return redirect('newwebadmin/article/create')->with('pageSuccess','文章添加成功！');
        }else{
            back()->with('pageMsg','添加失败！')->withInput();
        }

    }
    
}
