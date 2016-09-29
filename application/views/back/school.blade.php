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
						<small>管理学校</small>
					</h1>
					<ol class="breadcrumb">
						<li>
							管理系统
						</li>
						<li class="active">
							管理学校
						</li>
					</ol>
					<div class="pull-left">
						<button type="button" id="add-modal-btn" class="btn btn-primary btn-sm">增加学校</button>
					</div>
					<div class="pull-right">
						<form class="form-horizontal" method="get" style="display:inline-block;">
							<div style="display:inline-block;">
								<input placeholder="请输入学校名称" name="school" class="form-control"
								       value="{{empty($_GET['school'])?'':$_GET['school']}}"/>
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
							<th>学校名称</th>
							<th>校区</th>
							<th style="width:300px;">操作</th>
						</tr>
						</thead>
						<tbody>
						@forelse ($list as $data)
							<tr>
								<td>{{$data['school_name']}}</td>
								<td><?php
									if (!empty($data['area'])) {
										$str = '';
										foreach ($data['area'] as $v) {
											$str .= $v['area_name'] . ' ';
										}
										echo $str;
									} else {
										echo '全校';
									}
									?></td>
								<td>
									<button type="button" class="btn btn-success btn-sm" name="table-btn-change">
										<input type="hidden" value="{{$data['id']}}"/>
										修改学校名
									</button>
									<a href="{{base_url('/back/school/area')}}?school_id={{$data['id']}}">
										<button type="button" class="btn btn-info btn-sm">
											<input type="hidden" value="{{$data['id']}}"/>
											编辑校区
										</button>
									</a>
									<button type="button" class="btn btn-danger btn-sm" name="table-btn-delete">
										<input type="hidden" value="{{$data['id']}}"/>
										删除学校
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
						增加学校
					</h4>
				</div>
				<div class="modal-body">
					<label for="school_name">名称</label>
					<input class="form-control" type="text" name="school_name"/>
				</div>
				<div class="modal-footer">
					<button type="button" id="add-btn" class="btn btn-primary">
						增加
					</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal -->
	</div>

	<div class="modal fade" id="changeModal" tabindex="-1" role="dialog"
	     aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close"
					        data-dismiss="modal" aria-hidden="true">
						&times;
					</button>
					<h4 class="modal-title" id="myModalLabel">
						修改学校名称
					</h4>
				</div>
				<div class="modal-body">
					<label for="school_name">名称</label>
					<input class="form-control" type="text" name="school_name"/>
					<input type="hidden" name="id"/>
				</div>
				<div class="modal-footer">
					<button type="button" id="change-btn" class="btn btn-primary">
						修改
					</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal -->
	</div>

	<script type="application/javascript">
		var changeModal = $("#changeModal");
		var addModal = $("#addModal");
		//增加学校按钮
		$("#add-modal-btn").on("click", function () {
			var id = $(this).find("input").val();
			addModal.find("input[name=school_name]").val('');
			addModal.modal('show');
		});
		//增加学校名称提交
		$("#add-btn").on("click", function () {
			var school_name = addModal.find("input[name=school_name]").val();
			var data = {
				school_name: school_name
			};
			//验证名称
			if (!school_name || school_name == null) {
				alert('名字不能为空');
				return false;
			}

			http.post("{{base_url('/back/school/addSchool')}}", data)
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

		//修改按钮
		$("button[name=table-btn-change]").on("click", function () {
			var id = $(this).find("input").val();
			changeModal.find("input[name=id]").val(id);
			changeModal.find("input[name=school_name]").val('');
			changeModal.modal('show');
		});
		//修改学校名称提交
		$("#change-btn").on("click", function () {
			var id = changeModal.find("input[name=id]").val();
			var school_name = changeModal.find("input[name=school_name]").val();
			var data = {
				id: id,
				school_name: school_name
			};
			//验证名称
			if (!school_name || school_name == null) {
				alert('名字不能为空');
				return false;
			}

			http.post("{{base_url('/back/school/changeSchoolName')}}", data)
					.success(function (data) {
						data = (parseJson(data))[0];
						if (data.code == 1) {
							window.location.reload();
						} else {
							alert(data.message);
						}
					});
		});
		//删除学校
		$("button[name='table-btn-delete']").on("click", function () {
			var delete_name = $(this).parent().parent().find("td").eq(0).text();
			var delete_id = $(this).find("input").val();
			if (confirm("确认删除 " + delete_name + " 吗？（请谨慎操作，已绑定学校的用户可能导致数据错乱）")) {
				if (confirm('请再次确认')) {
					data = {
						id: delete_id
					};
					http.post("{{base_url('/back/school/deleteSchool')}}", data)
							.success(function (data, status) {
								data = (parseJson(data))[0];
								if (data.code == 1) {
									location.reload();
								} else {
									alert("删除失败");
								}
							});
				}
			}
		});
	</script>
@endsection