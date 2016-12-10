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
            $array[$k]['add_url'] = url('newwebadmin/category/create');
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
                                    <a class='btn btn-danger btn-xs gallery-tool' href='javascript:foreverdel(9)'><i class='icon-trash'>删除</i></a>
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
    public function create()
    {
        //文章分类
        $article_cate = Category::get()->toArray();
        $tree = new Tree;           // new 之前请记得包含tree文件!
        $tree->init($article_cate);        // 数据格式请参考 tree方法上面的注释!
        $str = "<option value=\$id >\$spacer\$name</option>"; //这个是没有选中的写法 传入数组中 selected 值可选
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

}
