<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Admin;//这个必须有，引入model，不然无法获取数据库数据
use Hash;

class AdminUserController extends Controller
{
    //后台用户列表
    public function index()
    {
        $list = Admin::orderBy('id','asc')->get()->toArray();

        return view('admin/AdminUser/index',['title' => '管理员列表','list' => $list ,'adminuser_active' => 'active']);
    }

    /*
     * 用户编辑
     */
    public function edit(Request $request,$id)
    {

        if(!$id){
            return back();
        }
        if($request->isMethod('POST') ){
            $id = $request->input('id');
            $adm_pass = $request->input('adm_password');
            $adm_password2 = $request->input('adm_password2');
            $adm_name = $request->input('adm_name');
            $role_id = $request->input('role_id') ? $request->input('role_id') : 0;
            $is_effect = $request->input('is_effect') ? $request->input('is_effect') : 0;

            $admin = Admin::where('id','=',$id)->first();
            if(strlen($adm_pass)>0 && strlen($adm_pass)<6){
                return back()->with('pageMsg','密码长度必须大于等于6！');
            }
            if(strlen($adm_pass)>=6){
                if($adm_pass == $adm_password2){
                    $admin->adm_password = Hash::make($adm_pass);//哈希加密
                }else{
                    return back()->with("pageMsg","确认密码与输入密码不一致！");
                }
            }
            if(strlen($adm_name)>0){
                $admin->adm_name = $adm_name;
            }
            $admin->role_id = $role_id;
            $admin->is_effect = $is_effect;
            $admin->save();
            return redirect('newwebadmin/admin_user_index');
        }else{
            $info = Admin::where('id','=',$id)->first();

            return view('admin/AdminUser/edit',['title' => '编辑管理员','info' => $info,'adminuser_active' => 'active' ]);
        }
    }

    /*
     * 管理员添加
     */
    public function add(Request $request)
    {
        if($request->isMethod('POST')){
            $adm_name = $request->input('adm_name');
            $adm_pass = $request->input('adm_password');
            $adm_password2 = $request->input('adm_password2');
            $role_id = $request->input('role_id') ? $request->input('role_id') : 0;
            $is_effect = $request->input('is_effect') ? $request->input('is_effect') : 0;
            if(empty($adm_name)){
                return back()->with("pageMsg","请输入管理员账号！");
            }
            //检查是否已存在该用户
            $is_exist = Admin::where('adm_name','=',$adm_name)->first();
            if($is_exist){
                return back()->with("pageMsg","改管理员账号已存在，请重新填写！")->withInput();
            }
            if(empty($adm_pass)){
                return back()->with("pageMsg","请输入管理员密码！")->withInput();
            }
            if(strlen($adm_pass)<6){
                return back()->with("pageMsg","密码长度必须大于等于6！")->withInput();
            }
            if(!empty($adm_pass) && ($adm_pass != $adm_password2)){
                return back()->with("pageMsg","确认密码与输入密码不一致！")->withInput();
            }

            $admin = Admin::forceCreate([
                'adm_name' => $adm_name,
                'adm_password' => Hash::make($adm_pass),//哈希加密
                'is_effect' => $is_effect,
                'role_id' => $role_id
            ]);
            if($admin){
                return redirect('newwebadmin/admin_user_index');
            }else{
                return back()->with("pageMsg","添加失败！")->withInput();
            }

        }else{
            return view('admin/AdminUser/add',['title' => '管理员添加','adminuser_active' => 'active']);
        }
    }


}
