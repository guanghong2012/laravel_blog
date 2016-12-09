<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Hash;
use App\Models\Admin;//这个必须有，引入model，不然无法获取数据库数据
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

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
        $statistics['time'] =  Carbon::createFromDate();
        $statistics['server_name'] = $_SERVER['SERVER_NAME'] . ' [ ' . gethostbyname($_SERVER['SERVER_NAME']) . ' ]';
        $statistics['space'] = round((disk_free_space(".") / (1024 * 1024)), 2) . 'M';
        return view('admin/Index/index',['title' => '后台首页','statistics' => $statistics,'dashboard_active'=>'active']);
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

    /*
     * 图片上传
     */
    public function imageupload(Request $request)
    {
        $t_name = $request->input('t_name');//要传回到模板的目标id
        $show_name = $request->input('show_name');//要展示图片的目标id
        if($request->isMethod('POST')){

            //文件是否上传成功
            $file = $request->file('source');
            if($file->isValid()){
                //原文件名
                $originalName = $file->getClientOriginalName();
                //扩展名
                $ext = $file->getClientOriginalExtension();
                //type
                $type = $file->getClientMimeType();
                //临时绝对路径
                $realpath = $file->getRealPath();

                $filename = date('YmdHis').'-'.uniqid().'.'.$ext;

                $bool = Storage::disk('public')->put($filename,file_get_contents($realpath));//这里选择的是自定义的磁盘uploads上传

                if($bool){
                    //echo '文件上传成功,你可以在此进行文件的压缩，截取操作';
                    $datepath = date('Ymd');
                    $newsavepath = 'attachment/'.$datepath;//自定义文件保存路径
                    if(!is_dir($newsavepath)){
                        mkdir($newsavepath,775,true);
                    }
                    $makepath = str_replace("\\","/",public_path('attachment'));//文件保存路径 storage/app/uploads/

                    $files = storage_path('app/public').'/'.$filename;//使用框架自带上传功能上传后文件保存的物理路径
                    $makefiles = $makepath.'/'.$datepath.'/'.$filename;//最后生成文件的物理路径

                    //$img = Image::make($files)->resize(300, 200)->save($makefiles);// 修改指定图片的大小
                    $img = Image::make($files)->save($makefiles);//不修改图片大小 直接保存 使用 Intervention 插件处理文件

                    unlink($files);//删除 使用框架自带上传功能上传后保存的文件
                    if($img){
                        $returnpath = '/'.$newsavepath.'/'.$filename;//要保存到数据库的文件目录

                        echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">';
                        echo '<SCRIPT>
                                    alert("上传成功！");
                                    parent.opener.document.getElementById("id_'.$t_name.'").value="'.$returnpath.'";
                                    parent.opener.document.getElementById("img_'.$show_name.'").src="'.$returnpath.'";
                                    parent.window.close();
                                </SCRIPT>';
                        exit;
                    }


                }else{
                    echo '文件上传失败';
                }


            }

        }else{
            //echo public_path();

            return view('admin.imageupload',['t_name'=>$t_name,'show_name'=>$show_name]);
        }
    }

    /*
     * 图片删除
     */
    public function delimage(Request $request)
    {
        $images_path = $request->input('images_path');
        $tablename = $request->input('tablename');
        $info = DB::table($tablename)->where('images','=',$images_path)->first();
        if($info){
            $num = DB::table($tablename)->where('images','=',$images_path)->update(['images'=>'']);
        }
        $res = unlink('.'.$images_path);
        if($res){
            return response()->json(array('msg'=> '删除成功','status'=>1), 200);
        }else{
            return response()->json(array('msg'=> '删除失败','status'=>0), 200);
        }
    }



}
