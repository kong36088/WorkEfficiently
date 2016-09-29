﻿<!DOCTYPE html>
<html lang="en" class="no-js">
    <head>
        <meta charset="utf-8">
        <title>小工具登陆</title>
		<meta name="keywords" content="William的小工具" />
		<meta name="description" content="一个提升工作效率的工具" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

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
                <div class="error"><span>+</span></div>
            </form>
            <div class="connect">
                <p>Or connect with <a href="https://github.com/kong36088" target="_blank" style="text-decoration: none;">Me</a></p>
            </div>
        </div>
		
        <!-- Javascript -->
        <script src="{{base_url('/static')}}/js/jquery-1.11.3.min.js"></script>
        <script src="{{base_url('/static')}}/js/login/supersized.3.2.7.min.js"></script>
        <script src="{{base_url('/static')}}/js/login/supersized-init.js"></script>
        <script src="{{base_url('/static')}}/js/login/scripts.js"></script>

    </body>

</html>

