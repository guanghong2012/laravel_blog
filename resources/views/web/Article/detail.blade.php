@extends('layouts.common')
@section('css')
    <link href="{{asset('css/new.css')}}" rel="stylesheet">
@stop
@section('title')
    {{@$title}}
@stop

@section('content')
    <article class="blogs">
        <h1 class="t_nav"><span>您当前的位置：<a href="{{ url('/') }}">首页</a>&nbsp;&gt;&nbsp;<a href="{{ url('lists/pid/'.$category->id) }}">{{ $category->name }}</a></span><a href="{{ url('/') }}" class="n1">网站首页</a><a href="{{ url('lists/pid/'.$category->id) }}" class="n2">{{ $category->name }}</a></h1>
        <div class="index_about">
            <h2 class="c_titile">{{ $info->title }}</h2>
            <p class="box_c"><span class="d_time">发布时间：{{ substr($info->created_at,0,10) }}</span><span>编辑：曙光</span><span>查看次数：{{ $info->click }}</span></p>
            <ul class="infos">
                {!! $info->content !!}
            </ul>
            <div class="keybq">
                <p><span>关键字词</span>：{{ $info->keywords }}</p>

            </div>
            <div class="ad"> </div>
            <div class="nextinfo">
                @if($pre > 0)
                <p>上一篇：<a href="{{ url('detail/id/'.$pre) }}">{{ $pre_title }}</a></p>
                @else
                <p>上一篇：<a href="javascript:void(0)">{{ $pre_title }}</a></p>
                @endif
                @if($next >0)
                <p>下一篇：<a href="{{ url('detail/id/'.$next) }}">{{ $next_title }}</a></p>
                @else
                <p>下一篇：<a href="javascript:void(0)">{{ $next_title }}</a></p>
                @endif
            </div>
            <div class="otherlink">
                <h2>相关文章</h2>
                <ul>
                    <li><a href="/news/s/2013-07-25/524.html" title="现在，我相信爱情！">现在，我相信爱情！</a></li>
                    <li><a href="/newstalk/mood/2013-07-24/518.html" title="我希望我的爱情是这样的">我希望我的爱情是这样的</a></li>
                    <li><a href="/newstalk/mood/2013-07-02/335.html" title="有种情谊，不是爱情，也算不得友情">有种情谊，不是爱情，也算不得友情</a></li>
                    <li><a href="/newstalk/mood/2013-07-01/329.html" title="世上最美好的爱情">世上最美好的爱情</a></li>
                    <li><a href="/news/read/2013-06-11/213.html" title="爱情没有永远，地老天荒也走不完">爱情没有永远，地老天荒也走不完</a></li>
                    <li><a href="/news/s/2013-06-06/24.html" title="爱情的背叛者">爱情的背叛者</a></li>
                </ul>
            </div>
        </div>
        <aside class="right">
            <!-- Baidu Button BEGIN -->
            <div id="bdshare" class="bdshare_t bds_tools_32 get-codes-bdshare"><a class="bds_tsina"></a><a class="bds_qzone"></a><a class="bds_tqq"></a><a class="bds_renren"></a><span class="bds_more"></span><a class="shareCount"></a></div>
            <script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=6574585" ></script>
            <script type="text/javascript" id="bdshell_js"></script>
            <script type="text/javascript">
                document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000)
            </script>
            <!-- Baidu Button END -->
            <div class="blank"></div>
            <div class="news">
                <h3>
                    <p>栏目<span>最新</span></p>
                </h3>
                <ul class="rank">
                    @foreach($new_article as $key=>$val)
                        <li><a href="{{ url('detail/id/'.$val->id) }}" title="{{ $val->title }}" target="_blank">{{ $val->name }}</a></li>
                    @endforeach
                </ul>
                <h3 class="ph">
                    <p>点击<span>排行</span></p>
                </h3>
                <ul class="paih">
                    @foreach($hot_article as $key=>$val)
                        <li><a href="{{ url('detail/id/'.$val->id) }}" title="{{ $val->title }}" target="_blank">{{ $val->name }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="visitors">
                <h3>
                    <p>最近访客</p>
                </h3>
                <ul>
                </ul>
            </div>
        </aside>
    </article>
@stop