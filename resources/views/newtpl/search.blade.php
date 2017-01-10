@extends('newtpl.common')

@section('title')
    {{@$title}}
@stop

@section('container')
    <section class="container">
        <div class="content-wrap">
            <div class="content">
                <div class="title">
                    <h3>搜索关键字：<span style="color: #7b3f25;">{{$keyword}}</span></h3>
                </div>
                @foreach($articles as $key=>$value)
                    <article class="excerpt excerpt-1">
                        <a class="focus" href="{{ url('detail/id/'.$value->id) }}" title="">
                            @if(empty($value->images))
                                <img class="thumb" data-original="{{ asset('newtpl/picture/excerpt.jpg') }}" src="{{ asset('newtpl/picture/excerpt.jpg') }}" alt="">
                            @else
                                <img class="thumb" data-original="{{ $value->images }}" src="{{ $value->images }}" alt="">
                            @endif
                        </a>
                        <header><a class="cat" href="program">{{$value->cate_name}}<i></i></a>
                            <h2><a href="{{ url('detail/id/'.$value->id) }}" title="">{{$value->name}}</a></h2>
                        </header>
                        <p class="meta">
                            <time class="time"><i class="glyphicon glyphicon-time"></i> {{ substr($value->created_at,0,10)  }}</time>
                            <span class="views"><i class="glyphicon glyphicon-eye-open"></i> 共{{ $value->click }}人围观</span> <a class="comment" href=""><i class="glyphicon glyphicon-comment"></i> 0个不明物体</a></p>
                        <p class="note">{{str_limit($value->description,100)}}</p>
                    </article>
                @endforeach

                <nav class="pagination" style="display: none;">
                    {{ $articles->render() }}
                            <!-- <ul>
                        <li class="prev-page"></li>
                        <li class="active"><span>1</span></li>
                        <li><a href="?page=2">2</a></li>
                        <li class="next-page"><a href="?page=2">下一页</a></li>
                        <li><span>共 2 页</span></li>
                    </ul>-->
                </nav>
            </div>
        </div>
        <aside class="sidebar">
            <div class="fixed">
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
                <!--<div class="widget widget_sentence">
                    <h3>每日一句</h3>
                    <div class="widget-sentence-content">
                        <h4>2016年01月05日星期二</h4>
                        <p>Do not let what you cannot do interfere with what you can do.<br />
                            别让你不能做的事妨碍到你能做的事。（John Wooden）</p>
                    </div>
                </div>-->
            </div>
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
                                    <img class="thumb" data-original="{{ $val->images }}" src="{{ $val->images }}" alt="">
                                @endif
                            </span>
                                <span class="text">{{ $val->name }}</span>
                                <span class="muted"><i class="glyphicon glyphicon-time"></i> {{ $val->created_at }} </span>
                                <span class="muted"><i class="glyphicon glyphicon-eye-open"></i> {{ $val->click }}</span>
                            </a>
                        </li>
                    @endforeach

                </ul>
            </div>
        </aside>
    </section>
@stop