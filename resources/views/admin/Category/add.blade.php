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
            <li class="active">分类管理</li>
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
                分类管理
                <small>
                    <i class="icon-double-angle-right"></i>
                    添加分类
                </small>
            </h1>
        </div><!-- /.page-header -->


        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->
                <!--右侧部分开始-->
                <div class="table-header">
                    <a href="/ase_admin/index.php/Admin/ArticleCate/index.html" class="btn btn-sm btn-success" ><i class="icon-arrow-left"></i>返回列表</a>
                </div><!--表格上方蓝色部分 -->
                <form class="form-horizontal" method="post" action="{{ url('newwebadmin/category') }}" role="form" >
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" for="form-field-select-1"> 上级分类:</label>

                        <div class="col-sm-4">
                            <select class="form-control" id="form-field-select-1" name="pid">
                                <option value="0">一级分类</option>
                                {!! $category !!}
                            </select>
                        </div>
                    </div>
                    <div class="form-group">

                        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> 分类名称: </label>

                        <div class="col-sm-9">
                            <input type="text" name="name" id="form-field-1" placeholder="分类名称" value="{{ old('name') }}" class="col-xs-10 col-sm-5" />
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

                        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> 分类标题: </label>

                        <div class="col-sm-9">
                            <input type="text" name="title" id="form-field-2" value="{{ old('title') }}" placeholder="分类标题" class="col-xs-10 col-sm-5" />
                        </div>
                        @if($errors->has("title"))
                            <script>
                                layer.tips("{{ $errors->first("title") }}",$("#form-field-2"), {
                                    tips: [2, '#e53e49'],
                                    tipsMore: true
                                });
                            </script>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" for="form-field-7"> 分类描述: </label>
                        <div class="col-sm-9">
                            <textarea class="form-control" style="width:50%;" name="description" id="form-field-7" placeholder="分类描述">{{ old('description') }}</textarea>
                        </div>
                    </div>

                    <div class="clearfix form-actions">
                        <div class="col-md-offset-3 col-md-9">
                            <button class="btn btn-info" type="submit">
                                <i class="icon-ok bigger-110"></i>
                                新增				</button>

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