<?php

namespace App\Http\Controllers\Admin;

use App\Models\Comment;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    //留言列表
    public function index()
    {
        $comments = Comment::orderBy('id','desc')->paginate(10);

        return view('admin/Comment/index',['title'=>'留言列表','comment_active' => 'active','comments'=>$comments,]);
    }

    //删除
    public function delete(Request $request)
    {
        $id = $request->input('id');
        $res = Comment::where('id','=',$id)->first();
        if($res){
            $delete = Comment::where('id','=',$id)->delete();
            if($delete){
                return response()->json(array('msg'=> '删除成功','status'=>1), 200);
            }
        }else{
            return response()->json(array('msg'=> '信息不存在或已删除','status'=>0), 200);
        }
    }

}
