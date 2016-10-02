@extends('layout.header')

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
					<h1 class="page-header">统计</h1>
				</div>
			</div>

			<div id="category-count" class="col-lg-4" style="width: 100%;max-width: 700px;">
				<div class="panel panel-primary">
					<div class="panel-heading">
						分类概况
					</div>
					<div class="panel-body">
						<div class="">
							<canvas id="categoryCountCanvas" width="100" height="100"></canvas>
						</div>
					</div>
				</div>
			</div>
			<div id="task-count" class="col-lg-4"  style="width: 100%;max-width: 700px;">
				<div class="panel panel-yellow">
					<div class="panel-heading">
						任务概况
					</div>
					<div class="panel-body">
						<div class="">
							<canvas id="taskCountCanvas" width="100" height="100"></canvas>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script type="application/javascript">
		var categoryCount = $("#categoryCountCanvas");
		var taskCount = $("#taskCountCanvas");
		var categoryCountCanvas = null;
		var taskCountCanvas = null;
		init();

		function init() {
			setCategoryCount();
			setTaskCount();
		}

		//获取每个分类概况
		function setCategoryCount() {
			var labels = new Array();
			var nums = new Array();
			var background = new Array();
			//初始化订单数数据
			http.post("{{base_url('/count/getCategoryCount')}}")
					.success(function (result) {
						result = parseJson(result)[0];
						if (result.code == 1) {
							for (key in result.data) {
								labels.push(result.data[key].category_name);
								nums.push(result.data[key].num);
								background.push('rgba(82, 198, ' + Math.ceil(Math.random() * 250) + ' ,0.6)')
							}
						}
						setCategoryCountChart(labels, nums, background);
					});
		}
		//设置分类概况柱形图
		function setCategoryCountChart(labels, nums, background) {
			var max = Math.max.apply(null, nums);
			var step = 1;
			var d = {
				labels: labels,
				datasets: [
					{
						label: '任务数量情况',
						data: nums,
						backgroundColor: background
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
			if (categoryCountCanvas) {
				categoryCountCanvas.data.datasets[0].data = nums;
				categoryCountCanvas.data.labels = labels;
				categoryCountCanvas.update();
			} else {
				//新建canvas
				categoryCountCanvas = new Chart(categoryCount, {
					type: 'bar',
					data: d,
					options: options
				});
			}
		}

		//获取任务情况
		function setTaskCount() {
			var labels = new Array();
			var nums = new Array();
			var background = new Array();
			//初始化订单数数据
			http.post("{{base_url('/count/getTaskCount')}}")
					.success(function (result) {
						result = parseJson(result)[0];
						if (result.code == 1) {
							for (key in result.data) {
								labels.push(key);
								nums.push(result.data[key]);
								background.push('rgba(82, 28, ' + Math.ceil(Math.random() * 250) + ' ,0.7)')
							}
						}
						setTaskCountChart(labels, nums, background);
					});
		}
		//设置任务情况
		function setTaskCountChart(labels, nums, background) {
			var max = Math.max.apply(null, nums);
			var step = 1;
			var d = {
				labels: labels,
				datasets: [
					{
						label: '任务数量情况',
						data: nums,
						backgroundColor: background
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
			if (taskCountCanvas) {
				taskCountCanvas.data.datasets[0].data = nums;
				taskCountCanvas.data.labels = labels;
				taskCountCanvas.update();
			} else {
				//新建canvas
				taskCountCanvas = new Chart(taskCount, {
					type: 'pie',
					data: d,
					options: options
				});
			}
		}


	</script>
@endsection