<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\User;//这个必须有，引入model，不然无法获取数据库数据
use Hash;
use Illuminate\Support\Facades\Input;

class UserController extends Controller
{
    //用户列表  路由 newwebadmin/user
    public function index(Request $request)
    {
        $input = $request;
        if($input->name){
            $users = User::where('name','like','%'.$input->name.'%')->orderBy('id','desc')->paginate(10);
        }elseif($input->phone){
            $users = User::where('phone','like','%'.$input->phone.'%')->orderBy('id','desc')->paginate(10);
        }else{
            $users = User::orderBy('id','desc')->paginate(10);
        }

        return view('admin/User/index',['title' => '用户列表','user_active' => 'active','users' => $users]);
    }

    //用户编辑 get newwebadmin/user/{id}/edit
    public function edit($id)
    {
        if(!$id){
            return back();
        }
        $user = User::where('id','=',$id)->first();

        return view('admin/User/edit',['title' => '编辑会员','user_active' => 'active','user' => $user]);
    }
    //用户更新 put/patche (需要在表单里面用一个隐藏的<input name="_method" type="hidden" value="put" />) newwebadmin/user/{id}
    public function update($id)
    {
        if(!$id){
            return back();
        }
        $user = User::where('id','=',$id)->first();
        $input = Input::all();
        $name = $input['name'];
        $email = $input['email'];
        $phone = $input['phone'];
        $password = $input['user_pwd'];
        $user_confirm_pwd = $input['user_confirm_pwd'];
        $state = $input['is_effect'];
        if(empty($name)){
            return back()->with('pageMsg','用户名不能为空！')->withInput();
        }
        if(!empty($password)){
            if(strlen($password)<6){
                return back()->with('pageMsg','密码长度不能小于6！')->withInput();
            }
            if($password != $user_confirm_pwd){
                return back()->with('pageMsg','确认密码与密码不一致！')->withInput();
            }
            $user->password = Hash::make($password);
        }

        $user->name = $name;
        $user->email = $email;
        $user->phone = $phone;
        $user->is_effect = $state;
        $update = $user->update();
        if($update){
            return redirect('newwebadmin/user/'.$id.'/edit')->with('pageSuccess','修改成功！');
        }else{
            back()->with('pageMsg','修改失败！')->withInput();
        }
    }
    //用户删除 delete newwebadmin/user/{id}   一般使用ajax删除 需要带一个参数过来 _method=delete
    public function destroy($id)
    {
        $num = User::find($id)->delete();
        if($num){
            return response()->json(array('msg'=> '删除成功','status'=>1), 200);
        }else{
            return response()->json(array('msg'=> '删除失败','status'=>0), 200);
        }
    }

    /*
     * 用户添加
     * 路由方法：get
     * 路由：newwebadmin/user/create
     */
    public function create()
    {
        return view('admin/User/add',['title' => '会员添加','user_active' => 'active']);
    }

    /*
     * 会员添加保存操作
     * 路由方法：post
     * 路由：newwebadmin/user
     */
    public function store(Request $request)
    {

        $data = $request->all();
        $this->validate($request,[
            'name' => 'required|unique:users',
            'email' => 'email|unique:users',
            'phone' => 'regex:/^1[34578][0-9]{9}$/|unique:users',
            'password' => 'required|between:6,20|confirmed',
        ],[
            "name.required" => "会员名称不能为空",
            "name.unique" => "该会员名称已存在",
            "email.email" => "请填写正确的邮箱地址",
            "email.unique" => "该邮箱地址已存在",
            "phone.regex" => "请填写正确的手机号码",
            "phone.unique" => "该手机号码已存在",
            "password.required" => "密码不能为空",
            "password.between" => "密码必须在6-20位之间",
            "password.confirmed" => "确认密码与新密码不一致",

        ]);

        $user = User::forceCreate([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
            'is_effect' => $data['is_effect']
        ]);
        if($user){
            return redirect('newwebadmin/user/create')->with('pageSuccess','会员添加成功！');
        }else{
            back()->with('pageMsg','添加失败！')->withInput();
        }

    }
    
    
}
