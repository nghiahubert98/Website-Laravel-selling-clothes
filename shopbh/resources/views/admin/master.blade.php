<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Admin Page</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{ url('admin/bower_components/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="{{ url('admin/bower_components/metisMenu/dist/metisMenu.min.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ url('admin/dist/css/sb-admin-2.css') }}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{ url('admin/bower_components/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

    <!-- DataTables CSS -->
    <link href="{{ url('admin/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css') }}" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="{{ url('admin/bower_components/datatables-responsive/css/dataTables.responsive.css') }}" rel="stylesheet">

    <!-- CKEditor CKFinder-->
    <script type="text/javascript" src="{{ url('admin/js/ckeditor/ckeditor.js') }}"></script>
    <script type="text/javascript" src="{{ url('admin/js/ckfinder/ckfinder.js') }}"></script>
    <script type="text/javascript">
        var baseURL = "{!! url('/') !!}";
    </script>
    <script type="text/javascript" src="{{ url('admin/js/func_ckfinder.js') }}"></script>
    
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="">Admin Area</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i>{!! Auth::user()->username !!}</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="{!! url('logout') !!}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <a href="{!! url('index') !!}"><i class="fa fa-home fa-3x" aria-hidden="true"></i> Home</a>
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-clipboard fa-fw"></i> Bill<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <?php
                                        $count_order = DB::table('orders')->where('status',0)->get();
                                        $count_mail = DB::table('contacts')->where('status',0)->get();
                                    ?>
                                    <a href="{!! url('admin/bill/list') !!}">List Bill
                                        <button style="width:70px;display:inline-block;overflow: auto;white-space: nowrap;margin:0px auto;border:1px red solid; margin-left: 70px;" type="button" class="btn btn-warning">
                                          <span class="glyphicon glyphicon-list-alt"></span> {!! count($count_order) !!}
                                        </button>
                                    </a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Category<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{!! url('admin/cate/list') !!}">List Category</a>
                                </li>
                                <li>
                                    <a href="{!! url('admin/cate/add') !!}">Add Category</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-cube fa-fw"></i> Product<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{!! url('admin/product/list') !!}">List Product</a>
                                </li>
                                <li>
                                    <a href="{!! url('admin/product/add') !!}">Add Product</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-users fa-fw"></i> User<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{!! url('admin/user/list') !!}">List User</a>
                                </li>
                                <li>
                                    <a href="{!! url('admin/user/add') !!}">Add User</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="{!! url('admin/contact/list') !!}"><i class="fa fa-envelope"></i> Mailbox 
                                <button style="width:70px;display:inline-block;overflow: auto;white-space: nowrap;margin:0px auto;border:1px red solid; margin-left: 70px;" type="button" class="btn btn-warning">
                                    <span class="fa fa-envelope"></span> {!! count($count_mail) !!}
                                </button>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3">
                        @if(Session::has('flash_message'))
                            <div class="alert alert-{!! Session::get('flash_level') !!}">
                                {!! Session::get('flash_message') !!}
                            </div>
                        @endif
                    </div>
                    <!-- Phan noi dung-->
                    @yield('content')
                    <!-- Ket thuc noi dung-->

                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="{{ url('admin/bower_components/jquery/dist/jquery.min.js') }}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ url('admin/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="{{ url('admin/bower_components/metisMenu/dist/metisMenu.min.js') }}"></script>

    <!-- Custom Theme JavaScript -->
    <script src="{{ url('admin/dist/js/sb-admin-2.js') }}"></script>

    <!-- DataTables JavaScript -->
    <script src="{{ url('admin/bower_components/DataTables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('admin/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js') }}"></script>

    <!-- Myscript -->
    <script src="{{ url('admin/js/myscript.js') }}"></script>

</body>

</html>
