<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Category;//这个必须有，引入model，不然无法获取数据库数据
use Tree;
class CategoryController extends Controller
{
    //分类列表 路由 newwebadmin/category
    public function index(Request $request)
    {
        $categorys = Category::orderBy('sort','desc')->paginate(10);

        $array = $categorys->toArray();
        $array = $array['data'];
        foreach($array as $k=>$v){
            $array[$k]['url'] = url('newwebadmin/category/'.$v['id'].'/edit');
            $array[$k]['add_url'] = url('newwebadmin/category/create').'?pid='.$v['id'];
        }

        $tree = new Tree;

        $str = "<tr>
                                <td align='center'>
                                    <label>
                                        <input type='checkbox' value='\$id' name='key' class='ace' />
                                        <span class='lbl'></span>
                                    </label>
                                </td>
                                <td>\$id</td>
                                <td><span style='color:red;'>\$spacer</span>  \$name</td>
                                <td>\$title</td>
                                <td>\$sort</td>
                                <td>
                                    <div class='visible-md visible-lg hidden-sm hidden-xs btn-group'>
                                    <a class='btn btn-success btn-xs' href='\$add_url'><i class='icon-plus'>添加子菜单</i></a>
                                    <a class='btn btn-primary btn-xs' href='\$url'><i class='icon-edit'>编辑</i></a>
                                    <a class='btn btn-danger btn-xs gallery-tool' href='javascript:delcate(\$id)'><i class='icon-trash'>删除</i></a>
                                    </div>
                                </td>
                            </tr>";

        $tree->init($array);
        $select_menus = $tree->get_tree(0, $str);

        return view('admin/Category/index',['title' => '分类列表','category_active' => 'active','categorys' => $categorys,'select_menus'=>$select_menus]);
    }
    
    /*
     * 新建分类 
     */
    public function create(Request $request)
    {
        $pid = $request->input('pid');
        //文章分类
        $article_cate = Category::get()->toArray();

        foreach($article_cate as $k=>$r){
            $r['selected'] = $r['id'] == $pid ? 'selected="selected"' : '';

            $r['name'] = $r['name'];
            $array[] = $r;
        }

        $tree = new Tree;           // new 之前请记得包含tree文件!
        $tree->init($array);        // 数据格式请参考 tree方法上面的注释!
        $str = "<option value='\$id' \$selected >\$spacer\$name</option>"; //这个是没有选中的写法 传入数组中 selected 值可选
        $category = $tree->get_tree(0,$str);
        return view('admin/Category/add',['title'=>'新建分类','category_active' => 'active','category'=>$category]);
    }

    /*
     * 分类添加保存操作
     * 路由方法：post
     * 路由：newwebadmin/category
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $this->validate($request,[
            'name' => 'required',
            'title' => 'required',
        ],[
            'name.required' => '分类名称不能为空',
            'title.required' => '分类标题不能为空',
        ]);

        unset($data['_token']);

        $category = Category::create($data);
        if($category){
            return redirect('newwebadmin/category/create')->with('pageSuccess','分类添加成功！');
        }else{
            back()->with('pageMsg','添加失败！')->withInput();
        }

    }

    /*
     * 分类编辑
     * get
     * newwebadmin/category/{id}/edit
     */
    public function edit($id)
    {
        if(!$id){
            return back();
        }
        $info = Category::where('id','=',$id)->first();
        $pid = $info->pid;
        $category = Category::get()->toArray();

        foreach($category as $k=>$r){
            $r['selected'] = $r['id'] == $pid ? 'selected="selected"' : '';

            $r['name'] = $r['name'];
            $array[] = $r;
        }
        $tree = new Tree;
        $tree->init($array);
        $str  = "<option value='\$id' \$selected>\$spacer \$name</option>";
        $select_menus = $tree->get_tree(0, $str);

        return view('admin/Category/edit',['title'=>'分类编辑','category_active' => 'active','category'=>$select_menus,'info'=>$info]);
    }

    /*
     * 分类编辑保存
     * put/patche (需要在表单里面用一个隐藏的<input name="_method" type="hidden" value="put" />)
     * newwebadmin/category/{id}
     */
    public function update(Request $request,$id)
    {
        if(!$id){
            return back();
        }
        $data = $request->all();
        $this->validate($request,[
            'name' => 'required',
            'title' => 'required',
            'description' => 'required',

        ],[
            "name.required" => "分类名称不能为空",
            "title.required" => "分类标题不能为空",
            "description.required" => "分类描述不能为空",

        ]);
        unset($data['_token']);
        unset($data['_method']);
        $category = Category::where('id','=',$id)->first();
        if($category->update($data)){
            return redirect('newwebadmin/category/'.$id.'/edit')->with('pageSuccess','分类更新成功！');
        }else{
            back()->with('pageMsg','更新失败！')->withInput();
        }

    }

    /*
     * 删除
     * delete
     * newwebadmin/category/{id}
     */
    public function destroy($id)
    {
        $num = Category::destroy([$id]);
        if($num>0){
            return response()->json(array('msg'=> '删除成功','status'=>1), 200);
        }else{
            return response()->json(array('msg'=> '删除失败','status'=>0), 200);
        }
    }
    
    
}
