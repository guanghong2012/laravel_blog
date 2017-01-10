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
                    导航列表
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

                            <div class="col-sm-3">

                                <label>导航名称： <input type="text" name="name" value="" /></label>

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
                            <th class="center"><label><input type="checkbox" id="check" class="ace checkbox" ><span class="lbl"></span></label></th>
                            <th width="80px"><a href="javascript:" >ID</a></th>
                            <th><a href="javascript:" >导航名称</a></th>
                            <th width="80px"><a href="javascript:" title="">排序<img src="{{ asset('admin_assets/images/desc.gif') }}" width="12" height="17" border="0" align="absmiddle"></a></th>
                            <th width="80px"><a href="javascript:" title="">链接地址</a></th>
                            <th><a href="javascript:" title=" ">是否启用</a></th>
                            <th >操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($navs as $key=>$val)
                            <tr>
                                <td align="center">
                                    <label><input type="checkbox" name="key" class="ace checkbox" value="{{ $val->id }}" /><span class="lbl"></span></label>
                                </td>
                                <td>{{ $val->id }}</td>
                                <td><a href="{{ url('newwebadmin/navigation/'.$val->id.'/edit') }}">{{ $val->name }}</a></td>

                                <td><span class='sort_span' onclick='set_sort(1,10,this);'>{{ $val->sort }}</span></td>

                                <td>{{ $val->url }}</td>
                                <td>{{ $val->created_at }}</td>
                                <td>
                                    <div class="visible-md visible-lg hidden-sm hidden-xs btn-group">
                                        <a class="btn btn-primary btn-xs" href="{{ url('newwebadmin/navigation/'.$val->id.'/edit') }}"><i class="icon-edit">编辑</i></a>&nbsp;
                                        <a class="btn btn-danger btn-xs" href="javascript: del('{{ $val->id }}')"><i class="icon-trash">删除</i></a>&nbsp;
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
                                <!--
                                <ul class="pagination">

                                    <li class="prev disabled"><a href="#"><i class="icon-double-angle-left"></i></a></li>

                                    <li class="active"><a href="#">1</a></li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li class="next"><a href="#"><i class="icon-double-angle-right"></i></a></li>
                                </ul>
                                -->
                                {{$navs->render()}}			</div>
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
        function del(id){
            layer.confirm('您确定要删除吗？', {
                btn: ['确定','取消'] //按钮
            }, function(){
                var _token = '{{csrf_token()}}';
                //异步删除
                $.post('{{ url('newwebadmin/navigation/') }}/'+id,{'_method':'delete','_token':_token},function(data){
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


        //完全删除
        function foreverdel(id)
        {

            if(!id)
            {

                idBox = $(".checkbox:checked");
                if(idBox.length == 0)
                {
                    layer.msg("请选择要删除的数据", {icon: 1});
                    return;
                }
                idArray = new Array();
                $.each( idBox, function(i, n){
                    idArray.push($(n).val());
                });
                id = idArray.join(",");
            }


            layer.confirm('您确定要删除吗？', {
                btn: ['确定','取消'] //按钮
            }, function(){
                var _token = '{{csrf_token()}}';
                //异步删除
                $.post('{{ url('newwebadmin/foreverdel') }}',{'table':'navigations',id:id,'_token':_token},function(data){
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