@extends('layout.header')

@section('content')
	<!--loading-->
	<div class="loading">loading...</div>
	<!--loading-->
	<div id="page-wrapper">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header">修改密码</h1>
				</div>
				<form id="change-pass-form" method="post" class="form-horizontal" action="{{base_url('/back/user/ajaxChangePass')}}">
					<div class="container-fluid">
						<!-- Page Heading -->
						<div class="row">
							<div class="col-lg-12">
								<h1 class="page-header">
									修改密码
									<small></small>
								</h1>
								<ol class="breadcrumb">
									<li>
										管理系统
									</li>
									<li class="active">
										修改密码
									</li>
								</ol>
								<p class="text-info bg-info">密码长度为4-16位</p>
								<div>
									<!--<caption>提示：增加部门（学校）默认是增加在根节点处</caption>-->
								</div>

								<div class="col-lg-12" style="display:inline-block;">
									<ul id="tree" class="ztree"></ul>
								</div>

							</div>
						</div>
						<!-- /.row -->
					</div>
					<!-- /.container-fluid -->

					<span id="tip">
						@if (!empty($errors))
							<span style="color:red;">{{ $errors }}</span>
						@endif
					</span>

					<div class="form-group">
						<label for="opass" class="col-sm-1 control-label">旧密码</label>
						<div class="col-sm-4">
							<input class="form-control" id="opass" name="opass"
							       placeholder="请输入旧密码" type="password">
						</div>
					</div>
					<div class="form-group">
						<label for="password" class="col-sm-1 control-label">新密码</label>
						<div class="col-sm-4">
							<input class="form-control" id="password" name="password"
							       placeholder="请输入新密码" type="password">
						</div>
					</div>
					<div class="form-group">
						<label for="repass" class="col-sm-1 control-label">再次输入</label>
						<div class="col-sm-4">
							<input class="form-control" id="repass" name="repass"
							       placeholder="请再次输入新密码" type="password">
						</div>
					</div>
					<button type="button" class="col-sm-1 btn btn-primary col-sm-offset-1" id="submit">提交</button>
					<button type="reset" class="col-sm-1 btn btn-primary col-sm-offset-1" id="reset">重置</button>
				</form>
			</div>
		</div>
	</div>

	<script type="application/javascript">
		$(document).ready(function () {
			$("#repass").blur(function () {
				checkInput();
			});
			/*$("#change-pass-form").on('submit',function(){
				if(!checkInput()){
					return false;
				}
				$(this).submit();
			});*/
			function checkInput(){
				var pass = $("#password").val();
				var repass = $("#repass").val();
				if (pass == repass) {
					if (pass.length < 4 || pass.length > 20) {
						$("#tip").text('密码必须为4-20位!').css('color', 'red');
						$("#submit").attr("type", 'button');
						return false;
					} else {
						$("#tip").text('');
						$("#submit").attr("type", "submit");
						return true;
					}
				} else {
					$("#tip").text('两次密码不一致').css('color', 'red');
					$("#submit").attr("type", 'button');
					return false;
				}
			}
		});
	</script>
@endsection
