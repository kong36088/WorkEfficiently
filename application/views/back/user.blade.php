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
						<small>管理用户</small>
					</h1>
					<ol class="breadcrumb">
						<li>
							管理系统
						</li>
						<li class="active">
							管理用户
						</li>
					</ol>
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
							<th>用户名称</th>
							<th>校区</th>
							<th>open_id</th>
							<th>禁用状态</th>
							<th>接单数</th>
							<th>叫单数</th>
							<th>司机评分</th>
							<th>注册时间</th>
							<th>最后登陆</th>
							<th style="width:200px;">操作</th>
						</tr>
						</thead>
						<tbody>
						@forelse ($list as $data)
							<tr>
								<td>{{$data['nickname']}}</td>
								<td>
									@if($data['school_id']!=0)
										{{$data['school_name']}} @if(!empty($data['area_name'])) {{$data['area_name']}} @else
											全校@endif
									@else
										无
									@endif
								</td>
								<td>
									{{$data['openid']}}
								</td>
								<td>
									@if($data['is_forbidden']==0)
										<span class="text-success">开启</span>
									@else
										<span class="text-danger">禁用</span>
									@endif
								</td>
								<td>{{$data['get_order_num']}}</td>
								<td>{{$data['post_order_num']}}</td>
								<td>{{$data['star']}}</td>
								<td>{{$data['create_time']}}</td>
								<td>{{$data['last_login']}}</td>
								<td>
									<a href="{{base_url('/back/client/detail')}}?user_id={{$data['id']}}">
										<button type="button" class="btn btn-info btn-sm">
											<input type="hidden" value="{{$data['id']}}"/>
											查看详细
										</button>
									</a>
									@if($data['is_forbidden']==0)
										<button type="button" class="btn btn-danger btn-sm" name="table-btn-forbid">
											<input type="hidden" value="{{$data['id']}}"/>
											禁用用户
										</button>
									@else
										<button type="button" class="btn btn-success btn-sm" name="table-btn-enable">
											<input type="hidden" value="{{$data['id']}}"/>
											开启用户
										</button>
									@endif
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

	<script type="application/javascript">
		//禁止用户
		$("button[name='table-btn-forbid']").on("click", function () {
			var delete_id = $(this).find("input").val();
			data = {
				id: delete_id,
				is_forbidden: 1
			};
			http.post("{{base_url('/back/client/forbidUser')}}", data)
					.success(function (data, status) {
						data = (parseJson(data))[0];
						if (data.code == 1) {
							location.reload();
						} else {
							alert("禁用失败");
						}
					});
		});
		//禁止用户
		$("button[name='table-btn-enable']").on("click", function () {
			var delete_id = $(this).find("input").val();
			data = {
				id: delete_id,
				is_forbidden: 0
			};
			http.post("{{base_url('/back/client/forbidUser')}}", data)
					.success(function (data, status) {
						data = (parseJson(data))[0];
						if (data.code == 1) {
							location.reload();
						} else {
							alert("开启失败");
						}
					});
		});
	</script>
@endsection