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
						用户详情
						<small>查看用户详细信息</small>
					</h1>

					<p>
						<button type="button" class="btn btn-default btn-block" onclick="history.back()">
							返回
						</button>
					</p>

					<h1>用户详细信息</h1>

					<table class="table table-hover table-bordered" id="repairs-table">
						<caption>用户</caption>
						<thead>
						<tr>
							<th style="width:15%;">名称</th>
							<th>详情</th>
						</tr>
						</thead>
						<tbody>
						<tr>
							<td>头像</td>
							<td>
								@if(!empty($info['head']))
									<img src="{{$info['head']}}" height="200px" width="auto"/>
								@else
									没有找到头像
								@endif
							</td>
						</tr>
						<tr>
							<td>用户名称</td>
							<td>{{$info['nickname']}}</td>
						</tr>
						<tr>
							<td>校区</td>
							<td>{{empty($info['school_name'])?'无学校':$info['school_name']}} @if(!empty($info['area_name'])) {{$info['area_name']}} @else
									全校@endif</td>
						</tr>
						<tr>
							<td>open_id</td>
							<td>{{$info['openid']}}</td>
						</tr>
						<tr>
							<td>禁用状态</td>
							<td>@if($info['is_forbidden']==0)
									<span class="text-success">开启</span>
								@else
									<span class="text-danger">禁用</span>
								@endif</td>
						</tr>
						<tr>
							<td>接单数</td>
							<td>{{$info['get_order_num']}}</td>
						</tr>
						<tr>
							<td>叫单数</td>
							<td>{{$info['post_order_num']}}</td>
						</tr>
						<tr>
							<td>司机评分</td>
							<td>{{$info['star']}}</td>
						</tr>
						<tr>
							<td>注册时间</td>
							<td>{{$info['create_time']}}</td>
						</tr>
						<tr>
							<td>最后登陆</td>
							<td>{{$info['last_login']}}</td>
						</tr>

						<tr>
							<td>二维码</td>
							<td>
								@if(!empty($info['qrcode']))
									<img src="{{$info['qrcode']}}" height="200px" width="auto"/>
								@else
									没有图片
								@endif
							</td>
						</tr>
						</tbody>
					</table>

					<hr>
					<h1>作为司机</h1>
					<table class="table table-hover table-bordered">
						<caption>司机订单</caption>
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
						@forelse ($driver_order as $data)
							<tr>
								<td>{{$data['id']}}</td>
								<td>
									@if($data['school_id']!=0)
										{{$data['school_name']}} @if(!empty($data['area_name'])) {{$data['area_name']}} @else
											全校@endif
									@else
										无
									@endif
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

			<hr>
			<h1>作为乘客</h1>
			<table class="table table-hover table-bordered">
				<caption>乘客订单</caption>
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
				@forelse ($customer_order as $data)
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

@endsection