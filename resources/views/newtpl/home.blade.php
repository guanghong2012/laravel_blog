@extends('newtpl.common')

@section('title')
    {{@$title}}
@stop

@section('container')
    <section class="container">
        <div class="content-wrap">
            <div class="content">
                <div class="jumbotron">
                    <h1>欢迎访问曙光博客</h1>
                    <p>在这里可以看到前端技术，后端程序，网站内容管理系统等文章，还有我的程序人生！</p>
                </div>
                <div id="focusslide" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        @foreach($banner as $key=>$item)
                        <li data-target="#focusslide" data-slide-to="{{ $key }}" @if($key==0)class="active"@endif ></li>
                        @endforeach

                    </ol>
                    <div class="carousel-inner" role="listbox">
                        @foreach($banner as $key=>$item)
                        <div class="item @if($key==0) active @endif "> <a href="{{ $item->url }}" target="_blank"><img src="{{ $item->images }}" alt="" class="img-responsive"></a>

                        </div>
                        @endforeach

                    </div>
                    <a class="left carousel-control" href="#focusslide" role="button" data-slide="prev" rel="nofollow"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">上一个</span> </a> <a class="right carousel-control" href="#focusslide" role="button" data-slide="next" rel="nofollow"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">下一个</span> </a> </div>
                <article class="excerpt-minic excerpt-minic-index">
                    <h2><span class="red">【今日推荐】</span><a href="{{ url('detail/id/'.$article->id) }}" title="{{ $article->title }}">{{ $article->name }}</a></h2>
                    <p class="note">{{ $article->description }}</p>
                </article>
                <div class="title">
                    <h3>最新发布</h3>
                    <div class="more"><a href="">PHP</a><a href="">JavaScript</a><a href="">EmpireCMS</a><a href="">Apache</a><a href="">MySQL</a></div>
                </div>

                @foreach($new_article as $key=> $val)
                <article class="excerpt excerpt-{{ $key+1 }}">
                    <a class="focus" href="{{ url('detail/id/'.$val->id) }}" title="">
                        @if(!empty($val->images))
                        <img class="thumb" data-original=".{{ $val->images }}" src=".{{ $val->images }}" alt="">
                        @else
                        <img class="thumb" data-original="{{ asset('newtpl/picture/excerpt.jpg') }}" src="{{ asset('newtpl/picture/excerpt.jpg') }}" alt="">
                        @endif
                    </a>
                    <header><a class="cat" href="program">{{ $val->cate_name }}<i></i></a>
                        <h2><a href="{{ url('detail/id/'.$val->id) }}" title="{{ $val->title }}">{{ $val->name }}</a></h2>
                    </header>
                    <p class="meta">
                        <time class="time"><i class="glyphicon glyphicon-time"></i> {{substr($val->created_at,0,10)}}</time>
                        <span class="views"><i class="glyphicon glyphicon-eye-open"></i> 共{{$val->click}}人围观</span> <a class="comment" href="article.html#comment"><i class="glyphicon glyphicon-comment"></i> {{ $val->total_comment }}个评论</a></p>
                    <p class="note">{{ $val->description }} </p>
                </article>
                @endforeach

                <nav class="pagination" style="display: none;">
                    {{ $new_article->render() }}
                    <!--
                    <ul>
                        <li class="prev-page"></li>
                        <li class="active"><span>1</span></li>
                        <li><a href="?page=2">2</a></li>
                        <li class="next-page"><a href="?page=2">下一页</a></li>
                        <li><span>共 2 页</span></li>
                    </ul>
                    -->
                </nav>
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
                                    <a href="{{ url('detail/id/'.$v->id) }}" >{{ $v->name }}</a>
                                </li>
                                @endforeach

                            </ul>
                        </div>
                        <div role="tabpanel" class="tab-pane centre" id="centre">
                            <h4>需要登录才能进入会员中心</h4>
                            <p> <a data-toggle="modal" data-target="#loginModal" class="btn btn-primary">立即登录</a>
                                <a href="{{ url('register') }}"  class="btn btn-default">现在注册</a>
                            </p>
                        </div>
                        <div role="tabpanel" class="tab-pane contact" id="contact">
                            <h2>Email:<br />
                                <a href="mailto:guanghong2012@126.com" data-toggle="tooltip" data-placement="bottom" title="guanghong2012@126.com">guanghong2012@126.com</a></h2>
                        </div>
                    </div>
                </div>
                <div class="widget widget_search">
                    <form class="navbar-form" action="{{ url('search') }}" method="post" onsubmit="return check_search()">
                        {{ csrf_field() }}
                        <div class="input-group">
                            <input type="text" id="search_key" name="keyword" class="form-control" size="35" value="" placeholder="请输入关键字" maxlength="15" autocomplete="off">
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
                        <a href="{{ url('detail/id/'.$val->id) }}" title="{{ $val->title }}" target="_blank" >
                            <span class="thumbnail">
                                @if(empty($val->images))
                                <img class="thumb" data-original="{{ asset('newtpl/picture/excerpt.jpg') }}" src="{{ asset('newtpl/picture/excerpt.jpg') }}" alt="">
                                    @else
                                <img class="thumb" data-original=".{{ $val->images }}" src=".{{ $val->images }}" alt="">
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

@section('plugin')
        <!--登录注册模态框-->
    <div class="modal fade user-select" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ url('login') }}" method="post">
                    {{ csrf_field() }}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="loginModalLabel">登录</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="loginModalUserNmae">用户名</label>
                            <input type="text" class="form-control" name="name" id="loginModalUserNmae" placeholder="请输入用户名" autofocus maxlength="15" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <label for="loginModalUserPwd">密码</label>
                            <input type="password" class="form-control" name="password" id="loginModalUserPwd" placeholder="请输入密码" maxlength="18" autocomplete="off" required>
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


@stop