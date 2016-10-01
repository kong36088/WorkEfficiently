@extends('layout.header')

@section('content')
	<?php
	$panelColor = array('primary', 'green', 'yellow', 'red');
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
				<div class="panel panel-{{$panelColor[$category['id']%4]}}">
					<div class="panel-heading">
						<span class="heading-title" style="width:auto;">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapse{{$category['id']}}"
							   class="category-name"
							   style="text-decoration: none;color:white;">{{$category['category_name']}}</a>
						</span>
						<div class="pull-right">
							<a href="javascript:void(0);" name="add-task" data-id="{{$category['id']}}"
							   style="color:white;font-size:17px;margin-right:20px;">
								<i class="fa fa-plus" aria-hidden="true"></i></a>
							<a href="javascript:void(0);" name="change-category-name" data-id="{{$category['id']}}"
							   style="color:white;font-size:17px;margin-right:20px;">
								<i class="fa fa-gear" aria-hidden="true"></i></a>
							<a href="javascript:void(0);" name="delete-category" data-id="{{$category['id']}}"
							   style="color:white;font-size:17px;">
								<i class="fa fa-times" aria-hidden="true"></i></a>
						</div>
					</div>
					<div id="collapse{{$category['id']}}" class="panel-collapse collapse in">
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
														<p name="task-title"
														   style="text-decoration: none;">
															{{$task['title']}}
														</p>
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
											@endforelse
											</tbody>
										</table>
										<div >
											<button class="btn btn-default btn-block" data-categoryid="{{$category['id']}}" name="get-finish-task-btn">
												获取已完成任务
											</button>
										</div>
									</div>
								</div>

							</div>
						</div>
					</div>
				</div>
			@empty
				暂时没有任务哦
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


			<div class="modal fade" id="changeCategoryNameModal" tabindex="-1" role="dialog"
			     aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close"
							        data-dismiss="modal" aria-hidden="true">
								&times;
							</button>
							<h4 class="modal-title" id="myModalLabel">
								修改分类名称
							</h4>
						</div>
						<div class="modal-body">
							<label for="title">分类名称</label>
							<input class="form-control" type="text" name="category_name"/>
							<input type="hidden" name="category_id">
						</div>
						<div class="modal-footer">
							<button type="button" name="submit" class="btn btn-primary">
								修改
							</button>
						</div>
					</div><!-- /.modal-content -->
				</div><!-- /.modal -->
			</div>

			<div class="modal fade" id="taskFinishModal" tabindex="-1" role="dialog" data-taskid=""
			     aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close"
							        data-dismiss="modal" aria-hidden="true">
								&times;
							</button>
							<h4 class="modal-title" id="myModalLabel">
								已完成的任务
							</h4>
						</div>
						<div class="modal-body">
							<table class="table table-striped table-bordered table-hover">
								<tbody id="task-finished-body">

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
				<button href="javascript:void(0);" name="table-btn-finish" data-taskid="${id}" class="btn btn-circle btn-success">
					<i class="fa fa-check"></i></button>
			</td>
			<td>
				<a href="javascript:void(0)" name="task-title" class="task-title" style="text-decoration: none;">
					${title}
				</a>
			</td>
			<td width="10px;">
				<button href="javascript:void(0);" name="table-btn-expand" data-taskid="${id}" class="btn btn-circle btn-info"><i
							class="fa fa-arrows-alt"></i></button>
			</td>
			<td width="10px;">
				<button href="javascript:void(0);" name="table-btn-delete" data-taskid="${id}" class="btn btn-circle btn-danger"
				   ><i class="fa fa-times"></i></button>
			</td>
		</tr>
	</script>
	<script type="text/juicer" id="finishTaskTr">
		<tr>
			<td style="width:10px;">
				<button href="javascript:void(0);" name="table-btn-undo" data-taskid="${id}" class="btn btn-circle btn-warning">
					<i class="fa fa-undo"></i></button>
			</td>
			<td>
				<p href="javascript:void(0)" name="task-title">
					<span style="text-decoration:line-through">${title}</span>
				</p>
			</td>
			<td width="10px;">
				<button href="javascript:void(0);" name="table-btn-expand" data-taskid="${id}" class="btn btn-circle btn-info"><i
							class="fa fa-arrows-alt"></i></button>
			</td>
			<td width="10px;">
				<button href="javascript:void(0);" name="table-btn-delete" data-taskid="${id}" class="btn btn-circle btn-danger"
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
			<td style="width: 10px;">
				<button href="javascript:void(0);" name="table-btn-input-option-delete" class="btn btn-circle btn-danger"
				 data-id="1"><i class="fa fa-times"></i></button>
			</td>
		</tr>
	</script>
	<script type="text/juicer" id="taskOptionTr">
		<tr>
			{$if status != '1'}
				<td style="width:10px;">
					<button href="javascript:void(0);" name="table-btn-option-undo" data-taskoptionid="${id}" class="btn btn-circle btn-warning">
						<i class="fa fa-undo"></i></button>
				</td>
			{$else}
				<td style="width:10px;">
					<button href="javascript:void(0);" name="table-btn-option-finish" data-taskoptionid="${id}" class="btn btn-circle btn-success">
					<i class="fa fa-check"></i></button>
				</td>
			{$/if}
			<td>
				<p name='option-title'>
					{$if status == '1'}
						<span>${title}</span>
					{$else}
						<span style="text-decoration:line-through">${title}</s>
					{$/if}
				</p>
			</td>
			<td width="10px;">
				<button href="javascript:void(0);" name="table-btn-option-delete" data-taskoptionid="${id}" class="btn btn-circle btn-danger"
				   ><i class="fa fa-times"></i></button>
			</td>
		</tr>
	</script>
	<script type="application/javascript">
		var addCategoryModal = $("#addCategoryModal");
		var addTaskModel = $("#addTaskModal");
		var taskOptionModel = $("#taskOptionModal");
		var changeCategoryNameModal = $("#changeCategoryNameModal");
		var taskFinishModal = $("#taskFinishModal");
	</script>
	<script src="{{base_url('/static')}}/js/task.js"></script>
	<script src="{{base_url('/static')}}/js/task_option.js"></script>
	<script type="application/javascript">
		init();
		function init() {
			taskInit();
			taskOptionInit();
		}
		var addCategoryUrl = "{{base_url('/todo/addCategory')}}";
		var addTaskUrl = "{{base_url('/todo/addTask')}}";
		var addTaskOptionsUrl = "{{base_url('/todo/addTaskOptions')}}";
		var getTaskOptionsUrl = "{{base_url('/todo/getTaskOptions')}}";
		var changeTaskStatusUrl = "{{base_url('/todo/changeTaskStatus')}}";
		var changeTaskOptionsStatusUrl = "{{base_url('/todo/changeTaskOptionStatus')}}";
		var deleteTaskUrl = "{{base_url('/todo/deleteTask')}}";
		var deleteTaskOptionUrl = "{{base_url('/todo/deleteTaskOption')}}";
		var changeCategoryNameUrl = "{{base_url('/todo/changeCategoryName')}}";
		var deleteCategoryUrl = "{{base_url('/todo/deleteCategory')}}";
		var getFinishTaskUrl = "{{base_url('/todo/getFinishTask')}}"
	</script>
@endsection
