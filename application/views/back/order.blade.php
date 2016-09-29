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
						<small>订单列表</small>
					</h1>
					<ol class="breadcrumb">
						<li>
							管理系统
						</li>
						<li class="active">
							查看订单列表
						</li>
					</ol>
					<div class="pull-right">
						<form class="form-horizontal" method="get" style="display:inline-block;">
							<div style="display:inline-block;">
								<select name="school_id" class="form-control">
									<option value="">全部</option>
									@foreach($school_list as $school)
										<option value="{{$school['id']}}" @if($input['school_id']==$school['id']) selected @endif>
											{{$school['school_name']}}
										</option>
										@endforeach
								</select>
							</div>
							<div style="display:inline-block;">
								<input placeholder="请输入要搜索的订单id" name="id" class="form-control"
								       value="{{empty($_GET['id'])?'':$_GET['id']}}"/>
							</div>
							<div style="display:inline-block;">
								<button class="btn btn-default" type="submit">
									搜索
								</button>
							</div>
						</form>
					</div>

					<table class="table table-hover table-bordered">
						<caption>订单详情</caption>
						<thead>
						<tr>
							<th>订单id</th>
							<th>学校校区</th>
							<th>出发地</th>
							<th>目的地</th>
							<th>价格</th>
							<th>司机</th>
							<th>乘客</th>
							<th>评分</th>
							<th style="width:150px;">评价</th>
							<th>订单状态</th>
							<th>下单时间</th>
							<th>预约时间</th>
							<th>开始时间</th>
							<th>结束时间</th>
							<th style="width:150px;">备注</th>

						</tr>
						</thead>
						<tbody>
						@forelse ($list as $data)
							<tr>
								<td>{{$data['id']}}</td>
								<td>
									{{$data['school_name']}} @if(!empty($data['area_name'])) {{$data['area_name']}} @else
										全校@endif
								</td>
								<td>{{$data['base']}}</td>
								<td>
									{{$data['destination']}}
								</td>
								<td>
									{{$data['price']/100}} 元
								</td>
								<td>
									{{$data['driver_name']}}
								</td>
								<td>
									{{$data['customer_name']}}
								</td>
								<td>
									{{empty($data['star'])?'未评价':$data['star']}}
								</td>
								<td>
									{{empty($data['star'])?'未评价':$data['comment']}}
								</td>
								<td>
									@if($data['status']==1)
										<span class="text-muted">待接单</span>
									@elseif($data['status']==2)
										<span class="text-info">进行中</span>
									@elseif($data['status']==3)
										<span class="text-success">已完成</span>
									@elseif($data['status']==4)
										<span class="text-danger">已取消</span>
									@endif
								</td>
								<td>{{$data['create_time']}}</td>
								<td>{{$data['appoint_time']}}</td>
								<td>{{$data['start_time']}}</td>
								<td>{{$data['end_time']}}</td>
								<td>{{$data['mark']}}</td>
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