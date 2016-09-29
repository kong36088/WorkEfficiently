<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>管理系统</title>
    <style type="text/css">
        .loading {
            display: none;
            width: 160px;
            height: 56px;
            position: absolute;
            top: 40%;
            left: 50%;
            line-height: 56px;
            color: #fff;
            padding-left: 60px;
            font-size: 15px;
            background: #000 url({{base_url('/static')}}/img/progress.gif) no-repeat 10px 50%;
            opacity: 0.7;
            z-index: 9999;
            -moz-border-radius: 20px;
            -webkit-border-radius: 20px;
            border-radius: 20px;
            filter: progid:DXImageTransform.Microsoft.Alpha(opacity=70);
        }
    </style>

    <!-- Bootstrap Core CSS -->
    <link href="{{base_url('/static')}}/css/bootstrap.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{base_url('/static')}}/css/back/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{base_url('/static')}}/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="javascript:void(0)">后台管理系统</a>
        </div>
        <!-- Top Menu Items -->
        <ul class="nav navbar-right top-nav">

            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <span class="glyphicon glyphicon-user"></span> {{$_SESSION['admin_user']['username']}}
                    <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="{{base_url('/back/user/changePass')}}">
                            <span class="glyphicon glyphicon-lock"></span> 修改密码
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="{{base_url('/back/login/logout')}}">
                            <span class="glyphicon glyphicon-log-out"></span> 注销
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
        <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">
                <li class="collapse">
                    <a href="{{base_url('/back/count')}}">
                        <span class="glyphicon glyphicon-calendar"></span>&nbsp;&nbsp;系统概况
                    </a>
                </li>
	            <li class="collapse">
		            <a href="{{base_url('/back/school/index')}}">
			            <span class="glyphicon glyphicon-book"></span>&nbsp;&nbsp;学校信息管理
		            </a>
	            </li>
	            <li class="collapse">
		            <a href="{{base_url('/back/client/index')}}">
			            <span class="glyphicon glyphicon-folder-open"></span>&nbsp;&nbsp;客户信息管理
		            </a>
	            </li>
	            <li class="collapse">
		            <a href="{{base_url('/back/order/index')}}">
			            <span class="glyphicon glyphicon-align-justify"></span>&nbsp;&nbsp;订单信息查看
		            </a>
	            </li>
	            <li class="collapse">
		            <a href="{{base_url('/back/level/index')}}">
			            <span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;用户等级管理
		            </a>
	            </li>
	            <li class="collapse">
		            <a href="{{base_url('/back/user/index')}}">
			            <span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;后台用户管理
		            </a>
	            </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </nav>
    <!-- jQuery -->
    <script src="{{base_url('/static')}}/js/jquery-1.11.3.min.js"></script>
	<script src="{{base_url('/static')}}/js/back/function.js"></script>
    <script src="{{base_url('/static')}}/js/back/admin_http.js"></script>
	<script src="{{base_url('/static')}}/js/back/admin_http_view.js"></script>
    @yield('content')


</div>
<!-- /#wrapper -->


<!-- Bootstrap Core JavaScript -->
<script src="{{base_url('/static')}}/js/bootstrap.min.js"></script>
<script type="application/javascript">
</script>
</body>

</html>
