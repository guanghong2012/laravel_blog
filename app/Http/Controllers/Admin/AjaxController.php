<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class AjaxController extends Controller
{

    /*
     * 更改数据状态
     */
    public function set_effect()
    {
        $table = Input::get('table');
        $id = Input::get('id');
        if($table && $id){
            //根据传入的表名更改数据状态
            $table_info = DB::table($table)->where('id','=',$id)->first();
            if($table_info->is_effect == 1){
                $is_effect = 0;
                DB::update('update '.$table.' set is_effect = ? where id = ?',[$is_effect,$id]);//更新数据状态为 禁用状态
            }
            if($table_info->is_effect == 0){
                $is_effect = 1;
                DB::update('update '.$table.' set is_effect = ? where id = ?',[$is_effect,$id]);//更新数据状态为 正常状态
            }
            return response()->json(array('msg'=> '更新成功','is_effect'=>$is_effect), 200);
        }
    }
    
    /*
     * 根据表名与id删除数据
     */
    public function foreverdel()
    {
        $table = Input::get("table");
        $id = Input::get('id');
        $ids = explode(',',$id);
        if(!empty($ids)){
            foreach($ids as $k=>$v){
                if($v == 'on'){
                    unset($ids[$k]);
                }
            }
        }
        if(count($ids)==0){
            return response()->json(array('msg'=> '请选择要删除的数据','status'=>0), 200);
        }

        if($table && $ids){
            foreach($ids as $key=>$val){
                DB::table($table)->where('id','=',$val)->delete();
            }
        }
        return response()->json(array('msg'=> '批量删除成功','status'=>1), 200);
    }

}
