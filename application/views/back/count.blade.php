@extends('layout.header.blade.php.bak')

@section('content')
	<script src="{{base_url('/static')}}/js/chart/Chart.min.js"></script>

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
						<small>系统概况</small>
					</h1>
					<ol class="breadcrumb">
						<li>
							管理系统
						</li>
					</ol>
				</div>
			</div>

			<div id="order-num">
				<div class="panel panel-primary" style="width: 30%;display: inline-block;margin-right:3%;">
					<div class="panel-heading">
						近7天订单数量统计
					</div>
					<div class="panel-body">
						<div class="col-sm-6">
							<select name="school_id" onchange="setOrderNum('week',this)" class="form-control">
								<option value="">全部</option>
								@foreach($school_list as $school)
									<option value="{{$school['id']}}">{{$school['school_name']}}</option>
								@endforeach
							</select>
						</div>
						<div class="">
							<canvas id="orderNumWeekCanvas" width="100" height="100"></canvas>
						</div>
					</div>
				</div>

				<div class="panel panel-primary" style="width: 30%;display:inline-block;margin-right:3%;">
					<div class="panel-heading">
						一年内订单数量统计
					</div>
					<div class="panel-body">
						<div class="col-sm-6">
							<select name="school_id" onchange="setOrderNum('year',this)" class="form-control">
								<option value="">全部</option>
								@foreach($school_list as $school)
									<option value="{{$school['id']}}">{{$school['school_name']}}</option>
								@endforeach
							</select>
						</div>
						<div class="">
							<canvas id="orderNumYearCanvas" width="100" height="100"></canvas>
						</div>
					</div>
				</div>

				<div class="panel panel-green" style="width: 30%;display: inline-block;">
					<div class="panel-heading">
						总订单数
					</div>
					<div class="panel-body">
						<div class="col-sm-6">
							<select name="school_id" onchange="setOrderNum('total',this)" class="form-control">
								<option value="">全部</option>
								@foreach($school_list as $school)
									<option value="{{$school['id']}}">{{$school['school_name']}}</option>
								@endforeach
							</select>
						</div>
						<div class="">
							<canvas id="orderNumTotalCanvas" width="100" height="100"></canvas>
						</div>
					</div>
				</div>
			</div>

			<hr>

			<hr>
			<div id="user-num">
				<div class="panel panel-yellow" style="width: 40%;display: inline-block;margin-right:5%;">
					<div class="panel-heading">
						总司机数
					</div>
					<div class="panel-body">
						<div class="col-sm-6">
							<select name="school_id" onchange="setUserNum('driver',this)" class="form-control">
								<option value="">全部</option>
								@foreach($school_list as $school)
									<option value="{{$school['id']}}">{{$school['school_name']}}</option>
								@endforeach
							</select>
						</div>
						<div class="">
							<canvas id="userNumDriverCanvas" width="100" height="100"></canvas>
						</div>
					</div>
				</div>

				<div class="panel panel-yellow" style="width: 40%;display: inline-block;margin-right:5%;">
					<div class="panel-heading">
						总用户数
					</div>
					<div class="panel-body">
						<div class="col-sm-6">
							<select name="school_id" onchange="setUserNum('customer',this)" class="form-control">
								<option value="">全部</option>
								@foreach($school_list as $school)
									<option value="{{$school['id']}}">{{$school['school_name']}}</option>
								@endforeach
							</select>
						</div>
						<div class="">
							<canvas id="userNumCustomerCanvas" width="100" height="100"></canvas>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>

	<script type="application/javascript">
		var orderNumWeek = $("#orderNumWeekCanvas");
		var orderNumYear = $("#orderNumYearCanvas");
		var orderNumTotal = $("#orderNumTotalCanvas");
		var userNumDriver = $("#userNumDriverCanvas");
		var userNumCustomer = $("#userNumCustomerCanvas");
		var yearCanvas = null;
		var weekCanvas = null;
		var totalCanvas = null;
		var driverCanvas = null;
		var customerCanvas = null;
		init();

		function init() {
			setOrderNum('week');
			setOrderNum('year');
			setOrderNum('total');
			setUserNum('driver');
			setUserNum('customer');
		}

		//获取订单数据初始化表格
		function setOrderNum(frequency, ele) {
			var school_id;
			if (ele) {
				school_id = ele.value;
			}
			var labels = new Array();
			var nums = new Array();
			//初始化订单数数据
			http.post("{{base_url('/back/count/getOrderNum')}}", {frequency: frequency, school_id: school_id})
					.success(function (result) {
						result = parseJson(result)[0];
						if (result.code == 1) {
							for (key in result.data) {
								labels.push(key);
								nums.push(result.data[key]);
							}
						}
						setOrderChart(frequency, labels, nums);
					});
		}
		//设置每日和每月订单数柱状图
		function setOrderChart(frequency, labels, nums) {
			var tempCanvas; //订单画布canvas
			var tempOrderNum; //订单div
			var max = Math.max.apply(null, nums);
			var step = 1;
			var d = {
				labels: labels,
				datasets: [
					{
						label: '订单数量',
						data: nums,
						backgroundColor: 'rgba(82, 198, 233,0.6)'
					}
				]
			};
			var options = {
				scales: {
					yAxes: [{
						ticks: {
							max: max,
							min: 0,
							stepSize: 1
						}
					}]
				}
			};
			if (frequency == "week") {
				tempOrderNum = orderNumWeek;
				tempCanvas = weekCanvas;
			} else if (frequency == "year") {
				tempOrderNum = orderNumYear;
				tempCanvas = yearCanvas;
			} else if (frequency == 'total') {
				tempOrderNum = orderNumTotal;
				tempCanvas = totalCanvas;
			}
			if (tempCanvas) {
				tempCanvas.data.datasets[0].data = nums;
				tempCanvas.data.labels = labels;
				tempCanvas.update();
			} else {
				//新建canvas
				if (frequency == "week") {
					weekCanvas = new Chart(tempOrderNum, {
						type: 'bar',
						data: d,
						options: options
					});
				} else if (frequency == "year") {
					d.datasets[0].backgroundColor = 'rgba(243, 246, 74,0.6)';
					yearCanvas = new Chart(tempOrderNum, {
						type: 'bar',
						data: d,
						options: options
					});
				} else if (frequency == "total") {
					d.datasets[0].backgroundColor = 'rgba(130,212,47,0.6)';
					totalCanvas = new Chart(tempOrderNum, {
						type: 'bar',
						data: d,
						options: options
					})
				}
			}
		}

		//获取用户数初始化表格
		function setUserNum(userType, ele) {
			var school_id;
			if (ele) {
				school_id = ele.value;
			}
			var labels = new Array();
			var nums = new Array();
			//初始化订单数数据
			http.post("{{base_url('/back/count/getUserNum')}}", {user_type: userType, school_id: school_id})
					.success(function (result) {
						result = parseJson(result)[0];
						if (result.code == 1) {
							for (key in result.data) {
								labels.push(key);
								nums.push(result.data[key]);
							}
						}
						setUserChart(userType, labels, nums);
					});
		}
		//设置每日和每月订单数柱状图
		function setUserChart(userType, labels, nums) {
			var tempCanvas; //订单画布canvas
			var tempOrderNum; //订单div
			var max = Math.max.apply(null, nums);
			var step = 1;
			var d = {
				labels: labels,
				datasets: [
					{
						label: '用户数量',
						data: nums,
						backgroundColor: 'rgba(82, 198, 233,0.6)'
					}
				]
			};
			var options = {
				scales: {
					yAxes: [{
						ticks: {
							max: max,
							min: 0,
							stepSize: step
						}
					}]
				}
			};
			if (userType == "driver") {
				tempOrderNum = userNumDriver;
				tempCanvas = driverCanvas;
			} else if (userType == "customer") {
				tempOrderNum = userNumCustomer;
				tempCanvas = customerCanvas;
			}
			if (tempCanvas) {
				tempCanvas.data.datasets[0].data = nums;
				tempCanvas.data.labels = labels;
				tempCanvas.update();
			} else {
				//新建canvas
				if (userType == "driver") {
					d.datasets[0].backgroundColor = 'rgba(244, 44, 40,0.6)';
					driverCanvas = new Chart(tempOrderNum, {
						type: 'bar',
						data: d,
						options: options
					});
				} else if (userType == "customer") {
					d.datasets[0].backgroundColor = 'rgba(40, 241, 244,0.6)';
					customerCanvas = new Chart(tempOrderNum, {
						type: 'bar',
						data: d,
						options: options
					})
				}
			}
		}

	</script>
@endsection