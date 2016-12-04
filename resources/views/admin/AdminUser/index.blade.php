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
                    管理员列表
                </small>
            </h1>
        </div><!-- /.page-header -->
        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->
                <!--右侧部分开始-->

                <div class="table-header">
                    <button class="btn btn-sm btn-success" onclick="add();"><i class="icon-plus"></i>新增</button>
                    <button class="btn btn-sm btn-danger" onclick="del();"><i class="icon-trash"></i>移到回收站</button>

                </div><!--表格上方蓝色部分 -->
                <div class="table-responsive">


                    <!-- Think 系统列表组件开始 -->
                    <table id="sample-table-1" class="table table-striped table-bordered table-hover" cellpadding=0 cellspacing=0 >
                        <thead>
                        <tr>
                            <th class="center">
                                <label><input type="checkbox" id="check" class="ace" ><span class="lbl"></span></label>
                            </th>
                            <th width="50px">
                                <a href="javascript:sortBy('id','1','index')" title="按照编号升序排列 ">编号<img src="{{ asset('admin_assets/images/desc.gif') }}" width="12" height="17" border="0" align="absmiddle"></a>
                            </th>
                            <th>
                                <a href="javascript:sortBy('adm_name','1','index')" title="按照管理员名升序排列 ">管理员账号</a>
                            </th>
                            <th>
                                <a href="javascript:sortBy('role_id','1','index')" title="按照权限组    升序排列 ">权限组    </a>
                            </th>
                            <th>
                                <a href="javascript:sortBy('login_time','1','index')" title="按照最后登陆时间    升序排列 ">最后登陆时间    </a>
                            </th>
                            <th>
                                <a href="javascript:sortBy('login_ip','1','index')" title="按照登陆IP    升序排列 ">登陆IP    </a>
                            </th>
                            <th>
                                <a href="javascript:sortBy('is_effect','1','index')" title="按照是否启用 升序排列 ">是否启用 </a>
                            </th>
                            <th >操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($list as $key=>$val)
                        <tr>
                            <td align="center"><label><input type="checkbox" name="key" class="ace" value="{{ $val['id'] }}" /><span class="lbl"></span></label></td>
                            <td>{{ $val['id'] }}</td>
                            <td><a href="{{ url('newwebadmin/admin_user_edit/id/'.$val['id']) }}">{{ $val['adm_name'] }}</a></td>
                            <td>超级管理员</td>
                            <td>{{ date('Y-m-d H:i:s',$val['login_time']) }}</td>
                            <td>{{ $val['login_ip'] }}</td>
                            <td>
                                <label class="pull-center inline">
                                    @if($val['is_effect'] == 1)
                                    <input  checked type="checkbox" class="ace ace-switch ace-switch-3" onclick="set_effect(1,this);" />
                                    @else
                                    <input type="checkbox" class="ace ace-switch ace-switch-3" onclick="set_effect(0,this);" />
                                    @endif
                                    <span class="lbl"></span>
                                </label>
                            </td>
                            <td>
                                <div class="visible-md visible-lg hidden-sm hidden-xs btn-group">
                                    <a class="btn btn-primary btn-xs" href="{{ url('newwebadmin/admin_user_edit/id/'.$val['id']) }}"><i class="icon-edit">编辑</i></a>&nbsp;
                                    <a class="btn btn-primary btn-xs" href="javascript: del('1')">移到回收站</a>&nbsp;
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <!-- Think 系统列表组件结束 -->



                    <div class="row" style="background-color: #eff3f8;border-bottom: 1px solid #DDD;padding-bottom: 12px;padding-top: 12px;border-top: 1px solid #DDD;">


                        <div class="col-sm-6">
                            <div class="dataTables_paginate paging_bootstrap">
                                <!--分页-->
                                <ul class="pagination">    </ul>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- PAGE CONTENT ENDS -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.page-content -->



@stop

                <!--当前页面需要用到的js-->
@section('page_script')

@stop