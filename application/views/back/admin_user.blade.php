@extends('layout.header.blade.php.bak')

@section('content')
	<!--loading-->
	<div class="loading">loading...</div>
	<!--loading-->

	<div id="page-wrapper">

		<div class="container-fluid">

			<!-- Page Heading -->
			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header">
						管理系统
						<small>管理员用户</small>
					</h1>
					<ol class="breadcrumb">
						<li>
							管理系统
						</li>
						<li class="active">
							管理超级用户
						</li>
					</ol>
					<div class="pull-left">
						<button type="button" id="add-modal-btn" class="btn btn-primary btn-sm">增加管理员</button>
					</div>
					<div class="pull-right">
						<form class="form-horizontal" method="get" style="display:inline-block;">
							<div style="display:inline-block;">
								<input placeholder="请输入用户名称" name="name" class="form-control"
								       value="{{empty($_GET['name'])?'':$_GET['name']}}"/>
							</div>
							<div style="display:inline-block;">
								<button class="btn btn-default" type="submit">
									搜索
								</button>
							</div>
						</form>
					</div>
					<table class="table table-hover">
						<caption>所有条目</caption>
						<thead>
						<tr>
							<th>用户帐号</th>
							<th>创建时间</th>
							<th>最后登陆</th>
							<th>权限</th>
							<th style="width:200px;">操作</th>
						</tr>
						</thead>
						<tbody>
						@forelse ($list as $data)
							<tr>
								<td>{{$data['username']}}</td>
								<td>{{$data['create_time']}}</td>
								<td>{{$data['last_login']}}</td>
								<td>
									@if($data['root']==1)
										超级管理员
									@endif
								</td>
								<td>
									<button type="button" class="btn btn-danger btn-sm" name="table-btn-delete">
										<input type="hidden" value="{{$data['id']}}"/>
										删除用户
									</button>
								</td>
							</tr>
						@empty
							<td>暂时没有数据</td>
						@endforelse
						</tbody>

					</table>
				</div>
			</div>
			<!-- /.row -->
			<div>
				{!!$pager!!}
			</div>
		</div>
		<!-- /.container-fluid -->
	</div>
	<!-- /#page-wrapper -->
	<div class="modal fade" id="addModal" tabindex="-1" role="dialog"
	     aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close"
					        data-dismiss="modal" aria-hidden="true">
						&times;
					</button>
					<h4 class="modal-title" id="myModalLabel">
						增加超级管理员
					</h4>
				</div>
				<div class="modal-body">
					<p class="text-warning bg-warning">密码默认为帐号名，若要修改可以创建帐号后在个人中心修改</p>
					<label for="username">帐号</label>
					<input class="form-control" type="text" name="username"/>
					<label for="root">权限</label>
					<input class="form-control" type="text" disabled="disabled" value="超级管理员">
				</div>
				<div class="modal-footer">
					<button type="button" id="add-btn" class="btn btn-primary">
						增加
					</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal -->
	</div>


	<script type="application/javascript">
		var addModal = $("#addModal");
		//点击增加帐号按钮
		$("#add-modal-btn").on("click", function () {
			addModal.modal('show');
		});
		//增加帐号提交
		$("#add-btn").on("click", function () {
			var username = addModal.find("input[name=username]").val();
			var data = {
				username: username
			};
			//验证名称
			if (!username || username == null) {
				alert('帐号不能为空');
				return false;
			}
			if(username.length<4||username.length>20){
				alert('帐号长度在4-20位之间');
				return false;
			}
			http.post("{{base_url('/back/user/addAdminUser')}}", data)
					.success(function (data) {
						data = (parseJson(data))[0];
						if (data.code == 1) {
							alert('添加成功');
							window.location.reload();
						} else {
							alert(data.message);
						}
					});
		});

		//删除超级管理员
		$("button[name='table-btn-delete']").on("click", function () {
			var delete_name = $(this).parent().parent().find("td").eq(0).text();
			var delete_id = $(this).find("input").val();
			if (confirm("确认删除 " + delete_name + " 吗？")) {
				data = {
					id: delete_id
				};
				http.post("{{base_url('/back/user/deleteAdminUser')}}", data)
						.success(function (data, status) {
							data = (parseJson(data))[0];
							if (data.code == 1) {
								alert("删除成功");
								location.reload();
							} else {
								alert("删除失败");
							}
						});
			}
		});
	</script>
@endsection