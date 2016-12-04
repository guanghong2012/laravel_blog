@extends('admin.common')

@section('page_plugin_styles')

@stop

@section('inline_styles')

@stop

@section('main-content')
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
            <li class="active">管理员管理</li>
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
                管理员管理
                <small>
                    <i class="icon-double-angle-right"></i>
                    编辑管理员
                </small>
            </h1>
        </div><!-- /.page-header -->


        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->
                <!--右侧部分开始-->

                <div class="table-header">
                    <a href="{{ url('newwebadmin/admin_user_index') }}" class="btn btn-sm btn-success" ><i class="icon-arrow-left"></i>返回列表</a>
                </div><!--表格上方蓝色部分 -->
                <div class="hr hr-10"></div>
                <form class="form-horizontal" action="" method="post" role="form">
                    <div class="form-group">

                        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> 管理员名称: </label>

                        <div class="col-sm-9">
                            <input type="text" name="adm_name" id="form-field-1" placeholder="管理员名称" value="{{ $info->adm_name }}" class="col-xs-10 col-sm-5" />
                        </div>

                    </div>

                    <div class="form-group">

                        <label class="col-sm-2 control-label no-padding-right" for="form-field-4"> 密码: </label>

                        <div class="col-sm-9">
                            <input type="password" name="adm_password" id="form-field-4" placeholder="" class="col-xs-10 col-sm-5" />
                            <label style="margin:10px;color:red;"> 留空就不修改密码！</label>
                        </div>

                    </div>
                    <div class="form-group">

                        <label class="col-sm-2 control-label no-padding-right" for="form-field-5"> 确认密码: </label>

                        <div class="col-sm-9">
                            <input type="password" name="adm_password2" id="form-field-5" placeholder="" class="col-xs-10 col-sm-5" />
                        </div>

                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" for="form-field-select-1"> 权限组:</label>

                        <div class="col-sm-3">
                            <select class="form-control" id="form-field-select-1" name="role_id">
                                <option value="" rel="0">请选择权限</option>
                                <option value="1" selected="selected" >超级管理员</option><option value="2"  >网站管理员</option>			</select>
                        </div>

                    </div>


                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" for="form-field-7"> 是否启用: </label>
                        <div class="col-sm-9">
                            <div class="radio">
                                @if($info->is_effect == 1)
                                <label>
                                    <input name="is_effect" type="radio" class="ace" value="1" checked="checked" />
                                    <span class="lbl"> 有效</span>
                                </label>
                                <label>
                                    <input name="is_effect" type="radio" class="ace" value="0"  />
                                    <span class="lbl"> 无效</span>
                                </label>
                                @else
                                <label>
                                    <input name="is_effect" type="radio" class="ace" value="1"  />
                                    <span class="lbl"> 有效</span>
                                </label>
                                <label>
                                    <input name="is_effect" type="radio" checked="checked" class="ace" value="0"  />
                                    <span class="lbl"> 无效</span>
                                </label>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="clearfix form-actions">
                        <div class="col-md-offset-3 col-md-9">
                            <!--隐藏元素-->
                            <input type="hidden" name="id" value="{{ $info->id }}" />
                            <!--隐藏元素-->
                            <button class="btn btn-info" type="submit">
                                <i class="icon-ok bigger-110"></i>
                                新增			</button>

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