@extends('back.layout.header')

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
						<small>管理等级</small>
					</h1>
					<ol class="breadcrumb">
						<li>
							管理系统
						</li>
						<li class="active">
							管理等级
						</li>
					</ol>
					<div class="">
						<button type="button" id="add-modal-btn" class="btn btn-primary btn-sm">增加等级</button>
					</div>
					<p class="text-warning bg-warning">最少订单数量：在司机晋升到等级所需的最少订单数</p>
					<table class="table table-hover">
						<caption>所有条目</caption>
						<thead>
						<tr>
							<th>等级名称</th>
							<th>最少订单数量</th>
							<th style="width:200px;">操作</th>
						</tr>
						</thead>
						<tbody>
						@forelse ($list as $data)
							<tr>
								<td>{{$data['name']}}</td>
								<td>{{$data['order_num']}}</td>
								<td>
									<button type="button" class="btn btn-success btn-sm" name="table-btn-change">
										<input type="hidden" value="{{$data['id']}}"/>
										编辑等级
									</button>
									<button type="button" class="btn btn-danger btn-sm" name="table-btn-delete">
										<input type="hidden" value="{{$data['id']}}"/>
										删除等级
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
						增加等级
					</h4>
				</div>
				<div class="modal-body">
					<label for="name">等级名称</label>
					<input class="form-control" type="text" name="name"/>
					<label for="order_num">最少订单数量</label>
					<input class="form-control" type="text" name="order_num">
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
						修改等级
					</h4>
				</div>
				<div class="modal-body">
					<label for="name">等级名称</label>
					<input class="form-control" type="text" name="name"/>
					<label for="order_num">最少订单数量</label>
					<input class="form-control" type="text" name="order_num">
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
		var addModal = $("#addModal");
		var changeModal = $("#changeModal");
		//点击增加等级
		$("#add-modal-btn").on("click", function () {
			addModal.modal('show');
		});
		//增加等级
		$("#add-btn").on("click", function () {
			var name = addModal.find("input[name=name]").val();
			var orderNum = addModal.find("input[name=order_num]").val();
			var data = {
				name: name,
				order_num: orderNum
			};
			//验证名称
			if (!name || !orderNum) {
				alert('请完整填写等级信息');
				return false;
			}
			http.post("{{base_url('/back/level/addLevel')}}", data)
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
		//点击编辑等级
		$("button[name=table-btn-change]").on("click", function () {
			var id = $(this).find("input").val();
			changeModal.find("input[name=id]").val(id);
			//获取等级数据
			http.post("{{base_url('/back/level/getLevel')}}", {id: id})
					.success(function (data) {
						data = (parseJson(data))[0];
						if (data.code == 1) {
							changeModal.find("input[name=name]").val(data.data.name);
							changeModal.find("input[name=order_num]").val(data.data.order_num);
							changeModal.modal('show');
						} else {
							alert(data.message);
						}
					});
		});
		//修改等级提交
		$("#change-btn").on("click", function () {
			var id = changeModal.find("input[name=id]").val();
			var name = changeModal.find("input[name=name]").val();
			var orderNum = changeModal.find("input[name=order_num]").val();
			var data = {
				id: id,
				name: name,
				order_num: orderNum
			};
			//验证名称
			if (!name || !orderNum) {
				alert('请完整填写等级信息');
				return false;
			}

			http.post("{{base_url('/back/level/changeLevel')}}", data)
					.success(function (data) {
						data = (parseJson(data))[0];
						if (data.code == 1) {
							window.location.reload();
						} else {
							alert(data.message);
						}
					});
		});

		//删除等级
		$("button[name='table-btn-delete']").on("click", function () {
			var delete_name = $(this).parent().parent().find("td").eq(0).text();
			var delete_id = $(this).find("input").val();
			if (confirm("确认删除 " + delete_name + " 吗？")) {
				data = {
					id: delete_id
				};
				http.post("{{base_url('/back/level/deleteLevel')}}", data)
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