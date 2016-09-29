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
				<form id="change-pass-form" method="post" class="form-horizontal"
				      action="{{base_url('/user/ajaxChangePass')}}">
					<div class="col-lg-12">
						<p class="text-info bg-info">密码长度为4-16位</p>
					</div>

					<span id="tip">
						@if (!empty($errors))
							<span style="color:red;">{{ $errors }}</span>
						@endif
					</span>

					<div class="col-lg-5" style="padding-left:30px;">
						<div class="form-group">
							<label for="opass" class="control-label">旧密码</label>
							<div class="">
								<input class="form-control" id="opass" name="opass"
								       placeholder="请输入旧密码" type="password">
							</div>
						</div>
						<div class="form-group">
							<label for="password" class="control-label">新密码</label>
							<div class="">
								<input class="form-control" id="password" name="password"
								       placeholder="请输入新密码" type="password">
							</div>
						</div>
						<div class="form-group">
							<label for="repass" class="control-label">再次输入</label>
							<div class="">
								<input class="form-control" id="repass" name="repass"
								       placeholder="请再次输入新密码" type="password">
							</div>
						</div>
						<button type="button" class="col-sm-1 btn btn-primary btn-block" id="submit">提交</button>
					</div>
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
			function checkInput() {
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
