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
                <a href="/ase_admin/index.php/Admin/Index/index.html">首页</a>
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
                    会员编辑
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
                <form class="form-horizontal" action="{{ url('newwebadmin/user/'.$user->id) }}" method="post" role="form">
                    {{ csrf_field() }}
                    <input name="_method" type="hidden" value="put" />
                    <div class="form-group">

                        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> 用户名: </label>

                        <div class="col-sm-9">
                            <input type="text" name="nick_name" id="form-field-1" placeholder="填写用户名" value="{{ $user->name }}" class="col-xs-10 col-sm-5" />
                        </div>

                    </div>
                    <div class="form-group">

                        <label class="col-sm-2 control-label no-padding-right" for="form-field-2"> 邮箱地址: </label>

                        <div class="col-sm-9">
                            <input type="text" name="email" id="form-field-2" placeholder="填写邮箱地址" value="{{ $user->email }}" class="col-xs-10 col-sm-5" />
                        </div>

                    </div>
                    <div class="form-group">

                        <label class="col-sm-2 control-label no-padding-right" for="form-field-3"> 手机号码: </label>

                        <div class="col-sm-9">
                            <input type="text" name="phone" id="form-field-3" placeholder="填写手机号码" value="{{ $user->phone }}" class="col-xs-10 col-sm-5" />
                        </div>

                    </div>
                    <div class="form-group">

                        <label class="col-sm-2 control-label no-padding-right" for="form-field-4"> 会员密码: </label>

                        <div class="col-sm-9">
                            <input type="password" name="user_pwd" id="form-field-4" placeholder="" class="col-xs-10 col-sm-5" />
                        </div>

                    </div>
                    <div class="form-group">

                        <label class="col-sm-2 control-label no-padding-right" for="form-field-5"> 确认密码: </label>

                        <div class="col-sm-9">
                            <input type="password" name="user_confirm_pwd" id="form-field-5" placeholder="" class="col-xs-10 col-sm-5" />
                        </div>

                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" for="form-field-7"> 是否有效: </label>
                        <div class="col-sm-9">
                            <div class="radio">
                                <label>
                                    <input name="state" type="radio" class="ace" value="0" @if($user->state == 0) checked @endif />
                                    <span class="lbl"> 正常</span>
                                </label>
                                <label>
                                    <input name="state" type="radio" class="ace" value="1" @if($user->state == 1) checked @endif />
                                    <span class="lbl"> 禁用</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix form-actions">
                        <!--隐藏元素-->
                        <input type="hidden" name="id" value="{{ $user->id }}" />
                        <!--隐藏元素-->
                        <div class="col-md-offset-3 col-md-9">
                            <button class="btn btn-info" type="submit">
                                <i class="icon-ok bigger-110"></i>
                                编辑			</button>

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
<script src="{{ asset('/layer/layer.js?v=2.4') }}"></script>

@stop