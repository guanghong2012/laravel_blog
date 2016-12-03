<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

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
        $statistics['time'] = date("Y年n月j日 H:i:s",time());
        $statistics['server_name'] = $_SERVER['SERVER_NAME'] . ' [ ' . gethostbyname($_SERVER['SERVER_NAME']) . ' ]';
        $statistics['space'] = round((disk_free_space(".") / (1024 * 1024)), 2) . 'M';

        return view('admin/Index/index',['title' => '后台首页','statistics' => $statistics]);
    }
}
