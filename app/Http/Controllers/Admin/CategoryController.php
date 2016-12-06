<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Category;//这个必须有，引入model，不然无法获取数据库数据
class CategoryController extends Controller
{
    //分类列表 路由 newwebadmin/category
    public function index(Request $request)
    {
        $input = $request;
        if($input->name){
            $categorys = Category::where('name','like','%'.$input->name.'%')->orderBy('id','desc')->paginate(10);
        }else{
            $categorys = Category::orderBy('id','desc')->paginate(10);
        }

        return view('admin/User/index',['title' => '分类列表','category_active' => 'active','categorys' => $categorys]);
    }

}
