@extends('layouts.common')

@section('title')
    {{@$title}}
@stop

@section('content')
    <div class="banner">
        <section class="box">
            <ul class="texts">
                <p>打了死结的青春，捆死一颗苍白绝望的灵魂。</p>
                <p>为自己掘一个坟墓来葬心，红尘一梦，不再追寻。</p>
                <p>加了锁的青春，不会再因谁而推开心门。</p>
            </ul>
            <div class="avatar"><a href="#"><span>后盾</span></a> </div>
        </section>
    </div>
    <div class="template">
        <div class="box">
            <h3>
                <p><span>个人博客</span>模板 Templates</p>
            </h3>
            <ul>
                <li><a href="/"  target="_blank"><img src="images/01.jpg"></a><span>仿新浪博客风格·梅——古典个人博客模板</span></li>
                <li><a href="/" target="_blank"><img src="images/02.jpg"></a><span>黑色质感时间轴html5个人博客模板</span></li>
                <li><a href="/"  target="_blank"><img src="images/03.jpg"></a><span>Green绿色小清新的夏天-个人博客模板</span></li>
                <li><a href="/" target="_blank"><img src="images/04.jpg"></a><span>女生清新个人博客网站模板</span></li>
                <li><a href="/"  target="_blank"><img src="images/02.jpg"></a><span>黑色质感时间轴html5个人博客模板</span></li>
                <li><a href="/"  target="_blank"><img src="images/03.jpg"></a><span>Green绿色小清新的夏天-个人博客模板</span></li>
            </ul>
        </div>
    </div>
    <article>
        <h2 class="title_tj">
            <p>文章<span>推荐</span></p>
        </h2>
        <div class="bloglist left">
            @foreach($article as $key=>$value)
            <h3>{{$value->name}}</h3>
            <figure><img src="images/001.png"></figure>
            <ul>
                <p>{{str_limit($value->description,100)}}</p>
                <a title="{{ $value->title }}" href="{{ url('detail/id/'.$value->id) }}" target="_blank" class="readmore">阅读全文>></a>
            </ul>
            <p class="dateview"><span>{{substr($value->created_at,0,10)}}</span><span>作者：曙光</span><span>个人博客：[<a href="{{url('lists/pid/'.$value->pid)}}">{{$value->cate_name}}</a>]</span></p>
            @endforeach

        </div>
        <aside class="right">
            <div class="weather"><iframe width="250" scrolling="no" height="60" frameborder="0" allowtransparency="true" src="http://i.tianqi.com/index.php?c=code&id=12&icon=1&num=1"></iframe></div>
            <div class="news">
                <h3>
                    <p>最新<span>文章</span></p>
                </h3>
                <ul class="rank">
                    @foreach($new_article as $key=> $val)
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
                <h3 class="links">
                    <p>友情<span>链接</span></p>
                </h3>
                <ul class="website">
                    <li><a href="http://www.houdunwang.com">后盾网</a></li>
                    <li><a href="http://bbs.houdunwang.com">后盾论坛</a></li>
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