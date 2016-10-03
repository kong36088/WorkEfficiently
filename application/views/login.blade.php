<!DOCTYPE html>
<html lang="en" class="no-js">
    <head>
        <meta charset="utf-8">
        <title>小工具登陆</title>
		<meta name="keywords" content="William的小工具" />
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
            <h1>登录</h1>
	        <p style="color:red;">{{empty($errors)?'':$errors}}</p>
            <form action="{{base_url('/login/login')}}" method="post">
                <input type="text" name="username" class="username" placeholder="用户名">
                <input type="password" name="password" class="password" placeholder="密码">
                <button type="submit">提交</button>
	            <a href="{{base_url('/login/register')}}"><button type="button">注册</button></a>
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

    </body>

</html>


