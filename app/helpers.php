<?php
/**
 * 公共函数库
 * Created by PhpStorm.
 * User: 曙光
 * Date: 2016/11/28
 * Time: 10:44
 */
if (! function_exists('spit')) {
    /**
     * @name        spit
     * @DateTime    ${DATE}
     * @param       .$data      array
     * @param       .$status    int
     * @param       .$message   string
     * @return      array.
     * @version     1.0
     * @author      < 18681032630@163.com >
     */
    function spit($data=[], $status = 200, $message = "success")
    {
        return [
            "status"    => $status,
            "message"   => $message,
            "result"    =>  $data,
        ];
    }

}