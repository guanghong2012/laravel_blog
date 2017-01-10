<?php

namespace App\Http\Controllers\Admin;

use App\Models\Navigation;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class NavigationController extends Controller
{
    //列表
    public function index(Request $request)
    {
        $input = $request;
        if($input->name){
            $navs = Navigation::where('name','like','%'.$input->name.'%')->orderBy('id','desc')->paginate(10);
        }else{
            $navs = Navigation::orderBy('sort','desc')->paginate(10);
        }

        return view('admin/Navigation/index',['title' => '导航列表','nav_active' => 'active','navs' => $navs]);
    }
    /*
     * 添加导航
     * 路由：newwebadmin/navigation/create
     */
    public function create()
    {
        return view('admin/Navigation/add',['title' => '导航添加','nav_active' => 'active']);
    }

    /*
     * 轮播添加保存操作
     * 路由方法：post
     * 路由：newwebadmin/navigation
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $this->validate($request,[
            'name' => 'required',
            'url' => 'required',
            'model' => 'required'
        ],[
            "name.required" => "导航名称不能为空",
            "url.required" => "导航链接不能为空",
            "model.required" => "模块名称不能为空",
        ]);

        unset($data['_token']);
        $nav = Navigation::create($data);
        if($nav){
            return redirect('newwebadmin/navigation/create')->with('pageSuccess','添加成功！');
        }else{
            back()->with('pageMsg','添加失败！')->withInput();
        }

    }

    /*
     * 导航编辑
     * 路由：get newwebadmin/navigation/{id}/edit
     */
    public function edit($id)
    {
        if(!$id){
            return back();
        }
        $nav = Navigation::where('id','=',$id)->first();
        return view('admin/Navigation/edit',['title' => '编辑导航','nav_active' => 'active','nav' => $nav]);
    }

    /*
     * 轮播图更新
     * put/patche (需要在表单里面用一个隐藏的<input name="_method" type="hidden" value="put" />) newwebadmin/banner/{id}
     */
    public function update(Request $request,$id)
    {
        if(!$id){
            return back();
        }
        $data = $request->all();
        $this->validate($request,[
            'name' => 'required',
            'url' => 'required',
            'model' => 'required'
        ],[
            "name.required" => "导航名称不能为空",
            "url.required" => "导航链接不能为空",
            "model.required" => "模块名称不能为空",

        ]);

        $nav = Navigation::where('id','=',$id)->first();
        unset($data['_token']);
        unset($data['_method']);
        if($nav->update($data)){
            return redirect('newwebadmin/navigation/'.$id.'/edit')->with('pageSuccess','更新成功！');
        }else{
            back()->with('pageMsg','更新失败！')->withInput();
        }
    }

    /*
     * 删除
     * delete
     * newwebadmin/navigation/{id}
     */
    public function destroy($id)
    {
        $num = Navigation::destroy([$id]);
        if($num>0){
            return response()->json(array('msg'=> '删除成功','status'=>1), 200);
        }else{
            return response()->json(array('msg'=> '删除失败','status'=>0), 200);
        }
    }
}
