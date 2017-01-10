<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Banner;//这个必须有，引入model，不然无法获取数据库数据
class BannerController extends Controller
{
    //列表
    public function index(Request $request)
    {
        $input = $request;
        if($input->name){
            $banners = Banner::where('name','like','%'.$input->name.'%')->orderBy('id','desc')->paginate(10);
        }else{
            $banners = Banner::orderBy('sort','desc')->paginate(10);
        }

        return view('admin/Banner/index',['title' => '轮播列表','banner_active' => 'active','banners' => $banners]);
    }
    /*
     * 添加轮播图
     * 路由：newwebadmin/banner/create
     */
    public function create()
    {
        return view('admin/Banner/add',['title' => '轮播图添加','banner_active' => 'active']);
    }

    /*
     * 轮播添加保存操作
     * 路由方法：post
     * 路由：newwebadmin/banner
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $this->validate($request,[
            'name' => 'required',
        ],[
            "name.required" => "信息名称不能为空",
        ]);

        unset($data['_token']);
        $banner = Banner::create($data);
        if($banner){
            return redirect('newwebadmin/banner/create')->with('pageSuccess','添加成功！');
        }else{
            back()->with('pageMsg','添加失败！')->withInput();
        }

    }

    /*
     * 轮播图编辑
     * 路由：get newwebadmin/banner/{id}/edit
     */
    public function edit($id)
    {
        if(!$id){
            return back();
        }
        $banner = Banner::where('id','=',$id)->first();
        return view('admin/Banner/edit',['title' => '编辑轮播图','banner_active' => 'active','banner' => $banner]);
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

        ],[
            "name.required" => "文章名称不能为空",

        ]);

        $banner = Banner::where('id','=',$id)->first();
        unset($data['_token']);
        unset($data['_method']);
        if($banner->update($data)){
            return redirect('newwebadmin/banner/'.$id.'/edit')->with('pageSuccess','更新成功！');
        }else{
            back()->with('pageMsg','更新失败！')->withInput();
        }
    }

    /*
     * 删除
     * delete
     * newwebadmin/banner/{id}
     */
    public function destroy($id)
    {
        $banner = Banner::where('id','=',$id)->first();
        if(!empty($banner->images)){
            @unlink('.'.$banner->images);//删除图片
        }
        $num = Banner::destroy([$id]);
        if($num>0){
            return response()->json(array('msg'=> '删除成功','status'=>1), 200);
        }else{
            return response()->json(array('msg'=> '删除失败','status'=>0), 200);
        }
    }

}
