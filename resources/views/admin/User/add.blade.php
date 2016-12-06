@extends('admin.common')

@section('page_plugin_styles')

@stop

@section('inline_styles')

@stop

@section('main-content')
    <script src="{{ asset('/js/jquery.js?t=1476958143') }}"></script>
    <script src="{{ asset('/layer/layer.js?v=2.4') }}"></script>
    <div class="breadcrumbs" id="breadcrumbs">
        <script type="text/javascript">
            try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
        </script>
        <!--右侧顶部面包屑-->
        <ul class="breadcrumb">
            <li>
                <i class="icon-home home-icon"></i>
                <a href="{{ url('newwebadmin/index') }}">首页</a>
            </li>
            <li class="active">会员管理</li>
        </ul><!-- .breadcrumb -->

        <div class="nav-search" id="nav-search">
            <form class="form-search">
								<span class="input-icon">
									<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
									<i class="icon-search nav-search-icon"></i>
								</span>
            </form>
        </div><!-- #nav-search -->
    </div>

    <div class="page-content">
        <!--头部面包屑-->
        <div class="page-header">
            <h1>
                会员管理
                <small>
                    <i class="icon-double-angle-right"></i>
                    会员添加
                </small>
            </h1>
        </div><!-- /.page-header -->


        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->
                <!--右侧部分开始-->

                <div class="table-header">
                    <a href="{{ url('newwebadmin/user') }}" class="btn btn-sm btn-success" ><i class="icon-arrow-left"></i>返回列表</a>
                </div><!--表格上方蓝色部分 -->
                <div class="hr hr-10"></div>
                <form class="form-horizontal" action="{{ url('newwebadmin/user') }}" method="post" role="form">
                    {{ csrf_field() }}
                    <div class="form-group">

                        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> 用户名: </label>

                        <div class="col-sm-9">
                            <input type="text" name="name" id="form-field-1" placeholder="填写用户名" value="{{ old('name') }}" class="col-xs-10 col-sm-5" />
                        </div>
                        @if($errors->has("name"))
                            <script>
                                layer.tips("{{ $errors->first("name") }}",$("#form-field-1"), {
                                    tips: [2, '#e53e49'],
                                    tipsMore: true
                                });
                            </script>
                        @endif
                    </div>
                    <div class="form-group">

                        <label class="col-sm-2 control-label no-padding-right" for="form-field-2"> 邮箱地址: </label>

                        <div class="col-sm-9">
                            <input type="text" name="email" id="form-field-2" placeholder="填写邮箱地址" value="{{ old('email') }}" class="col-xs-10 col-sm-5" />
                        </div>
                        @if($errors->has("email"))
                            <script>
                                layer.tips("{{ $errors->first("email") }}",$("#form-field-2"), {
                                    tips: [2, '#e53e49'],
                                    tipsMore: true
                                });
                            </script>
                        @endif
                    </div>
                    <div class="form-group">

                        <label class="col-sm-2 control-label no-padding-right" for="form-field-3"> 手机号码: </label>

                        <div class="col-sm-9">
                            <input type="text" name="phone" id="form-field-3" placeholder="填写手机号码" value="{{ old('phone') }}" class="col-xs-10 col-sm-5" />
                        </div>
                        @if($errors->has("phone"))
                            <script>
                                layer.tips("{{ $errors->first("phone") }}",$("#form-field-3"), {
                                    tips: [2, '#e53e49'],
                                    tipsMore: true
                                });
                            </script>
                        @endif
                    </div>
                    <div class="form-group">

                        <label class="col-sm-2 control-label no-padding-right" for="form-field-4"> 会员密码: </label>

                        <div class="col-sm-9">
                            <input type="password" name="password" id="form-field-4" value="{{ old('password') }}" placeholder="填写6位以上的密码" class="col-xs-10 col-sm-5" />
                        </div>
                        @if($errors->has("password"))
                            <script>
                                layer.tips("{{ $errors->first("password") }}",$("#form-field-4"), {
                                    tips: [2, '#e53e49'],
                                    tipsMore: true
                                });
                            </script>
                        @endif
                    </div>
                    <div class="form-group">

                        <label class="col-sm-2 control-label no-padding-right" for="form-field-5"> 确认密码: </label>

                        <div class="col-sm-9">
                            <input type="password" name="password_confirmation" id="form-field-5" value="{{ old('password_confirmation') }}" placeholder="填写6位以上的密码" class="col-xs-10 col-sm-5" />
                        </div>

                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" for="form-field-7"> 是否有效: </label>
                        <div class="col-sm-9">
                            <div class="radio">
                                <label>
                                    <input name="is_effect" type="radio" class="ace" value="1" @if(old('is_effect') == 1) checked @endif />
                                    <span class="lbl"> 正常</span>
                                </label>
                                <label>
                                    <input name="is_effect" type="radio" class="ace" value="0" @if(old('is_effect') == 0) checked @endif />
                                    <span class="lbl"> 禁用</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix form-actions">

                        <div class="col-md-offset-3 col-md-9">
                            <button class="btn btn-info" type="submit">
                                <i class="icon-ok bigger-110"></i>
                                提交			</button>

                            &nbsp; &nbsp; &nbsp;
                            <button class="btn" type="reset">
                                <i class="icon-undo bigger-110"></i>
                                重置			</button>
                        </div>
                    </div>


                </form>


                <!-- PAGE CONTENT ENDS -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.page-content -->

    @stop
            <!--当前页面需要用到的js-->
@section('page_script')

    <script>
        @if( Session::has('pageMsg') )
        layer.alert('{{Session::get('pageMsg')}}', {
            icon: 5,
            shadeClose: true,
            title: "操作失败"
        });
        @endif

        @if( Session::has('pageSuccess') )
        layer.alert('{{Session::get('pageSuccess')}}', {
            icon: 1,
            shadeClose: true,
            title: "操作成功"
        });
        @endif
    </script>
@stop