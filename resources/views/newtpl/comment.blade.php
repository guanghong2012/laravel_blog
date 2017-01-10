@extends('newtpl.common')

@section('title')
    {{@$title}}
@stop
@section('css')
    <style>
        .comments{
            width:70%;
            margin:0 auto;
        }
        .input-contents{margin-bottom: 10px;}
    </style>
    <script src="{{ asset('/js/jquery.js?t=1476958143') }}"></script>
    <script src="{{ asset('/layer/layer.js?v=2.4') }}"></script>
    <script src="{{ asset('/js/common/vilidata.js') }}"></script>
@stop
@section('container')
    @if( Session::has('pageMsg') )
        layer.alert('{{Session::get('pageMsg')}}', {
        icon: 5,
        shadeClose: true,
        title: "操作失败"
        });
    @endif
    <section class="container container-page" style="padding-left:0;">
        <div class="content">
            <header class="article-header">
                <h1 class="article-title">留言板</h1>
            </header>
            <div class="comments">
                <form action="{{url('comment')}}" method="post" >
                    {{ csrf_field() }}
                    <div class="input-group input-contents">
                        <input id="RegName" type="text" class="form-control" size="35" value="" name="name" placeholder="姓名" >
                        @if($errors->has("name"))
                            <script>
                                layer.tips("{{ $errors->first("name") }}",$("#RegName"), {
                                    tips: [2, '#e53e49'],
                                    tipsMore: true
                                });
                            </script>
                        @endif
                    </div>
                    <div class="input-group input-contents">
                        <input id="email" type="text" class="form-control" size="35" value="{{old("email")}}" name="email" vili-reg="email" placeholder="邮箱" >
                        @if($errors->has("email"))
                            <script>
                                var RgIndex = layer.tips("{{ $errors->first("email") }}",$("#email"), {
                                    tips: [2, '#e53e49'],
                                    tipsMore: true
                                });
                            </script>
                        @endif
                    </div>
                    <div class="input-group input-contents">
                        <input id="RegPhone" type="text" class="form-control" size="35" name="phone" value="{{old("phone")}}" placeholder="手机号码" >
                        @if($errors->has("phone"))
                            <script>
                                var RgIndex = layer.tips("{{ $errors->first("phone") }}",$("#RegPhone"), {
                                    tips: [2, '#e53e49'],
                                    tipsMore: true
                                });
                            </script>
                        @endif
                    </div>
                    <div class="input-group input-contents">
                        <input id="yanzhengma" type="text" class="form-control" size="35" value="" name="captcha" placeholder="填写验证码" >
                    </div>
                    <div class="input-group input-contents">
                        <img id="Captcha" class="Captcha-image"
                             alt="验证码"
                             src="{{ captcha_src() }}"
                             style="display: block;height: 3.7em;cursor:pointer">
                        @if($errors->has("captcha"))
                            <script>
                                RgIndex = layer.tips("{{ $errors->first("captcha") }}",$("#yanzhengma"), {
                                    tips: [2, '#e53e49'],
                                    tipsMore: true
                                });
                            </script>
                        @endif
                    </div>
                    <div class="input-group comment-box input-contents">
                        <textarea id="comment-textarea" name="comment"  placeholder="留言内容" cols="50%" rows="3"></textarea>
                        @if($errors->has("comment"))
                            <script>
                                RgIndex = layer.tips("{{ $errors->first("comment") }}",$("#comment-textarea"), {
                                    tips: [2, '#e53e49'],
                                    tipsMore: true
                                });
                            </script>
                        @endif
                    </div>
                    <div class="input-group">
                        <button class="btn btn-default btn-search" name="submit" type="submit">提交留言</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@stop

@section('script')
    <script src="{{ asset('newtpl/js/bootstrap.min.js') }}"></script>


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