<!DOCTYPE html>
<!--[if lt IE 7 ]>
<html lang="en" class="no-js ie6 lt8"> <![endif]-->
<!--[if IE 7 ]>
<html lang="en" class="no-js ie7 lt8"> <![endif]-->
<!--[if IE 8 ]>
<html lang="en" class="no-js ie8 lt8"> <![endif]-->
<!--[if IE 9 ]>
<html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html lang="en" class="no-js"> <!--<![endif]-->
<head>
	<meta charset="UTF-8"/>
	<!-- <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">  -->
	<title>设管理系统</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Login and Registration Form with HTML5 and CSS3"/>
	<meta name="keywords" content="html5, css3, form, switch, animation, :target, pseudo-class"/>
	<meta name="author" content="Codrops"/>

	<link rel="stylesheet" type="text/css" href="{{base_url('/static')}}/css/back/demo.css"/>
	<link rel="stylesheet" type="text/css" href="{{base_url('/static')}}/css/back/style.css"/>
	<link rel="stylesheet" type="text/css" href="{{base_url('/static')}}/css/back/animate-custom.css"/>
</head>
<body>
<div class="container">
	<!-- Codrops top bar -->
	<div class="codrops-top">
		<a href="">
			<strong>管理员登陆</strong>
		</a>
		<span class="right"></span>
		<div class="clr"></div>
	</div><!--/ Codrops top bar -->
	<header>
		@if (!empty($errors))
			<span style="color:red;font-size:28px;">{{ strip_tags($errors) }}</span>
		@endif
	</header>
	<section>
		<div id="container_demo">
			<a class="hiddenanchor" id="toregister"></a>
			<a class="hiddenanchor" id="tologin"></a>
			<div id="wrapper">
				<div id="login" class="animate form">
					<form action="{{base_url('back/login/login')}}" method="post" id="login-form">
						<h1>Login</h1>
						<p>
							<label for="username" class="uname" data-icon="u"> 用户名 </label>
							<input id="username" name="username" required="required" type="text"
							       placeholder="用户名"/>
						</p>
						<p>
							<label for="password" class="youpasswd" data-icon="p"> 密码 </label>
							<input id="password" name="password" required="required" type="password"
							       placeholder="密码"/>
						</p>
						<p class="login button">
							<input type="button" value="登陆" id="submit-btn"/>
						</p>
					</form>
				</div>
			</div>
		</div>
	</section>
</div>
<script src="{{base_url('/static')}}/js/jquery-1.11.3.min.js"></script>
<script src="{{base_url('/static')}}/js/back/scripts.js"></script>
</body>
</html>