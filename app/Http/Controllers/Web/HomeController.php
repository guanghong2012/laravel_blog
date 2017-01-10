<?php

namespace App\Http\Controllers\Web;

use App\Models\ArticleComment;
use App\Models\Banner;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\User;//这个必须有，引入model，不然无法获取数据库数据
use Illuminate\Support\Facades\Validator;
use Hash;
use App\Models\Article;//这个必须有，引入model，不然无法获取数据库数据
use App\Models\Category;//这个必须有，引入model，不然无法获取数据库数据

class HomeController extends Controller
{
    public $module = 'home'; // 标识当前模块为'article'
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }
    //首页
    public function index()
    {
        //取出推荐的一篇文章
        $article = Article::where('is_recommend','=','1')->orderBy('sort','desc')->first();//推荐文章1篇
        $cate_name = Category::where('id','=',$article->pid)->pluck('name');//获取当前文章分类名称
        $article->cate_name = $cate_name[0];
        //最新文章
        //$new_article = Article::take(8)->orderBy('created_at','desc')->get();//最新文章8篇
        $new_article = Article::orderBy('created_at','desc')->simplePaginate(5);//最新文章8篇
        foreach($new_article as $key=>$item){
            $cate = Category::where('id','=',$item->pid)->pluck('name');//获取当前文章分类名称
            $total_comment = ArticleComment::where('articleid','=',$item->id)->count();
            $new_article[$key]['cate_name'] = $cate[0];
            $new_article[$key]['total_comment'] = $total_comment;
        }
        //点击排行
        $hot_article = Article::take(5)->orderBy('click','desc')->get();//点击排行5篇
        //首页轮播
        $banner = Banner::orderBy('sort','desc')->get();
        //网站公告
        $notice = Article::where('pid','=',8)->take(3)->get();
        //return view('web.home',['title'=>'博客首页','article'=>$article,'new_article' => $new_article,'hot_article' => $hot_article]);
        return view('newtpl.home',['title'=>'博客首页','article'=>$article,'new_article' => $new_article,'hot_article' => $hot_article,'banner'=>$banner,'notice'=>$notice]);
    }
    
    //注册 
    public function register(Request $request)
    {
        if($request->isMethod('POST')){
            $this->validate($request,[
                "name"      =>  "required|unique:users",    // |unique:users 表示 检查users表是否存在此数据
                "phone"     =>  "required|unique:users",    // |unique:users 表示 检查users表是否存在此数据
                "captcha"   =>  "required",
                "password"  =>  "required"
            ],[
                "name.required"     =>"请务必填写名称",
                "password.required" =>"请务必填写密码",
                "phone.required"    =>"请务必填写手机号",
                "name.unique"       =>"该名称已经被使用",
                "phone.unique"      =>"该号码已经被使用",
                "captcha.required"  =>"请务必填写验证码",
            ]);
            $ispass = captcha_check($request->captcha); //返回bool
            if($ispass){
                $user = User::forceCreate([
                    'name' => $request->name,
                    'phone' => $request->phone,
                    'password' => $request->password,
                ]);
                if($user){
                    /*
                     * 更新登录次数 保存登录信息到session
                     */
                    $dbuser = User::where('id',$user->id)->first();
                    $dbuser->increment('login_number');

                        session()->put('user_id', $dbuser->id);
                        session()->put('user_name', $dbuser->name);
                        session()->put('user_state', $dbuser->state);
                        session()->put('user_level', $dbuser->level);
                        session()->put('user_phone', $dbuser->phone);
                        session()->put('user_login_number', $dbuser->login_number);

                }

                return redirect("/");
            }else{
                return back()->with("captcha","验证码不正确")->with("pageMsg","注册失败")->with("level","fail");
            }


        }else{

            return view('web.register',['title'=>'注册','page'=>'register']);
        }

    }
    
    //登录 
    public function login(Request $request)
    {
        if($request->isMethod('POST')){
            $this->validate($request,[
                "name"  =>  "required",
                "password"  =>  "required"
            ],[
                "name.required"     =>"请务必填写名称",
                "password.required" =>"请务必填写密码",
            ]);

            $validator = Validator::make($request->all(), []);
            $user = User::where('name','=',$request->name)->orWhere('phone','=',$request->name)->first();

            if($user){
                if(!Hash::check($request->password, $user->password)){
                    $validator->errors()->add("password","密码错误");
                }else{
                    $user->increment('login_number');
                    session()->put('user_id', $user->id);
                    session()->put('user_name', $user->name);
                    session()->put('user_state', $user->state);
                    session()->put('user_level', $user->level);
                    session()->put('user_phone', $user->phone);
                    session()->put('user_login_number', $user->login_number);
                    return redirect("/");
                }

            }else{
                $validator->errors()->add("name","账号不存在");
            }

            return back()->withErrors($validator)->withInput();

        }else{
            return view('web.register',['title'=>'登录','page'=>'login']);
        }

    }
    
    //退出登录 
    public function logout()
    {
        session()->forget('user_id');
        session()->forget('user_name');
        session()->forget('user_state');
        session()->forget('user_level');
        session()->forget('user_phone');
        session()->forget('user_login_number');
        return redirect("/");
    }

    //关于我
    public function about()
    {

        return view('web.about',['title'=>'关于我']);
    }

    /*
     * 搜索
     */
    public function search(Request $request)
    {
        $keyword = $request->keyword;
        if(empty($keyword)){
            return back();
        }
        //搜索结果
        $articles = Article::where('name','like','%'.$keyword.'%')->orWhere('title','like','%'.$keyword.'%')->orWhere('description','like','%'.$keyword.'%')->orderBy('id','desc')->paginate(10);
        foreach($articles as $key=>$item){
            $cate = Category::where('id','=',$item->pid)->first();
            $articles[$key]['cate_name'] = $cate->name;
        }
        //点击排行
        $hot_article = Article::take(5)->orderBy('click','desc')->get();//点击排行5篇
        return view('newtpl.search',[
            'title'=>'搜索结果',
            'keyword'=>$keyword,
            'articles'=>$articles,
            'hot_article' => $hot_article
        ]);
    }
    
}
