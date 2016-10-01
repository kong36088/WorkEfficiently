@extends('layout.header')

@section('content')
	<?php
	$panelColor = array('primary', 'green', 'blue', 'yellow', 'red');
	?>

	<!--loading-->
	<div class="loading">loading...</div>
	<!--loading-->
	<div id="page-wrapper">
		<div class="container-fluid" id="main-container">
			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header">任务清单
						<button type="button" id="add-category-btn" class="btn btn-warning btn-circle btn-lg"><i
									class="fa fa-plus"></i></button>
					</h1>
				</div>
			</div>


			@forelse($list as $category)
				<div class="panel panel-{{$panelColor[$category['id']%5]}}">
					<div class="panel-heading">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"
						   style="text-decoration: none;color:white;">工作</a>
						<span class="heading-title"></span>
						<div class="pull-right">
							<a href="javascript:void(0);" name="add-task" data-id="1">
								<i class="fa fa-plus" aria-hidden="true"></i></a>
						</div>
					</div>
					<div id="collapseOne" class="panel-collapse collapse in">
						<div class="panel-body">
							<div>
								<div class="well-sm" style="display:inline-block;width:100%;">
									<div class="">
										<table class="table table-striped table-bordered table-hover"
										       data-category-id="{{$category['id']}}">
											<tbody class="task-list">
											@forelse($category['task_list'] as $task)
												<tr>
													<td style="width:10px;">
														<button href="javascript:void(0);" name="table-btn-finish"
														        data-taskid="{{$task['id']}}"
														        class="btn btn-circle btn-success"
														><i class="fa fa-check"></i></button>
													</td>
													<td>
														<a href="javascript:void(0)" name="content-a"
														   style="text-decoration: none;">
															{{$task['title']}}
														</a>
													</td>
													<td width="10px;">
														<button href="javascript:void(0);" name="table-btn-expand"
														        data-taskid="{{$task['id']}}"
														        class="btn btn-circle btn-info"><i
																	class="fa fa-arrows-alt"></i></button>
													</td>
													<td width="10px;">
														<button href="javascript:void(0);" name="table-btn-delete"
														        data-taskid="{{$task['id']}}"
														        class="btn btn-circle btn-danger"
														><i class="fa fa-times"></i></button>
													</td>
												</tr>
											@empty
												这里还没有任务哦
											@endforelse
											</tbody>
										</table>
									</div>
								</div>

							</div>
						</div>
					</div>
				</div>
			@empty
				暂时没有数据
			@endforelse

			<div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog"
			     aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close"
							        data-dismiss="modal" aria-hidden="true">
								&times;
							</button>
							<h4 class="modal-title" id="myModalLabel">
								增加分类
							</h4>
						</div>
						<div class="modal-body">
							<label for="name">分类名称</label>
							<input class="form-control" type="text" name="category_name"/>
						</div>
						<div class="modal-footer">
							<button type="button" name="submit" class="btn btn-primary">
								增加
							</button>
						</div>
					</div><!-- /.modal-content -->
				</div><!-- /.modal -->
			</div>

			<div class="modal fade" id="addTaskModal" tabindex="-1" role="dialog"
			     aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close"
							        data-dismiss="modal" aria-hidden="true">
								&times;
							</button>
							<h4 class="modal-title" id="myModalLabel">
								添加检查项
							</h4>
						</div>
						<div class="modal-body">
							<label for="title">任务内容</label>
							<input class="form-control" type="text" name="title"/>
							<input type="hidden" name="category_id">
						</div>
						<div class="modal-footer">
							<button type="button" name="submit" class="btn btn-primary">
								增加
							</button>
						</div>
					</div><!-- /.modal-content -->
				</div><!-- /.modal -->
			</div>

			<div class="modal fade" id="taskOptionModal" tabindex="-1" role="dialog" data-taskid=""
			     aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close"
							        data-dismiss="modal" aria-hidden="true">
								&times;
							</button>
							<h4 class="modal-title" id="myModalLabel">
								今天的任务
							</h4>
						</div>
						<div class="modal-body">
							<table class="table table-striped table-bordered table-hover">
								<tbody id="task-option-body">
								<tr>
									<td style="width:10px;">
										<button href="javascript:void(0);" name="table-btn-finish" data-id=""
										        class="btn btn-circle btn-success">
											<i class="fa fa-check"></i></button>
									</td>
									<td>
										<a href="javascript:void(0)" name="content-a" style="text-decoration: none;">
											今天要干什么事情今天要干什么事情今天要干什么事情
										</a>
									</td>
									<td style="width: 10px;">
										<button href="javascript:void(0);" name="table-btn-option-delete"
										        class="btn btn-circle btn-danger"
										        data-id=""><i class="fa fa-times"></i></button>
									</td>
								</tr>

								</tbody>
							</table>
							<button type="button" name="add-task-option-btn" class="btn btn-info"><i
										class="fa fa-plus"></i>
							</button>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
						</div>
					</div><!-- /.modal-content -->
				</div><!-- /.modal -->
			</div>


		</div>
	</div>

	<script type="text/juicer" id="taskInput">
		<tr>
			<td style="width:10px;">
				<button href="javascript:void(0);" name="table-btn-input-finish" class="btn btn-circle btn-success"
				 ><i class="fa fa-check"></i></button>
			</td>
			<td>
				<input type="text" class="form-control" name="title"/>
			</td>
			<td></td>
			<td style="width: 10px;">
				<button href="javascript:void(0);" name="table-btn-input-delete" class="btn btn-circle btn-danger"
				 ><i class="fa fa-times"></i></button>
			</td>

		</tr>


	</script>
	<script type="text/juicer" id="taskTr">
		<tr>
			<td style="width:10px;">
				<button href="javascript:void(0);" name="table-btn-input-finish" data-id="${id}" class="btn btn-circle btn-success">
					<i class="fa fa-check"></i></button>
			</td>
			<td>
				<a href="javascript:void(0)" name="content-a" style="text-decoration: none;">
					${title}
				</a>
			</td>
			<td width="10px;">
				<button href="javascript:void(0);" name="table-btn-expand" data-id="${id}" class="btn btn-circle btn-info"><i
							class="fa fa-arrows-alt"></i></button>
			</td>
			<td width="10px;">
				<button href="javascript:void(0);" name="table-btn-delete" data-id="${id}" class="btn btn-circle btn-danger"
				   ><i class="fa fa-times"></i></button>
			</td>
		</tr>


	</script>
	<script type="text/juicer" id="taskOptionInput">
		<tr>
			<td style="width:10px;">
				<button href="javascript:void(0);" name="table-btn-input-option-finish" class="btn btn-circle btn-success"
				><i class="fa fa-check"></i></a>
			</td>
			<td>
				<input type="text" class="form-control" name="title"/>
			</td>
			<td></td>
			<td style="width: 10px;">
				<button href="javascript:void(0);" name="table-btn-input-option-delete" class="btn btn-circle btn-danger"
				 data-id="1"><i class="fa fa-times"></i></button>
			</td>
		</tr>


	</script>
	<script type="text/juicer" id="taskOptionTr">
		<tr>
			<td style="width:10px;">
				<a href="javascript:void(0);" name="table-btn-finish" style="color:green;" data-id="${id}"><i class="fa fa-check"></i></a>
			</td>
			<td>
				<a href="javascript:void(0)" name="content-a" style="text-decoration: none;">
					${title}
				</a>
			</td>
			<td style="width: 10px;">
				<a href="javascript:void(0);" name="table-btn-option-delete" style="color:red;"
				   data-id="${id}"><i class="fa fa-times"></i></a>
			</td>
		</tr>
	</script>
	<script type="application/javascript">
		var addCategoryModal = $("#addCategoryModal");
		var addTaskModel = $("#addTaskModal");
		var taskOptionModel = $("#taskOptionModal");
	</script>
	<script src="{{base_url('/static')}}/js/task.js"></script>
	<script src="{{base_url('/static')}}/js/task_option.js"></script>
	<script type="application/javascript">
		init();
		function init() {
			taskInit();
			taskOptionInit();
		}
		var addTaskUrl = "{{base_url('/todo/addTask')}}";
		var addTaskOptionsUrl = "{{base_url('/todo/addTaskOptions')}}";
		var getTaskOptionsUrl = "{{base_url('/todo/getTaskOptions')}}";
	</script>
@endsection
