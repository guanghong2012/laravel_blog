<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Hash;
use App\Models\Admin;//这个必须有，引入model，不然无法获取数据库数据

class IndexController extends Controller
{
    /*
     * 后台首页
     */
    public function index()
    {
        /**
         * 系统信息
         */
        $statistics['os'] = PHP_OS;
        $statistics['software'] = $_SERVER["SERVER_SOFTWARE"];
        $statistics['sapi'] = php_sapi_name();
        $statistics['upload_max'] = ini_get('upload_max_filesize');
        $statistics['time'] = date("Y年n月j日 H:i:s",time());
        $statistics['server_name'] = $_SERVER['SERVER_NAME'] . ' [ ' . gethostbyname($_SERVER['SERVER_NAME']) . ' ]';
        $statistics['space'] = round((disk_free_space(".") / (1024 * 1024)), 2) . 'M';
        return view('admin/Index/index',['title' => '后台首页','statistics' => $statistics]);
    }
    
    /*
     * 后台登录
     */
    public function login()
    {
        return view('admin/Index/login',['title' => '后台登录']);
    }

    /*
     * 处理后台登录
     */
    public function dologin(Request $request)
    {
        $this->validate($request,[
            "adm_name"  =>  "required",
            "adm_password"  =>  "required"
        ],[
            "adm_name.required"     =>"请务必填写账号",
            "adm_password.required" =>"请务必填写密码",
        ]);

        $validator = Validator::make($request->all(), []);
        $admin = Admin::where('adm_name','=',$request->adm_name)->first();
        if($admin){
            if(!Hash::check($request->adm_password, $admin->adm_password)){
                $validator->errors()->add("adm_password","密码错误");
            }else{
                //密码通过 存储用户登录信息 更新用户表
                $admin->login_time = time();
                $admin->login_ip = $request->ip();//获取当前用户ip
                $admin->save();

                session()->put('adm_user_id', $admin->id);
                session()->put('adm_role_id', $admin->role_id);
                session()->put('adm_is_effect', $admin->role_id);
                session()->put('adm_login_ip', $admin->login_ip);
                return redirect("newwebadmin/index");
            }
        }else{
            $validator->errors()->add("adm_name","账号不存在");
        }

        return back()->withErrors($validator)->withInput();

    }
    
    
    
}
