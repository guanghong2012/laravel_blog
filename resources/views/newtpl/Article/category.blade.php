@extends('newtpl.common')

@section('title')
    {{@$title}}
@stop

@section('container')
    <section class="container container-page">
        <div class="pageside">
            <div class="pagemenus">
                <ul class="pagemenu">
                    @foreach($all_cate as $key=>$item)
                    <li><a href="{{ url('allcategory/pid/'.$item->id) }}">{{ $item->name }}</a></li>
                    @endforeach

                </ul>
            </div>
        </div>
        <div class="content">
            <header class="article-header">
                <h1 class="article-title">{{ $title }}</h1>
            </header>
            <div class="readers">
                @foreach($category as $key=>$val)
                <a class="item-readers item-readers-3"  href="{{ url('lists/pid/'.$val->id) }}" rel="nofollow">
                    <h4>【{{ $val->name }}】<small>文章数量：{{ $val->article_num }}</small></h4>
                    <img class="avatar" height="36" width="36" src="{{ asset('newtpl/picture/icon.png') }}" alt=""><strong>曙光</strong>http://www.ylsat.com/
                </a>
                @endforeach


            </div>
        </div>
    </section>
@stop