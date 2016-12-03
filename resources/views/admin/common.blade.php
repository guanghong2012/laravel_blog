<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>{{@$title}} - {{ Config::get('app.name') }}</title>
    <meta name="keywords" content="曙光科技工作室Laravel后台管理" />
    <meta name="description" content="曙光科技工作室Laravel后台管理" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- basic styles -->
    <link href="{{ asset('admin_assets//css/bootstrap.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('admin_assets/css/font-awesome.min.css') }}" />

    <!--[if IE 7]>
      <link rel="stylesheet" href="{{ asset('admin_assets/css/font-awesome-ie7.min.css')}}" />
    <![endif]-->

    <!-- page specific plugin styles -->
    @section('page_plugin_styles')

    @show
    <!-- fonts -->

    <!--<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300" />-->

    <!-- ace styles -->

    <link rel="stylesheet" href="{{ asset('admin_assets/css/ace.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin_assets/css/ace-rtl.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin_assets/css/ace-skins.min.css') }}" />

    <!--[if lte IE 8]>
      <link rel="stylesheet" href="{{ asset('admin_assets/css/ace-ie.min.css') }}" />
    <![endif]-->

    <!-- inline styles related to this page -->
    @section('inline_styles')

    @show
    <!-- ace settings handler -->

    <script src="{{ asset('admin_assets/js/ace-extra.min.js') }}"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

    <!--[if lt IE 9]>
    <script src="{{ asset('admin_assets/js/html5shiv.js')}}"></script>
    <script src="{{ asset('admin_assets/js/respond.min.js')}}"></script>
    <![endif]-->
</head>

<body>
<!--顶部菜单开始-->
@include('admin.navbar')
<!--顶部菜单结束-->
<div class="main-container" id="main-container">
    <script type="text/javascript">
        try{ace.settings.check('main-container' , 'fixed')}catch(e){}
    </script>

    <div class="main-container-inner">
        <a class="menu-toggler" id="menu-toggler" href="#">
            <span class="menu-text"></span>
        </a>
        <!--左侧菜单开始-->
        @section('sidebar')
        <div class="sidebar" id="sidebar">
            <script type="text/javascript">
                try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
            </script>

            <div class="sidebar-shortcuts" id="sidebar-shortcuts">
                <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
                    <button class="btn btn-success">
                        <i class="icon-signal"></i>
                    </button>

                    <button class="btn btn-info">
                        <i class="icon-pencil"></i>
                    </button>

                    <button class="btn btn-warning">
                        <i class="icon-group"></i>
                    </button>

                    <button class="btn btn-danger">
                        <i class="icon-cogs"></i>
                    </button>
                </div>

                <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
                    <span class="btn btn-success"></span>

                    <span class="btn btn-info"></span>

                    <span class="btn btn-warning"></span>

                    <span class="btn btn-danger"></span>
                </div>
            </div><!-- #sidebar-shortcuts -->

            <ul class="nav nav-list">
                <li class="active">
                    <a href="{{ url('newwebadmin/index') }}">
                        <i class="icon-dashboard"></i>
                        <span class="menu-text"> 控制台 </span>
                    </a>
                </li>


                <li>
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-user"></i>
                        <span class="menu-text"> 会员管理 </span>

                        <b class="arrow icon-angle-down"></b>
                    </a>

                    <ul class="submenu">
                        <li>
                            <a href="tables.html">
                                <i class="icon-double-angle-right"></i>
                                会员列表
                            </a>
                        </li>

                        <li>
                            <a href="jqgrid.html">
                                <i class="icon-double-angle-right"></i>
                                会员添加
                            </a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-folder-open-alt"></i>
                        <span class="menu-text"> 文章分类 </span>

                        <b class="arrow icon-angle-down"></b>
                    </a>

                    <ul class="submenu">
                        <li>
                            <a href="form-elements.html">
                                <i class="icon-double-angle-right"></i>
                                分类类别
                            </a>
                        </li>

                        <li>
                            <a href="form-wizard.html">
                                <i class="icon-double-angle-right"></i>
                                分类添加
                            </a>
                        </li>

                    </ul>
                </li>

                <li>
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-edit"></i>
                        <span class="menu-text"> 文章管理 </span>

                        <b class="arrow icon-angle-down"></b>
                    </a>

                    <ul class="submenu">
                        <li>
                            <a href="form-elements.html">
                                <i class="icon-double-angle-right"></i>
                                文章列表
                            </a>
                        </li>

                        <li>
                            <a href="form-wizard.html">
                                <i class="icon-double-angle-right"></i>
                                文章添加
                            </a>
                        </li>

                    </ul>
                </li>

                <li>
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-edit"></i>
                        <span class="menu-text"> 留言管理 </span>

                        <b class="arrow icon-angle-down"></b>
                    </a>

                    <ul class="submenu">
                        <li>
                            <a href="form-elements.html">
                                <i class="icon-double-angle-right"></i>
                                留言列表
                            </a>
                        </li>
                        

                    </ul>
                </li>


            </ul><!-- /.nav-list -->

            <div class="sidebar-collapse" id="sidebar-collapse">
                <i class="icon-double-angle-left" data-icon1="icon-double-angle-left" data-icon2="icon-double-angle-right"></i>
            </div>

            <script type="text/javascript">
                try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
            </script>
        </div>
        @show
        <!--左侧菜单结束-->
        <div class="main-content">
            @section('main-content')

            @show

        </div><!-- /.main-content -->

        <div class="ace-settings-container" id="ace-settings-container">
            <div class="btn btn-app btn-xs btn-warning ace-settings-btn" id="ace-settings-btn">
                <i class="icon-cog bigger-150"></i>
            </div>

            <div class="ace-settings-box" id="ace-settings-box">
                <div>
                    <div class="pull-left">
                        <select id="skin-colorpicker" class="hide">
                            <option data-skin="default" value="#438EB9">#438EB9</option>
                            <option data-skin="skin-1" value="#222A2D">#222A2D</option>
                            <option data-skin="skin-2" value="#C6487E">#C6487E</option>
                            <option data-skin="skin-3" value="#D0D0D0">#D0D0D0</option>
                        </select>
                    </div>
                    <span>&nbsp; 选择皮肤</span>
                </div>

                <div>
                    <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-navbar" />
                    <label class="lbl" for="ace-settings-navbar"> 固定导航条</label>
                </div>

                <div>
                    <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-sidebar" />
                    <label class="lbl" for="ace-settings-sidebar"> 固定滑动条</label>
                </div>

                <div>
                    <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-breadcrumbs" />
                    <label class="lbl" for="ace-settings-breadcrumbs">固定面包屑</label>
                </div>

                <div>
                    <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-rtl" />
                    <label class="lbl" for="ace-settings-rtl">切换到左边</label>
                </div>

                <div>
                    <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-add-container" />
                    <label class="lbl" for="ace-settings-add-container">
                        切换窄屏
                        <b></b>
                    </label>
                </div>
            </div>
        </div><!-- /#ace-settings-container -->
    </div><!-- /.main-container-inner -->

    <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
        <i class="icon-double-angle-up icon-only bigger-110"></i>
    </a>
</div><!-- /.main-container -->

<!-- basic scripts -->

<!--[if !IE]> -->
<!--
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
-->
<!-- <![endif]-->

<!--[if IE]>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<![endif]-->

<!--[if !IE]> -->

<script type="text/javascript">
    var scriptpaths = "{{ asset('admin_assets/js/jquery-2.0.3.min.js') }}";
    window.jQuery || document.write("<script src='"+scriptpaths+"'>"+"<"+"script>");
</script>

<!-- <![endif]-->

<!--[if IE]>
<script type="text/javascript">
    var aapath = "{{ asset('admin_assets/js/jquery-1.10.2.min.js') }}";
window.jQuery || document.write("<script src='"+aapath+"'>"+"<"+"script>");
</script>
<![endif]-->

<script type="text/javascript">
    var bbpaths = "{{ asset('admin_assets/js/jquery.mobile.custom.min.js') }}}";
    if("ontouchend" in document) document.write("<script src='"+bbpaths+"'>"+"<"+"script>");
</script>
<script src="{{ asset('admin_assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/typeahead-bs2.min.js') }}"></script>

<!-- page specific plugin scripts -->

<!--[if lte IE 8]>
  <script src="{{ asset('admin_assets/js/excanvas.min.js')}}"></script>
<![endif]-->

<script src="{{ asset('admin_assets/js/jquery-ui-1.10.3.custom.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/jquery.ui.touch-punch.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/jquery.easy-pie-chart.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/jquery.sparkline.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/flot/jquery.flot.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/flot/jquery.flot.pie.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/flot/jquery.flot.resize.min.js') }}"></script>

<!-- ace scripts -->

<script src="{{ asset('admin_assets/js/ace-elements.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/ace.min.js') }}"></script>

<!-- inline scripts related to this page -->
<!--当前页面需要用到的js-->
@section('page_script')

@show
<script type="text/javascript">
    jQuery(function($) {
        //全选列表元素
        $('table th input:checkbox').on('click' , function(){
            var that = this;
            $(this).closest('table').find('tr > td:first-child input:checkbox')
                    .each(function(){
                        this.checked = that.checked;
                        $(this).closest('tr').toggleClass('selected');
                    });

        });
    })

</script>
</body>
</html>