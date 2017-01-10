<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Comment;//这个必须有，引入model，不然无法获取数据库数据
class CommentController extends Controller
{
    public $module = 'comment'; // 标识当前模块为'comment'
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }
    //留言板
    public function comment(Request $request)
    {
        if($request->isMethod('POST')){
            $this->validate($request,[
                "name"      =>  "required",
                "email"     =>  "required",
                "phone"     =>  "required",
                "captcha"   =>  "required",
                "comment"   => "required"
            ],[
                "name.required"     =>"请填写您的名称",
                "email.required" =>"请填写您的邮箱地址",
                "phone.required"    =>"请填写手机号",
                "captcha.required"  =>"请填写验证码",
                "comment.required"  =>"请输入您的留言内容",
            ]);
            $ispass = captcha_check($request->captcha); //返回bool
            if($ispass){
                $comments = Comment::forceCreate([
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'comment' => $request->comment,
                    'addtime' => time()

                ]);
                if($comments){
                    return redirect('/');
                }

            }else{
                return back()->with("pageMsg","留言失败")->with("level","fail");
            }

        }else{
            //return view('web.comment',['title' => '留言板']);
            return view('newtpl.comment',['title' => '留言板']);
        }

    }
}
