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
            <li class="active">轮播图管理</li>
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
                轮播图管理
                <small>
                    <i class="icon-double-angle-right"></i>
                    新增轮播图
                </small>
            </h1>
        </div><!-- /.page-header -->


        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->
                <!--右侧部分开始-->

                <div class="table-header">
                    <a href="{{ url('newwebadmin/banner') }}" class="btn btn-sm btn-success" ><i class="icon-arrow-left"></i>返回列表</a>
                </div><!--表格上方蓝色部分 -->
                <div class="hr hr-10"></div>
                <form class="form-horizontal" method="post" action="{{ url('newwebadmin/banner') }}" role="form" >
                    {{ csrf_field() }}

                    <div class="form-group">

                        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> 信息名称: </label>

                        <div class="col-sm-9">
                            <input type="text" name="name" id="form-field-1" placeholder="信息名称" class="col-xs-10 col-sm-5" value="{{ old('name') }}" />

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
                            <input type="text" name="url" id="title" placeholder="链接地址" class="col-xs-10 col-sm-5" value="{{ old('title') }}" />

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

                        <label class="col-sm-2 control-label no-padding-right" for="form-field-99"> 图片: </label>

                        <div class="col-sm-9">
                            <div class="none_border">
                                <input type="hidden"  id="id_images" name="images"  value="" /><!--图片保存目录-->
                                <a class="ke-icon"  href="javascript:;" onclick="open_upload('images','images')" title="图片上传"><span class="button button_huise">图片上传</span></a>

                                <img src="{{ asset('admin_assets/images/no_pic.gif') }}"  style='display:inline-block; float:left; cursor:pointer; margin-left:10px; border:#ccc solid 1px; width:35px; height:35px;' id='img_images' /><!--无图片显示-->

                                <img src="{{ asset('admin_assets/images/del.gif') }}" style='display:none; margin-left:10px; float:left; border:#ccc solid 1px; width:35px; height:35px; cursor:pointer;' id='img_del_images' onclick='delimg("images","articles")' title='删除' />


                                <label style="margin:10px;color:red;">*(图片大小指示：800px*200px)</label>
                            </div>

                        </div>
                    </div>

                    <div class="form-group">

                        <label class="col-sm-2 control-label no-padding-right" for="form-field-3"> 发布日期: </label>

                        <div class="col-sm-9">
                            <input type="text" class="col-xs-10 col-sm-5" name="created_at" id="create_time" value="{{ old('created_at') }}" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" />
                            <label class="laydate-icon"></label>
                        </div>

                    </div>
                    <div class="form-group">

                        <label class="col-sm-2 control-label no-padding-right" for="form-field-5"> 排序: </label>

                        <div class="col-sm-9">
                            <input type="text" name="sort" id="form-field-5" placeholder="排序" class="col-xs-10 col-sm-5" value="1" />
                        </div>

                    </div>

                    <div class="clearfix form-actions">
                        <div class="col-md-offset-3 col-md-9">

                            <button class="btn btn-info" type="submit">
                                <i class="icon-ok bigger-110"></i>
                                提交				</button>

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