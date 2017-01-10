@extends('admin.common')

@section('page_plugin_styles')

@stop

@section('inline_styles')

@stop

@section('main-content')
    <script src="{{ asset('js/jquery.js?t=1476958143') }}"></script>
    <script src="{{ asset('layer/layer.js?v=2.4') }}"></script>
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
            <li class="active">导航管理</li>
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
                导航管理
                <small>
                    <i class="icon-double-angle-right"></i>
                    编辑导航
                </small>
            </h1>
        </div><!-- /.page-header -->


        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->
                <!--右侧部分开始-->

                <div class="table-header">
                    <a href="{{ url('newwebadmin/navigation') }}" class="btn btn-sm btn-success" ><i class="icon-arrow-left"></i>返回列表</a>
                </div><!--表格上方蓝色部分 -->
                <div class="hr hr-10"></div>
                <form class="form-horizontal" method="post" action="{{ url('newwebadmin/navigation/'.$nav->id) }}" role="form" >
                    {{ csrf_field() }}
                    <input name="_method" type="hidden" value="put" />
                    <div class="form-group">

                        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> 导航名称: </label>

                        <div class="col-sm-9">
                            <input type="text" name="name" id="form-field-1" placeholder="导航名称" class="col-xs-10 col-sm-5" value="{{ $nav->name }}" />

                            @if($errors->has("name"))
                                <script>
                                    layer.tips("{{ $errors->first("name") }}",$("#form-field-1"), {
                                        tips: [2, '#e53e49'],
                                        tipsMore: true
                                    });
                                </script>
                            @endif
                        </div>

                    </div>
                    <div class="form-group">

                        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> 链接地址: </label>

                        <div class="col-sm-9">
                            <input type="text" name="url" id="title" placeholder="链接地址" class="col-xs-10 col-sm-5" value="{{ $nav->url }}" />

                            @if($errors->has("url"))
                                <script>
                                    layer.tips("{{ $errors->first("url") }}",$("#title"), {
                                        tips: [2, '#e53e49'],
                                        tipsMore: true
                                    });
                                </script>
                            @endif
                        </div>

                    </div>
                    <div class="form-group">

                        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> 模块名称: </label>

                        <div class="col-sm-9">
                            <input type="text" name="model" id="model" placeholder="模块名称" class="col-xs-10 col-sm-5" value="{{ $nav->model }}" />

                            @if($errors->has("model"))
                                <script>
                                    layer.tips("{{ $errors->first("model") }}",$("#model"), {
                                        tips: [2, '#e53e49'],
                                        tipsMore: true
                                    });
                                </script>
                            @endif
                        </div>

                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" for="form-field-7"> 是否新建窗口: </label>
                        <div class="col-sm-9">
                            <div class="radio">
                                <label>
                                    <input name="is_blank" type="radio" class="ace" value="0" @if($nav->is_blank == 0) checked @endif />
                                    <span class="lbl"> 否</span>
                                </label>
                                <label>
                                    <input name="is_blank" type="radio" class="ace" value="1" @if($nav->is_blank == 1) checked @endif />
                                    <span class="lbl"> 是</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">

                        <label class="col-sm-2 control-label no-padding-right" for="form-field-5"> 排序: </label>

                        <div class="col-sm-9">
                            <input type="text" name="sort" id="form-field-5" placeholder="排序" class="col-xs-10 col-sm-5" value="{{ $nav->sort }}" />
                        </div>

                    </div>

                    <div class="clearfix form-actions">
                        <div class="col-md-offset-3 col-md-9">
                            <input type="hidden" value="{{ $nav->id }}" name="id">
                            <button class="btn btn-info" type="submit">
                                <i class="icon-ok bigger-110"></i>
                                编辑				</button>

                            &nbsp; &nbsp; &nbsp;
                            <button class="btn" type="reset">
                                <i class="icon-undo bigger-110"></i>
                                重置				</button>
                        </div>
                    </div>

                </form>


                <!-- PAGE CONTENT ENDS -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.page-content -->

    @stop
            <!--插件js-->
@section('page_plugin_js')
    <script type="text/javascript" src="{{asset('laydate/laydate.js')}}"></script><!--日期js-->
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