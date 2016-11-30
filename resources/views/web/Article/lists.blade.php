@extends('layouts.common')
@section('css')
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
@stop
@section('title')
    {{@$title}}
@stop

@section('content')
    <article class="blogs">
        <h1 class="t_nav"><span>{{$category->description}}</span><a href="/" class="n1">网站首页</a><a href="{{ url('lists/pid/'.$category->id) }}" class="n2">{{$category->name}}</a></h1>
        <div class="newblog left">
            @foreach($articles as $key=>$value)
            <h2>{{$value->name}}</h2>
            <p class="dateview"><span>发布时间：{{ substr($value->created_at,0,10)  }}</span><span>作者：曙光</span><span>分类：[<a href="{{url('lists/pid/'.$value->pid)}}">{{$category->name}}</a>]</span></p>
            <figure><img src="{{asset('images/001.png')}}"></figure>
            <ul class="nlist">
                <p>{{str_limit($value->description,100)}}</p>
                <a title="{{ $value->title }}" href="{{ url('detail/id/'.$value->id) }}" target="_blank" class="readmore">阅读全文>></a>
            </ul>
            <div class="line"></div>
            @endforeach

            <div class="page">
                {{ $articles->render() }}
                <!--<ul class="pagination"><li class="disabled"><span>«</span></li> <li class="active"><span>1</span></li><li><a href="http://blog.hd/admin/article?page=2">2</a></li> <li><a href="http://blog.hd/admin/article?page=2" rel="next">»</a></li></ul>-->


            </div>
        </div>
        <aside class="right">
            <div class="rnav">
                <ul>
                    <li class="rnav1"><a href="/download/" target="_blank">日记</a></li>
                    <li class="rnav2"><a href="/newsfree/" target="_blank">程序人生</a></li>
                    <li class="rnav3"><a href="/web/" target="_blank">欣赏</a></li>
                    <li class="rnav4"><a href="/newshtml5/" target="_blank">短信祝福</a></li>
                </ul>
            </div>
            <div class="news">
                <h3>
                    <p>最新<span>文章</span></p>
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
                <h3><p>最近访客</p></h3>
                <ul>

                </ul>
            </div>
            <!-- Baidu Button BEGIN -->
            <div id="bdshare" class="bdshare_t bds_tools_32 get-codes-bdshare"><a class="bds_tsina"></a><a class="bds_qzone"></a><a class="bds_tqq"></a><a class="bds_renren"></a><span class="bds_more"></span><a class="shareCount"></a></div>
            <script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=6574585" ></script>
            <script type="text/javascript" id="bdshell_js"></script>
            <script type="text/javascript">
                document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000)
            </script>
            <!-- Baidu Button END -->
        </aside>
    </article>
@stop