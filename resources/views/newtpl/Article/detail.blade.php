@extends('newtpl.common')

@section('title')
    {{@$title}}
@stop

@section('container')
    <section class="container">
        <div class="content-wrap">
            <div class="content">
                <header class="article-header">
                    <h1 class="article-title"><a href="">{{ $info->name }}</a></h1>
                    <div class="article-meta">
                        <span class="item article-meta-time">
                        <time class="time" data-toggle="tooltip" data-placement="bottom" title="时间：{{ $info->created_at }}"><i class="glyphicon glyphicon-time"></i> {{ $info->created_at }}</time>
          </span>
                        <span class="item article-meta-source" data-toggle="tooltip" data-placement="bottom" title="来源：曙光博客"><i class="glyphicon glyphicon-globe"></i> 曙光博客</span>
                        <span class="item article-meta-category" data-toggle="tooltip" data-placement="bottom" title="栏目：{{ $category->name }}"><i class="glyphicon glyphicon-list"></i> <a href="{{ url('lists/pid/'.$category->id) }}" title="">{{ $category->name }}</a></span>
                        <span class="item article-meta-views" data-toggle="tooltip" data-placement="bottom" title="查看：{{ $info->click }}"><i class="glyphicon glyphicon-eye-open"></i> 共{{ $info->click }}人围观</span>
                        <span class="item article-meta-comment" data-toggle="tooltip" data-placement="bottom" title="评论：{{ $info->total_comment }}"><i class="glyphicon glyphicon-comment"></i> {{ $info->total_comment }}个评论</span>
                    </div>
                </header>
                <article class="article-content">
                    {!! $info->content !!}
                    <!--
                    <p><img data-original="picture/banner_03.jpg" src="images/banner/banner_03.jpg" alt="" /></p>
                    <p> 用php获取上个月最后一天的时间，有两种方法，都非常简单，详细实现源码如下： </p>
        <pre class="prettyprint lang-php">&lt;?php
  date_default_timezone_set("PRC"); //设置时区
  //方法一
  $times = date("d") * 24 * 3600;
  echo date("Y-m-d H:i:s", time()-$times);
  echo '&lt;br/&gt;';
  //方法二
  $day = date('d');
  echo date("Y-m-d H:i:s", strtotime(-$day.' day'));
?&gt;</pre>
                    <p> 方法一是利用当前时间离本月初有多少时间，然后用当前时间减去这个时间差，就可以得到上月最后一天了。 </p>
                    <p> 方法二是先计算本月多少号，即离月初有多少天，然后用strtotime计算出$day天前的时间戳，也可以得到上个月的最后一天。 </p>
                    <p class="article-copyright hidden-xs">未经允许不得转载：<a href="">异清轩博客</a> » <a href="article.html">php如何判断一个日期的格式是否正确</a></p>
                    -->
                </article>

                <!--<div class="article-tags">关键字：<a href="" rel="tag">{{ $info->keywords }}</a></div>-->
                <div class="quotes">
                    @if($pre > 0)
                        <a href="{{ url('detail/id/'.$pre) }}">上一篇</a>
                    @else
                        <span class="disabled">上一页</span>
                    @endif
                    @if($next >0)
                        <a href="{{ url('detail/id/'.$next) }}">下一篇</a>
                    @else
                            <span class="disabled">下一篇</span>
                    @endif


                </div>
                <div class="relates">
                    <div class="title">
                        <h3>相关推荐</h3>
                    </div>
                    <ul>
                        @foreach($new_article as $key=>$val)
                        <li><a href="{{ url('detail/id/'.$val->id) }}">{{ $val->name }}</a></li>
                        @endforeach

                    </ul>
                </div>
                <div class="title" id="comment">
                    <h3>评论 <small>抢沙发</small></h3>
                </div>

                <div id="respond">
                    <form action="{{ url('addcomment') }}" method="post" id="comment-form">
                        <div class="comment">
                            <div class="comment-title"><img class="avatar" src="{{ asset('newtpl/picture/icon.png') }}" alt="" /></div>
                            <div class="comment-box">
                                <textarea placeholder="您的评论可以一针见血" name="comment" id="comment-textarea" cols="100%" rows="3" tabindex="1" ></textarea>
                                <div class="comment-ctrl"> <span class="emotion" style="display: none;"><img src="{{ asset('newtpl/picture/5.png') }}" width="20" height="20" alt="" />表情</span>
                                    <div class="comment-prompt"> <i class="fa fa-spin fa-circle-o-notch"></i> <span class="comment-prompt-text"></span> </div>
                                    <input type="hidden" value="{{ $info->id }}" class="articleid" />
                                    <button type="submit" name="comment-submit" id="comment-submit" tabindex="5" articleid="1">评论</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div id="postcomments">
                    <ol class="commentlist">
                        @foreach($articlecomment as $k=>$val)
                        <li class="comment-content"><span class="comment-f"></span>
                            <div class="comment-avatar"><img class="avatar" src="{{ asset('newtpl/picture/icon.png') }}" alt="" /></div>
                            <div class="comment-main">
                                <p>来自<span class="address">{{ $val->username }}</span>用户<span class="time">({{ $val->created_at }})</span><br />
                                    {!! $val->content !!}</p>
                            </div>
                        </li>
                        @endforeach
                    </ol>

                    {{ $articlecomment->render() }}

                    <!--<div class="quotes"><span class="disabled">首页</span><span class="disabled">上一页</span><a class="current">1</a><a href="">2</a><span class="disabled">下一页</span><span class="disabled">尾页</span></div>-->
                </div>
            </div>

        </div>
        <aside class="sidebar">
            <div class="fixed">
                <div class="widget widget-tabs">
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#notice" aria-controls="notice" role="tab" data-toggle="tab">网站公告</a></li>
                        <li role="presentation"><a href="#centre" aria-controls="centre" role="tab" data-toggle="tab">会员中心</a></li>
                        <li role="presentation"><a href="#contact" aria-controls="contact" role="tab" data-toggle="tab">联系站长</a></li>
                    </ul>
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane notice active" id="notice">
                            <ul>
                                @foreach($notice as $k=>$v)
                                    <li>
                                        <time datetime="{{ substr($v->created_at,0,10) }}">{{ substr($v->created_at,5,5) }}</time>
                                        <a href="{{ url('detail/id/'.$v->id) }}">{{ $v->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div role="tabpanel" class="tab-pane centre" id="centre">
                            <h4>需要登录才能进入会员中心</h4>
                            <p> <a href="javascript:;" class="btn btn-primary">立即登录</a> <a href="javascript:;" class="btn btn-default">现在注册</a> </p>
                        </div>
                        <div role="tabpanel" class="tab-pane contact" id="contact">
                            <h2>Email:<br />
                                <a href="mailto:admin@ylsat.com" data-toggle="tooltip" data-placement="bottom" title="admin@ylsat.com">admin@ylsat.com</a></h2>
                        </div>
                    </div>
                </div>
                <div class="widget widget_search">
                    <form class="navbar-form" action="{{ url('search') }}" method="post" onsubmit="return check_search()">
                        {{ csrf_field() }}
                        <div class="input-group">
                            <input type="text" name="keyword" class="form-control" size="35" placeholder="请输入关键字" maxlength="15" autocomplete="off">
            <span class="input-group-btn">
            <button class="btn btn-default btn-search" name="search" type="submit">搜索</button>
            </span> </div>
                    </form>
                    <script>
                        function check_search(){
                            var keyword = document.getElementById("search_key").value;
                            if(keyword.length == 0){return false}
                            return true;
                        }
                    </script>
                </div>
            </div>
            <!--<div class="widget widget_sentence">
                <h3>每日一句</h3>
                <div class="widget-sentence-content">
                    <h4>2016年01月05日星期二</h4>
                    <p>Do not let what you cannot do interfere with what you can do.<br />
                        别让你不能做的事妨碍到你能做的事。（John Wooden）</p>
                </div>
            </div>-->
            <div class="widget widget_hot">
                <h3>热门文章</h3>
                <ul>
                    @foreach($hot_article as $key=>$val)
                    <li>
                        <a href="{{ url('detail/id/'.$val->id) }}">
                            <span class="thumbnail">
                                @if(empty($val->images))
                                <img class="thumb" data-original="{{ asset('newtpl/picture/excerpt.jpg') }}" src="{{ asset('newtpl/picture/excerpt.jpg') }}" alt="">
                                @else
                                <img class="thumb" data-original="{{ $val->images }}" src=".{{ $val->images }}" alt="">
                                @endif
                            </span>
                            <span class="text">{{ $val->name }}</span>
                            <span class="muted"><i class="glyphicon glyphicon-time"></i> {{substr($val->created_at,0,10)}} </span>
                            <span class="muted"><i class="glyphicon glyphicon-eye-open"></i> {{ $val->click }}</span>
                        </a>
                    </li>
                    @endforeach

                </ul>
            </div>
        </aside>
    </section>
@stop


@section('script')
    <script src="{{ asset('newtpl/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('newtpl/js/jquery.ias.js') }}"></script>
    <script src="{{ asset('newtpl/js/scripts2.js') }}"></script>
    <script src="{{ asset('newtpl/js/jquery.qqface.js') }}"></script>
    <script type="text/javascript">
        /*文章评论*/
        $(function(){
            $("#comment-submit").click(function(){
                var commentContent = $("#comment-textarea");
                var commentButton = $("#comment-submit");
                var promptBox = $('.comment-prompt');
                var promptText = $('.comment-prompt-text');
                var articleid = $('.articleid').val();
                promptBox.fadeIn(400);
                if(commentContent.val() === ''){
                    promptText.text('请留下您的评论');
                    return false;
                }
                commentButton.attr('disabled',true);
                commentButton.addClass('disabled');
                promptText.text('正在提交...');
                var formaction = $('#comment-form').attr("action");
                var _token = '{{csrf_token()}}';
                $.ajax({
                    type:"POST",
                    url:formaction,
                    //url:"/Article/comment/id/" + articleid,
                    data:{commentContent:replace_em(commentContent.val()),id:articleid,_token:_token},
                    cache:false, //不缓存此页面
                    success:function(data){
                        if(data.status==0){
                            alert(data.msg);
                        }
                        if(data.status==1){
                            promptText.text('评论成功!');
                            commentContent.val(null);
                            $(".commentlist").fadeIn(300);
                            /*$(".commentlist").append();*/
                            commentButton.attr('disabled',false);
                            commentButton.removeClass('disabled');
                        }

                    }
                });
                /*$(".commentlist").append(replace_em(commentContent.val()));*/
                promptBox.fadeOut(100);
                return false;
            });

            $('.emotion').qqFace({
                id : 'facebox',
                assign:'comment-textarea',
                path:'images/arclist/'	//表情存放的路径
            });
        });
        //对文章内容进行替换
        function replace_em(str){
            str = str.replace(/\</g,'&lt;');
            str = str.replace(/\>/g,'&gt;');
            str = str.replace(/\[em_([0-9]*)\]/g,'<img src="/Home/images/arclist/$1.gif" border="0" />');
            return str;
        }

    </script>
@stop