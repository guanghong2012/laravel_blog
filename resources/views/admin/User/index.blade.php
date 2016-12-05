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
                    会员列表
                </small>
            </h1>
        </div><!-- /.page-header -->


        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->
                <!--右侧部分开始-->



                <div class="table-header">
                    <button class="btn btn-sm btn-success" onclick="add();"><i class="icon-plus"></i>新增</button>
                    <button class="btn btn-sm btn-danger" onclick="foreverdel();"><i class="icon-trash"></i>删除</button>

                </div><!--表格上方蓝色部分 -->
                <div class="table-responsive">

                    <div class="row" style="padding-top: 12px;padding-bottom: 12px;background-color: #eff3f8;margin-right: 0px;margin-left: 0px;">
                        <form name="search" action="" method="get">

                            <div class="col-sm-2">
                                <label>用户名： <input type="text" name="name" value="" /></label>
                            </div>
                            <div class="col-sm-2">
                                <label>手机号码： <input type="text" name="phone" value="" /></label>
                            </div>
                            <div class="col-sm-2">
                                <button class="btn btn-sm btn-info"><i class="icon-search align-top bigger-125"></i>搜索</button>

                            </div>

                        </form>

                    </div>

                    <!-- Think 系统列表组件开始 -->
                    <table id="sample-table-1" class="table table-striped table-bordered table-hover" cellpadding=0 cellspacing=0 >
                        <thead>
                        <tr>
                            <th class="center"><label><input type="checkbox" id="check" class="ace" ><span class="lbl"></span></label></th>
                            <th width="50px    ">
                                <a href="javascript:sortBy('id','1','index')" title="按照编号升序排列 ">编号<img src="{{ asset('admin_assets/images/desc.gif') }}" width="12" height="17" border="0" align="absmiddle"></a>
                            </th>
                            <th><a href="javascript:sortBy('user_name','1','index')" title="按照用户名升序排列 ">用户名</a></th>
                            <th><a href="javascript:sortBy('email','1','index')" title="按照用户邮箱     升序排列 ">用户邮箱     </a></th>
                            <th><a href="javascript:sortBy('email','1','index')" title="按照用户邮箱     升序排列 ">用户手机     </a></th>
                            <th><a href="javascript:sortBy('login_time','1','index')" title=" ">登录次数     </a></th>
                            <th><a href="javascript:sortBy('is_effect','1','index')" title="按照状态升序排列 ">状态</a></th>
                            <th >操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $key=>$val)
                        <tr>
                            <td align="center"><label><input type="checkbox" name="key" class="ace" value="{{ $val->id }}" /><span class="lbl"></span></label></td>
                            <td>{{ $val->id }}</td>
                            <td><a href="{{ url('newwebadmin/user/'.$val->id.'/edit') }}">{{ $val->name }}</a></td>
                            <td>{{ $val->email }}</td>
                            <td>{{ $val->phone }}</td>
                            <td>{{ $val->login_number }}</td>
                            <td>
                                <label class="pull-center inline">
                                    <input type="checkbox" @if($val->is_state == 1) checked @endif class="ace ace-switch ace-switch-3" onclick="set_effect({{$val->id}},this);" />
                                    <span class="lbl"></span>
                                </label>
                            </td>
                            <td>
                                <div class="visible-md visible-lg hidden-sm hidden-xs btn-group">
                                    <a class="btn btn-primary btn-xs" href="{{ url('newwebadmin/user/'.$val->id.'/edit') }}"><i class="icon-edit">编辑</i></a>&nbsp;
                                    <a class="btn btn-danger btn-xs" href="javascript:void(0)" onclick="deluser({{$val->id}})"><i class="icon-trash">删除</i></a>&nbsp;

                                </div>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <!-- Think 系统列表组件结束 -->



                    <div class="row" style="background-color: #eff3f8;border-bottom: 1px solid #DDD;padding-bottom: 12px;padding-top: 12px;border-top: 1px solid #DDD;">
                        <!--
                        <div class="col-sm-6">
                            <div class="dataTables_info" id="sample-table-2_info">Showing 1 to 10 of 23 entries</div>
                        </div>
                        -->

                        <div class="col-sm-6">
                            <div class="dataTables_paginate paging_bootstrap">

                                <!--<ul class="pagination">    </ul>-->
                                {{$users->render()}}
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
<script src="{{ asset('/layer/layer.js?v=2.4') }}"></script>
<script>
    function deluser(id){
        layer.confirm('您确定要删除吗？', {
            btn: ['确定','取消'] //按钮
        }, function(){
            var _token = '{{csrf_token()}}';
            //异步删除
            $.post('{{ url('newwebadmin/user/') }}/'+id,{'_method':'delete','_token':_token},function(data){
                if(data.status == '1'){
                    //$(obj).parent().parent().remove();
                    layer.msg(data.msg, {icon: 1});
                    location.href = location.href;

                }else{
                    layer.msg(data.msg, {icon: 5});
                }


            },'json');

        }, function(){

        });
    }


</script>
@stop