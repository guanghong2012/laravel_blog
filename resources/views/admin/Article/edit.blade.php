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
            <li class="active">文章管理</li>
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
                文章管理
                <small>
                    <i class="icon-double-angle-right"></i>
                    编辑文章
                </small>
            </h1>
        </div><!-- /.page-header -->


        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->
                <!--右侧部分开始-->

                <div class="table-header">
                    <a href="{{ url('newwebadmin/article') }}" class="btn btn-sm btn-success" ><i class="icon-arrow-left"></i>返回列表</a>
                </div><!--表格上方蓝色部分 -->
                <div class="hr hr-10"></div>
                <form class="form-horizontal" method="post" action="{{ url('newwebadmin/article/'.$article->id) }}" role="form" >
                    {{ csrf_field() }}
                    <input name="_method" type="hidden" value="put" />
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" for="form-field-select-1"> 分类:</label>

                        <div class="col-sm-4">

                            <select class="form-control" id="form-field-select-1" name="pid">

                                <option value='1' selected="selected"> 关于网站</option>
                                <option value='7' >&nbsp;├ 关于众筹</option>
                                <option value='11' >&nbsp;├ 联系我们</option>
                                <option value='12' >&nbsp;├ 用户协议</option>
                                <option value='14' >&nbsp;│&nbsp;└ 测试添加三级</option>
                                <option value='13' >&nbsp;└ 疑问解答</option>
                                <option value='9' > 新手帮助</option>
                            </select>

                        </div>
                    </div>
                    <div class="form-group">

                        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> 信息名称: </label>

                        <div class="col-sm-9">
                            <input type="text" name="name" id="form-field-1" placeholder="信息名称" class="col-xs-10 col-sm-5" value="{{ $article->name }}" />

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

                        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> 文章标题: </label>

                        <div class="col-sm-9">
                            <input type="text" name="title" id="title" placeholder="文章标题" class="col-xs-10 col-sm-5" value="{{ $article->title }}" />

                            @if($errors->has("title"))
                                <script>
                                    layer.tips("{{ $errors->first("title") }}",$("#title"), {
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
                            <div class="none_border"><input type="hidden"  id="id_images" name="images" style="width:120px; height:25px;" value='' /><a class="ke-icon"  href="javascript:;" onclick="open_upload('images','images')" title="图片上传"><span class="button button_huise">图片上传</span></a><img src="/ase_admin/Public/Admin/images/no_pic.gif" onclick="" style='display:inline-block; float:left; cursor:pointer; margin-left:10px; border:#ccc solid 1px; width:35px; height:35px;' id='img_images' /><img src="/ase_admin/Public/Admin/images/del.gif" style='display:none; margin-left:10px; float:left; border:#ccc solid 1px; width:35px; height:35px; cursor:pointer;' id='img_del_images' onclick='delimg("images")' title='删除' />
                                <label style="margin:10px;color:red;">*(这里填写图片大小指示，例：600px*800px)</label>
                            </div>

                        </div>
                    </div>

                        <div class="form-group">

                            <label class="col-sm-2 control-label no-padding-right" for="form-field-3"> 发布日期: </label>

                            <div class="col-sm-9">
                                <input type="text" class="col-xs-10 col-sm-5" name="created_at" id="create_time" value="{{ $article->created_at }}" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" />
                                <label class="laydate-icon"></label>
                            </div>

                        </div>
                        <div class="form-group">

                            <label class="col-sm-2 control-label no-padding-right" for="form-field-4"> 浏览次数: </label>

                            <div class="col-sm-9">
                                <input type="text" name="click" id="form-field-4" placeholder="浏览次数" class="col-xs-10 col-sm-5" value="{{ $article->click }}" />
                            </div>

                        </div>
                        <div class="form-group">

                            <label class="col-sm-2 control-label no-padding-right" for="form-field-5"> 排序: </label>

                            <div class="col-sm-9">
                                <input type="text" name="sort" id="form-field-5" placeholder="排序" class="col-xs-10 col-sm-5" value="{{ $article->sort }}" />
                            </div>

                        </div>
                        <div class="form-group">

                            <label class="col-sm-2 control-label no-padding-right" for="form-field-6"> 关键词: </label>

                            <div class="col-sm-9">
                                <input type="text" name="keywords" id="form-field-6" placeholder="关键词" class="col-xs-10 col-sm-5" value="{{ $article->keywords }}" />
                            </div>

                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" for="form-field-7"> 描述: </label>
                            <div class="col-sm-9">
                                <textarea class="form-control" style="width:50%;" name="description" id="form-field-7" placeholder="描述">{{ $article->description }}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" for="form-field-7"> 详细内容: </label>
                            @include("zhangmazi::ueditor")
                            <div id="content" style="width:900px;float:left;">
                                <script id="demo_full_toolbar" name="content" type="text/plain">{!! $article->content !!}</script>
                                <script type="text/javascript">
                                    // 定义默认编辑器高度
                                    var ueditor_height = 480;
                                    var ueditor_width = 900;
                                    // UE编辑器上传参数-通用版
                                    function getUeditorCommonParams() {
                                        return {
                                            'thumb_appointed' : '0',    //强制缩略图, 1=是,0=否,支持多组,用逗号分隔开,如0,0,0,0
                                            'thumb_water' : '0',     //是否水印,1=是,0=否,支持多组,用逗号分隔开,如0,0,0,0
                                            'thumb_num' : '1',      //缩略图数量, 跟多组有关联性
                                            'thumb_max_width' : '600',  //缩略图最大宽度, 多组用逗号分隔并由小到大,如200,400,800
                                            'thumb_max_height' : '2000',//缩略图最大高度, 多组用逗号分隔并由小到大,如200,400,800
                                            'ext_type' : '100', //允许上传的扩展名
                                            'need_origin_pic' : 0,  //是否保留原图, 1=要, 0=不
                                            '_token' : '{{ csrf_token() }}',    //Laravel 校验token用的
                                        };
                                    }


                                    // 生成一个全部工具条的编辑器
                                    var ueditor_full = UE.getEditor('demo_full_toolbar', {
                                        'serverUrl' : '{{ route("zhangmazi_front_ueditor_service", ['_token' => csrf_token()]) }}',
                                        'autoHeightEnabled' : false,
                                        'pageBreakTag' : 'editor_page_break_tag',
                                        'maximumWords' : 1000000,   //自定义可以输入多少字
                                        'initialFrameWidth' : "100%",
                                        'initialFrameHeight' : ueditor_height
                                    });



                                </script>
                            </div>

                            @if($errors->has("content"))
                                <script>
                                    layer.tips("{{ $errors->first("content") }}",$("#content"), {
                                        tips: [2, '#e53e49'],
                                        tipsMore: true
                                    });
                                </script>
                            @endif
                        </div>

                        <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9">
                                <input type="hidden" value="{{ $article->id }}" name="id">
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