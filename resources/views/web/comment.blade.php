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
    @if( Session::has('pageMsg') )
        layer.alert('{{Session::get('pageMsg')}}', {
        icon: 5,
        shadeClose: true,
        title: "操作失败"
        });
    @endif

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
                        <a href="javascript:void(0)" class=" icon user"></a>
                        <input id="RegName" type="text" class="text" value="" name="name" placeholder="姓名" >
                        <div class="clear"></div>
                        @if($errors->has("name"))
                            <script>
                                layer.tips("{{ $errors->first("name") }}",$("#RegName"), {
                                    tips: [2, '#e53e49'],
                                    tipsMore: true
                                });
                            </script>
                        @endif
                    </li>
                    <li class="first">
                        <a href="javascript:void(0)" class=" icon email"></a>
                        <input type="text" id="email" class="text" value="{{old("email")}}" name="email" vili-reg="email" placeholder="邮箱地址" >
                        <div class="clear"></div>
                        @if($errors->has("email"))
                            <script>
                                var RgIndex = layer.tips("{{ $errors->first("email") }}",$("#email"), {
                                    tips: [2, '#e53e49'],
                                    tipsMore: true
                                });
                            </script>
                        @endif
                    </li>
                    <li class="first">
                        <a href="javascript:void(0)" class=" icon phone"></a>
                        <input type="text" id="RegPhone" class="text" name="phone" value="{{old("phone")}}" placeholder="手机号" vili-reg="phone" />
                        <div class="clear"></div>
                        @if($errors->has("phone"))
                            <script>
                                var RgIndex = layer.tips("{{ $errors->first("phone") }}",$("#RegPhone"), {
                                    tips: [2, '#e53e49'],
                                    tipsMore: true
                                });
                            </script>
                        @endif
                    </li>
                    <li class="first">
                        <a href="#" class=" icon captcha"></a>
                        <input type="text" name="captcha" placeholder="请填写验证码" />

                    </li>
                    <li class="first">
                        <a href="#" class=" icon captcha"></a>
                        <img id="Captcha" class="Captcha-image"
                             alt="验证码"
                             src="{{ captcha_src() }}"
                             style="display: block;width: 35%;height: 3.7em;cursor:pointer">
                    </li>
                    @if($errors->has("captcha"))
                        <script>
                            RgIndex = layer.tips("{{ $errors->first("captcha") }}",$("#Captcha"), {
                                tips: [2, '#e53e49'],
                                tipsMore: true
                            });
                        </script>
                    @endif
                    <li class="second">
                        <a href="#" class=" icon msg"></a>
                        <textarea id="comment" name="comment"  placeholder="留言内容"></textarea>
                        <div class="clear"></div>
                    </li>
                    @if($errors->has("comment"))
                        <script>
                            RgIndex = layer.tips("{{ $errors->first("comment") }}",$("#comment"), {
                                tips: [2, '#e53e49'],
                                tipsMore: true
                            });
                        </script>
                    @endif
                </ul>
                <input type="submit" value="提交留言" >
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