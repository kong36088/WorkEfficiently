<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
	<meta charset="utf-8">
	<title>小工具注册</title>
	<meta name="keywords" content="William的小工具"/>
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

	<!-- CSS -->
	<link rel="stylesheet" href="{{base_url('/static')}}/css/login/reset.css">
	<link rel="stylesheet" href="{{base_url('/static')}}/css/login/supersized.css">
	<link rel="stylesheet" href="{{base_url('/static')}}/css/login/style.css">

	<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

</head>

<body>

<div class="page-container">
	<h1>注册</h1>
	<p style="color:red;" id="errors">{{empty($errors)?'':$errors}}</p>
	<form action="{{base_url('/login/register')}}" method="post" id="register-form">
		<input type="text" name="username" class="username" placeholder="用户名">
		<input type="password" name="password" class="password" placeholder="密码">
		<input type="password" name="repass" class="repass" placeholder="重复密码">
		<button type="submit">提交</button>
		<a href="{{base_url('/login/login')}}"><button type="button">登陆</button></a>
		<div class="error"><span>+</span></div>
	</form>
	<div class="connect">
		<p>Or star <a href="https://github.com/kong36088" target="_blank" style="text-decoration: none;">Me</a></p>
	</div>
</div>

<!-- Javascript -->
<script src="{{base_url('/static')}}/js/jquery-1.11.3.min.js"></script>
<script src="{{base_url('/static')}}/js/login/supersized.3.2.7.min.js"></script>
<script src="{{base_url('/static')}}/js/login/supersized-init.js"></script>
<script src="{{base_url('/static')}}/js/login/scripts.js"></script>
<script type="application/javascript">
	$("#register-form").on("submit", function () {
		var username = $(this).find("input[name=username]").val();
		var password = $(this).find("input[name=password]").val();
		var repass = $(this).find('input[name=repass]').val();
		if(username.length<4||username.length>20){
			$("#errors").text('用户名长度在4-20位之间');
			return false;
		}
		if(password.length<4||password.length>20){
			$("#errors").text('密码长度在4-20位之间');
			return false;
		}
		if (password != repass) {
			$("#errors").text('两次密码不一致');
			return false;
		}
	});
</script>

</body>

</html>


