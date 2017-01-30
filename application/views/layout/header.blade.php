<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />

	<meta charset="utf-8">
	<meta content="yes" name="apple-mobile-web-app-capable">
	<meta content="yes" name="apple-touch-fullscreen">
	<meta content="telephone=no" name="format-detection">
	<meta content="black" name="apple-mobile-web-app-status-bar-style">
	<meta name="author" content="todo.jwlchina.cn">
	<meta name="revisit-after" content="1 days">
	<meta name="keywords" content="todo tool">
	<meta name="description" content="todo tool">

	<title>William的工具箱</title>

	<!-- Bootstrap Core CSS -->
	<link href="{{base_url('/static')}}/css/bootstrap.css" rel="stylesheet">

	<!-- MetisMenu CSS -->
	<link href="{{base_url('/static')}}/css/metisMenu.min.css" rel="stylesheet">

	<!-- Custom CSS -->
	<link href="{{base_url('/static')}}/css/sb-admin-2.css" rel="stylesheet">

	<!-- Custom Fonts -->
	<link href="{{base_url('/static')}}/css/font-awesome.css" rel="stylesheet" type="text/css">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->

	<style type="text/css">
		.loading {
			position: absolute;
			display: none;
			width: 160px;
			height: 56px;
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
		@media (max-width: 768px) {
			.loading {
				left: 30%;
			}
		}
	</style>

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
			<a class="navbar-brand" href="{{base_url('/todo/index')}}">
				<?php
					$siteName = get_sys_config('site_name');
					echo empty($siteName)?'William的工具箱':$siteName;
				?>
			</a>
		</div>
		<!-- /.navbar-header -->

		<ul class="nav navbar-top-links navbar-right">
			<!-- /.dropdown -->
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#">
					<i class="fa fa-user fa-fw"></i> {{$_SESSION['we_user']['username']}} <i
							class="fa fa-caret-down"></i>
				</a>
				<ul class="dropdown-menu dropdown-user">
					<li><a href="{{base_url('/user/setting')}}"><i class="fa fa-star fa-fw"></i> 系统设置</a>
					</li>
					<li><a href="{{base_url('/user/changePass')}}"><i class="fa fa-gear fa-fw"></i> 修改密码</a>
					</li>
					<li class="divider"></li>
					<li><a href="{{base_url('/login/logout')}}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
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

					<li>
						<a href="{{base_url('/count/index')}}"><i class="fa fa-dashboard fa-fw"></i> 清单统计</a>
					</li>
					<li>
						<a href="{{base_url('/todo/index')}}"><i class="fa fa-list-alt fa-fw"></i> 任务清单</a>
					</li>
					<li>
						<a href="{{base_url('/timer/index')}}"><i class="fa fa-clock-o fa-fw"></i> 时钟</a>
					</li>

				</ul>
			</div>
			<!-- /.sidebar-collapse -->
		</div>
		<!-- /.navbar-static-side -->
	</nav>

	<!-- jQuery -->
	<script src="{{base_url('/static')}}/js/jquery-1.11.3.min.js"></script>

	<script src="{{base_url('/static')}}/js/juicer-min.js"></script>
	<!-- Bootstrap Core JavaScript -->
	<script src="{{base_url('/static')}}/js/bootstrap.min.js"></script>

	<!-- Metis Menu Plugin JavaScript -->
	<script src="{{base_url('/static')}}/js/metisMenu.min.js"></script>

	<!-- Custom Theme JavaScript -->
	<script src="{{base_url('/static')}}/js/http.js"></script>
	<script src="{{base_url('/static')}}/js/http_view.js"></script>

	<script src="{{base_url('/static')}}/js/function.js"></script>


	<!--loading-->
	<div class="loading">loading...</div>
	@yield('content')

</div>
<!-- /#wrapper -->


</body>

</html>
