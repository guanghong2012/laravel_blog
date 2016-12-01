<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="images/{{ Config::get('app.icon') }}" type="image/x-icon">
    <link rel="icon" href="images/{{ Config::get('app.icon') }}" type="image/x-icon">
    <title>{{@$title}} - {{ Config::get('app.name') }}</title>
    <meta name="keywords" content="曙光的博客" />
    <meta name="description" content="曙光的博客" />
    <link href="{{asset('css/base.css')}}" rel="stylesheet">
    @section('css')
        <link href="{{asset('css/index.css')}}" rel="stylesheet">
    @show
    <style>
        #logo {    width: 260px;
            height: 60px;
            float: left;}
        .login-nav {
            display: inline-block;
            float: left;
            margin: 20px 0 0 8px;
            line-height: 48px;
        }
        .btn {
            display: inline-block;
            line-height: 1;
            border-radius: 2px;
            font-size: 14px;
            padding: 0 8px;
            height: 28px;
            line-height: 28px;
            background: #fff;
            background: linear-gradient( #FAFAFA, #F2F2F2);
            border: 1px solid #D9D9D9;
            cursor: pointer;
            text-decoration: none;
            color: #444;
            white-space: nowrap;
            -moz-user-select: none;
            -webkit-user-select: none;
            user-select: none;
            text-shadow: 0 1px 0 rgba(255,255,255,.5);
            text-align: center;
        }
        .rbtn {
            background: #E53E49;
            background: linear-gradient( #E53E49, #D43636);
            box-shadow: inset 0 1px 0 rgba(255,255,255,.08),0 1px 0 rgba(255,255,255,.3);
            text-shadow: 0 -1px 0 rgba(0,0,0,.1);
            color: #fff!important;
            border: 1px solid #C90000;
        }
    </style>
    <!--[if lt IE 9]>
    <script src="{{asset('js/modernizr.js')}}"></script>
    <![endif]-->
        <script src="{{asset('js/silder.js')}}"></script>
    @section('script')

    @show
</head>
<body>
<header>
    <div id="logo"><a href="/"></a></div>

    <nav class="topnav" id="topnav">
        <a href="{{url('/')}}"><span>首页</span><span class="en">Protal</span></a>
        <a href="{{ url('about') }}" target="_blank"><span>关于我</span><span class="en">About</span></a>
        <a href="share.html"><span>模板分享</span><span class="en">Share</span></a>
        <a href="knowledge.html"><span>学无止境</span><span class="en">Learn</span></a>
        @foreach($allcategorys as $key=>$val)
        <a href="{{ url('lists/pid/'.$val->id) }}"><span>{{ $val->name }}</span><span class="en">{{ $val->title }}</span></a>
        @endforeach
        <a href="{{ url('comment') }}"><span>留言版</span><span class="en">Gustbook</span></a>
    </nav>

    <div class="login-nav">
        @if( ! Session::get('user_id'))
        <a href="{{url('register')}}" rel="nofollow" class="register btn rbtn">
            <span class="text"> 注册</span>
        </a>
        <a href="{{url('login')}}" rel="nofollow" class="login btn wbtn">
            <span class="text"> 登录</span>
        </a>
        @else
            <a href="{{url('logout')}}" rel="nofollow" class="register btn rbtn">
                <span class="text"> 退出</span>
            </a>
            <a href="" rel="nofollow" class="login btn wbtn">
                <span class="text"> {{ Session::get('user_name') }}</span>
            </a>
        @endif
    </div>


</header>

@section('content')


@show

@section('footer')
<footer>
    <p>Design by 曙光科技 <a href="http://www.miitbeian.gov.cn/" target="_blank">http://www.houdunwang.com</a> <a href="/">网站统计</a></p>
</footer>
@show

</body>
</html>
