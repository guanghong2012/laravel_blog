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
    //用户列表
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

    //用户编辑
    public function edit($id)
    {
        if(!$id){
            return back();
        }
        $user = User::where('id','=',$id)->first();

        return view('admin/User/edit',['title' => '编辑会员','user_active' => 'active','user' => $user]);
    }
    //用户更新
    public function update($id)
    {
        $input = Input::all();
        var_dump($input);
    }
    //用户删除 
    public function destroy($id)
    {
        echo $id;
    }
    
    

}
