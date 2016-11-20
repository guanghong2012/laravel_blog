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
        <link href="css/index.css" rel="stylesheet">
    @show

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
    <div>
    <nav class="topnav" id="topnav">
        <a href="index.html"><span>首页</span><span class="en">Protal</span></a>
        <a href="about.html"><span>关于我</span><span class="en">About</span></a>
        <a href="newlist.html"><span>慢生活</span><span class="en">Life</span></a>
        <a href="moodlist.html"><span>碎言碎语</span><span class="en">Doing</span></a>
        <a href="share.html"><span>模板分享</span><span class="en">Share</span></a>
        <a href="knowledge.html"><span>学无止境</span><span class="en">Learn</span></a>
        <a href="book.html"><span>留言版</span><span class="en">Gustbook</span></a>
    </nav>

    <div class="login-nav">
        <a href="" rel="nofollow" class="register btn rbtn">
            <span class="text"> 注册</span>
        </a>
        <a href="" rel="nofollow" class="login btn wbtn">
            <span class="text"> 登录</span>
        </a>
    </div>
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
