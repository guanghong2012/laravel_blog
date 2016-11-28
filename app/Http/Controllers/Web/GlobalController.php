<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class GlobalController extends Controller
{
    /**
     * 获取图片验证码
     * @name        getCaptchaSrc
     * @DateTime    ${DATE}
     * @param       .
     * @return      Json
     * @version     1.0
     * @author      < 曙光 >
     */
    public function getCaptcha()
    {
        return response()->json(spit([
            "src"   => captcha_src(),
            "img"   => captcha_img(),
        ]));
    }
}
