<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Admin;//这个必须有，引入model，不然无法获取数据库数据

class AdminUserController extends Controller
{
    //后台用户列表
    public function index()
    {
        $list = Admin::orderBy('id','asc')->get()->toArray();

        return view('admin/AdminUser/index',['title' => '管理员列表','list' => $list]);
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

        }else{
            $info = Admin::where('id','=',$id)->first();

            return view('admin/AdminUser/edit',['title' => '编辑管理员','info' => $info]);
        }
    }


}
