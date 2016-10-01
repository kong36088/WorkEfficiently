@extends('layout.header')

@section('content')
	<!--loading-->
	<div id="page-wrapper">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header">系统设置</h1>
				</div>
				<form class="form-horizontal" id="setting-form">

					<div style="padding-left:20px;">
						<span style="color:red;" id="tip"></span>
					</div>

					<div class="col-lg-5" style="padding-left:30px;">
					<!--
						<div class="form-group">
							<label for="per_page" class="control-label">每页显示数量</label>
							<div class="">
								<input class="form-control" id="per_page" name="per_page" placeholder="" type="text"
								       value="{{empty($per_page)?'':$per_page}}">
							</div>
						</div>
						-->
						<div class="form-group">
							<label for="site_name" class="control-label">我的站点名称</label>
							<div class="">
								<input class="form-control" id="site_name" name="site_name" placeholder="" type="text"
								       value="{{empty($site_name)?'':$site_name}}">
							</div>
						</div>

						<button type="button" class="col-sm-1 btn btn-primary btn-block" id="submit">提交</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<script type="application/javascript">
		$("#submit").on("click", function () {
			var data = $("#setting-form").serialize();
			http.post("{{base_url('/user/postSetting')}}", data)
					.success(function (data, status) {
						data = parseJson(data)[0];
						if (data.code == 1) {
							location.reload();
						} else {
							$("#tip").text(data.message.errors);
						}
					});
		})
	</script>
@endsection
