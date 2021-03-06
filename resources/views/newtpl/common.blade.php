<!doctype html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{@$title}} - {{ Config::get('app.name') }}</title>
    <meta name="keywords" content="曙光的博客" />
    <meta name="description" content="曙光的博客" />
    <link rel="stylesheet" type="text/css" href="{{asset('newtpl/css/bootstrap.min.css')}}">
    <!--<link rel="stylesheet" type="text/css" href="css/nprogress.css">禁止调试与浏览器右键-->
    <link rel="stylesheet" type="text/css" href="{{ asset('newtpl/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('newtpl/css/font-awesome.min.css') }}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('newtpl/images/icon.png') }}">
    <link rel="shortcut icon" href="{{ asset('newtpl/images/favicon.ico') }}">
    <script src="{{ asset('newtpl/js/jquery-2.1.4.min.js') }}"></script>
    <!--<script src="js/nprogress.js"></script> 禁止调试与浏览器右键-->
    <script src="{{ asset('newtpl/js/jquery.lazyload.min.js') }}"></script>
    <!--[if gte IE 9]>
    <script src="{{ asset('newtpl/js/jquery-1.11.1.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('newtpl/js/html5shiv.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('newtpl/js/respond.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('newtpl/js/selectivizr-min.js') }}" type="text/javascript"></script>
    <![endif]-->
    <!--[if lt IE 9]>
    <script>window.location.href='upgrade-browser.html';</script>
    <![endif]-->
    @section('css')

    @show
</head>

<body class="user-select">
@section('header')
<header class="header">
    <nav class="navbar navbar-default" id="navbar">
        <div class="container">
            <div class="header-topbar hidden-xs link-border">
                <ul class="site-nav topmenu">
                    <li><a href="#">标签云</a></li>
                    <li><a href="#" rel="nofollow">读者墙</a></li>
                    <li><a href="#" rel="nofollow">友情链接</a></li>
                    <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" rel="nofollow">关注本站 <span class="caret"></span></a>
                        <ul class="dropdown-menu header-topbar-dropdown-menu">
                            <li><a data-toggle="modal" data-target="#WeChat" rel="nofollow"><i class="fa fa-weixin"></i> 微信</a></li>
                            <li><a href="#" rel="nofollow"><i class="fa fa-weibo"></i> 微博</a></li>
                            <li><a data-toggle="modal" data-target="#areDeveloping" rel="nofollow"><i class="fa fa-rss"></i> RSS</a></li>
                        </ul>
                    </li>
                </ul>
                @if( ! Session::get('user_id'))
                <a data-toggle="modal" data-target="#loginModal" class="login" rel="nofollow">Hi,请登录</a>&nbsp;&nbsp;
                <a href="{{url('register')}}" class="register" rel="nofollow">我要注册</a>&nbsp;&nbsp;
                <a href="{{url('login')}}" rel="nofollow">我要登录</a>
                @else
                    <a  rel="nofollow">欢迎您,{{ Session::get('user_name') }}</a>&nbsp;&nbsp;
                    <a href="{{url('logout')}}" class="register" rel="nofollow">退出登录</a>&nbsp;&nbsp;

                @endif
            </div>
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#header-navbar" aria-expanded="false"> <span class="sr-only"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                <h1 class="logo hvr-bounce-in"><a href="{{ url('/') }}" title=""><img src="{{ asset('newtpl/picture/logo.png') }}" alt=""></a></h1>
            </div>
            <div class="collapse navbar-collapse" id="header-navbar">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden-index {{ isset($active['home']) ? $active['home'] : '' }}"><a data-cont="首页" href="{{url('/')}}">首页</a></li>
                    @foreach($navitators as $key=>$val)
                    <li class="{{ isset($active[$val->model]) ? $active[$val->model] : '' }}"><a href="{{ $val->url }}" @if($val->is_blank)target="_blank" @endif >{{ $val->name }}</a></li>
                    @endforeach
                    <!--<li><a href="{{ url('about') }}" target="_blank">关于我</a></li>
                    <li><a href="{{ url('comment') }}">留言版</a></li>-->
                </ul>
                <form class="navbar-form visible-xs" action="{{ url('search') }}" method="post">
                    {{ csrf_field() }}
                    <div class="input-group">
                        <input type="text" name="keyword" class="form-control" placeholder="请输入关键字" maxlength="20" autocomplete="off">
            <span class="input-group-btn">
            <button class="btn btn-default btn-search" name="search" type="submit">搜索</button>
            </span> </div>
                </form>
            </div>
        </div>
    </nav>
</header>
@show

@section('container')

@show

@section('footer')
<footer class="footer">
    <div class="container">
        <p>&copy; 2016 <a href="">ylsat.com</a> &nbsp; <a href="http://www.miitbeian.gov.cn/" target="_blank" rel="nofollow">豫ICP备20151109-1</a> &nbsp; <a href="sitemap.xml" target="_blank" class="sitemap">网站地图</a></p>
    </div>
    <div id="gotop"><a class="gotop"></a></div>
</footer>
@show

@section('toplet')
<!--微信二维码模态框-->
<div class="modal fade user-select" id="WeChat" tabindex="-1" role="dialog" aria-labelledby="WeChatModalLabel">
    <div class="modal-dialog" role="document" style="margin-top:120px;max-width:280px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="WeChatModalLabel" style="cursor:default;">微信扫一扫</h4>
            </div>
            <div class="modal-body" style="text-align:center"> <img src="{{ asset('newtpl/picture/weixin.jpg') }}" alt="" style="cursor:pointer"/> </div>
        </div>
    </div>
</div>
<!--该功能正在日以继夜的开发中-->
<div class="modal fade user-select" id="areDeveloping" tabindex="-1" role="dialog" aria-labelledby="areDevelopingModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="areDevelopingModalLabel" style="cursor:default;">该功能正在日以继夜的开发中…</h4>
            </div>
            <div class="modal-body"> <img src="{{ asset('newtpl/picture/baoman_01.gif') }}" alt="深思熟虑" />
                <p style="padding:15px 15px 15px 100px; position:absolute; top:15px; cursor:default;">很抱歉，程序猿正在日以继夜的开发此功能，本程序将会在以后的版本中持续完善！</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">朕已阅</button>
            </div>
        </div>
    </div>
</div>
@show

@section('plugin')
<!--登录注册模态框-->
<div class="modal fade user-select" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="/Admin/Index/login" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="loginModalLabel">登录</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="loginModalUserNmae">用户名</label>
                        <input type="text" class="form-control" id="loginModalUserNmae" placeholder="请输入用户名" autofocus maxlength="15" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="loginModalUserPwd">密码</label>
                        <input type="password" class="form-control" id="loginModalUserPwd" placeholder="请输入密码" maxlength="18" autocomplete="off" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <button type="submit" class="btn btn-primary">登录</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--注册-->
<div class="modal fade user-select" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="/Admin/Index/login" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="loginModalLabel">登录</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="loginModalUserNmae">用户名</label>
                        <input type="text" class="form-control" id="loginModalUserNmae" placeholder="请输入用户名" autofocus maxlength="15" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="loginModalUserPwd">密码</label>
                        <input type="password" class="form-control" id="loginModalUserPwd" placeholder="请输入密码" maxlength="18" autocomplete="off" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <button type="submit" class="btn btn-primary">注册</button>
                </div>
            </form>
        </div>
    </div>
</div>
@show
<!--右键菜单列表-->
<div id="rightClickMenu">
    <ul class="list-group rightClickMenuList">
        <li class="list-group-item disabled">欢迎访问曙光博客</li>
        <li class="list-group-item"><span>IP：</span>172.16.10.129</li>
        <li class="list-group-item"><span>地址：</span>广东省广州市</li>
        <li class="list-group-item"><span>系统：</span>Windows10 </li>
        <li class="list-group-item"><span>浏览器：</span>Chrome47</li>
    </ul>
</div>


@section('script')
<script src="{{ asset('newtpl/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('newtpl/js/jquery.ias.js') }}"></script>
<script src="{{ asset('newtpl/js/scripts.js') }}"></script>
@show
</body>
</html>