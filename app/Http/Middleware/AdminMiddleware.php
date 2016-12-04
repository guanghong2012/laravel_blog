<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //判断后台用户是否登录
        if(!Session::has('adm_user_id')){
            return redirect('newwebadmin/login');
        }
        return $next($request);
    }
}
