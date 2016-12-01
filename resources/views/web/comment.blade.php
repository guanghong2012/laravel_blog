@extends('layouts.common')
@section('css')
    <link href="{{asset('css/new.css')}}" rel="stylesheet">
    <link href="{{asset('css/styletest.css')}}" rel="stylesheet">
@stop
@section('title')
    {{@$title}}
@stop
@section('script')
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/login-register.css') }}">
    <script src="{{ asset('/js/jquery.js?t=1476958143') }}"></script>
    <script src="{{ asset('/layer/layer.js?v=2.4') }}"></script>
    <script src="{{ asset('/js/common/vilidata.js') }}"></script>
@show
@section('content')
    <article class="blogs">
        <h1 class="t_nav"><span>您当前的位置：<a href="{{ url('/') }}">首页</a>&nbsp;&gt;&nbsp;<a href="">留言板</a></span><a href="{{ url('/') }}" class="n1">网站首页</a><a href="" class="n2">留言板</a></h1>
    </article>
    <div class="">
        <h1>留言板</h1>
        <div class="login-01">
            <form action="{{url('comment')}}" method="post" >
                {{ csrf_field() }}
                <ul>
                    <li class="first">
                        <a href="#" class=" icon user"></a><input type="text" class="text" value="Name" onFocus="this.value = '';" onBlur="if (this.value == '') {this.value = 'Name';}" >
                        <div class="clear"></div>
                    </li>
                    <li class="first">
                        <a href="#" class=" icon email"></a><input type="text" class="text" value="Email" onFocus="this.value = '';" onBlur="if (this.value == '') {this.value = 'Email';}" >
                        <div class="clear"></div>
                    </li>
                    <li class="first">
                        <a href="#" class=" icon phone"></a><input type="text" class="text" value="Phone" onFocus="this.value = '';" onBlur="if (this.value == '') {this.value = 'Phone';}" >
                        <div class="clear"></div>
                    </li>
                    <li class="first">
                        <a href="#" class=" icon captcha"></a>
                        <input type="text" name="captcha" />

                    </li>
                    <li class="first">
                        <a href="#" class=" icon captcha"></a>
                        <img id="Captcha" class="Captcha-image"
                             alt="验证码"
                             src="{{ captcha_src() }}"
                             style="display: block;width: 40%;height: 3.7em;cursor:pointer">
                    </li>
                    <li class="second">
                        <a href="#" class=" icon msg"></a><textarea value="Message" onFocus="this.value = '';" onBlur="if (this.value == '') {this.value = 'Comments';}">Comments</textarea>
                        <div class="clear"></div>
                    </li>
                </ul>
                <input type="submit" onClick="myFunction()" value="提交留言" >
                <div class="clear"></div>
            </form>
        </div>
    </div>

    <script>
        $("#Captcha").on("click",function(){
            $.get("/api/captcha",function(s){
                if(s.status == 200)
                {
                    $("#Captcha").attr("src", s.result.src);
                }
            })
        });
    </script>
@stop