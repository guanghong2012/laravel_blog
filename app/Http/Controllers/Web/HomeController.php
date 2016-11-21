<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\User;//这个必须有，引入model，不然无法获取数据库数据
use Illuminate\Support\Facades\Validator;
use Hash;

class HomeController extends Controller
{
    //首页
    public function index()
    {

        return view('web.home',['title'=>'博客首页']);
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
    
    
}
