<?php

/**
 * Created by PhpStorm.
 * Author: William
 * Date: 2016/9/29
 * Time: 17:12
 */
class Todo extends WE_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('json_out');
	}

	public function index()
	{
		$this->load->model('category_model');
		$this->load->model('task_model');

		$userId = $this->user['id'];

		$data['list'] = $this->category_model->getCategoryList($userId);
		$data['list'] = $this->task_model->getTaskList($data['list']);
		//print_r($data);exit;

		view('/todo', $data);
	}

	public function getTaskOptions()
	{
		$this->load->model('task_options_model');
		//验证输入
		if ($this->form_validation->run() === FALSE) {
			$this->json_out->fail(strip_tags(validation_errors()));
			return;
		}
		$userId = $this->user['id'];
		$taskId = $this->input->post('task_id');

		$taskOptions = $this->task_options_model->getTaskOptionsList($userId, $taskId);

		$this->json_out->data($taskOptions);
	}

	/**
	 * 获取已完成任务
	 */
	public function getFinishTask()
	{
		$this->load->model('task_model');
		//验证输入
		if ($this->form_validation->run() === FALSE) {
			$this->json_out->fail(strip_tags(validation_errors()));
			return;
		}
		$userId = $this->user['id'];
		$categoryId = $this->input->post('category_id');

		$taskList = $this->task_model->getFinishTaskList($userId,$categoryId);

		$this->json_out->data($taskList);
	}

	public function addCategory()
	{
		$this->load->model('category_model');
		//验证输入
		if ($this->form_validation->run() === FALSE) {
			$this->json_out->fail(strip_tags(validation_errors()));
			return;
		}
		$data['category_name'] = clean($this->input->post('category_name'));
		$data['user_id'] = $this->user['id'];

		$insertId = $this->category_model->add($data);

		$this->json_out->data($this->category_model->get($insertId));
	}

	/**
	 * ajax添加新任务
	 */
	public function addTask()
	{
		$this->load->model('task_model');
		//验证输入
		if ($this->form_validation->run() === FALSE) {
			$this->json_out->fail(strip_tags(validation_errors()));
			return;
		}
		$data['title'] = clean($this->input->post('title'));
		$data['category_id'] = intval($this->input->post('category_id'));
		$data['user_id'] = $this->user['id'];

		$insertId = $this->task_model->add($data);

		$this->json_out->data($this->task_model->get($insertId));
	}

	/**
	 * ajax添加新子任务
	 */
	public function addTaskOptions()
	{
		$this->load->model('task_options_model');
		//验证输入
		if ($this->form_validation->run() === FALSE) {
			$this->json_out->fail(strip_tags(validation_errors()));
			return;
		}
		$data['title'] = clean($this->input->post('title'));
		$data['task_id'] = intval($this->input->post('task_id'));
		$data['user_id'] = $this->user['id'];

		$insertId = $this->task_options_model->add($data);

		$this->json_out->data($this->task_options_model->get($insertId));
	}

	/**
	 * 完成任务
	 */
	public function changeTaskStatus()
	{
		$this->load->model('task_model');

		if ($this->form_validation->run() === FALSE) {
			$this->json_out->fail(strip_tags(validation_errors()));
			return;
		}
		$status = intval($this->input->post('status'));
		$where['id'] = intval($this->input->post('task_id'));
		$where['user_id'] = $this->user['id'];

		$this->task_model->updateByWhere(array('status' => $status), $where);

		$this->json_out->success('操作成功');
	}

	/**
	 * 完成子任务
	 */
	public function changeTaskOptionStatus()
	{
		$this->load->model('task_options_model');

		if ($this->form_validation->run() === FALSE) {
			$this->json_out->fail(strip_tags(validation_errors()));
			return;
		}
		$status = intval($this->input->post('status'));
		$where['id'] = intval($this->input->post('task_option_id'));
		$where['user_id'] = $this->user['id'];

		$this->task_options_model->updateByWhere(array('status' => $status), $where);

		$this->json_out->success('操作成功');
	}

	/**
	 * 删除任务
	 */
	public function deleteTask()
	{
		$this->load->model('task_model');

		if ($this->form_validation->run() === FALSE) {
			$this->json_out->fail(strip_tags(validation_errors()));
			return;
		}
		$where['id'] = intval($this->input->post('task_id'));
		$where['user_id'] = $this->user['id'];

		$this->task_model->updateByWhere(array('is_delete' => 1), $where);

		$this->json_out->success('操作成功');
	}

	/**
	 * 删除任务
	 */
	public function deleteTaskOption()
	{
		$this->load->model('task_options_model');

		if ($this->form_validation->run() === FALSE) {
			$this->json_out->fail(strip_tags(validation_errors()));
			return;
		}
		$where['id'] = intval($this->input->post('task_option_id'));
		$where['user_id'] = $this->user['id'];

		$this->task_options_model->updateByWhere(array('is_delete' => 1), $where);

		$this->json_out->success('操作成功');
	}

	/**
	 * 修改分类名
	 */
	public function changeCategoryName()
	{
		$this->load->model('category_model');

		if ($this->form_validation->run() === FALSE) {
			$this->json_out->fail(strip_tags(validation_errors()));
			return;
		}
		$where['id'] = intval($this->input->post('category_id'));
		$categoryName = $this->input->post('category_name');

		$this->category_model->updateByWhere(array('category_name' => $categoryName), $where);

		$this->json_out->success('操作成功');
	}

	/**
	 * 删除分类
	 */
	public function deleteCategory()
	{
		$this->load->model('category_model');
		$this->load->model('task_model');

		if ($this->form_validation->run() === FALSE) {
			$this->json_out->fail(strip_tags(validation_errors()));
			return;
		}
		$categoryId = intval($this->input->post('category_id'));

		//删除分类
		$this->category_model->updateByWhere(array('is_delete' => 1), array('id'=>$categoryId));
		//删除所属的任务
		$this->task_model->updateByWhere(array('is_delete' => 1), array('category_id'=>$categoryId));

		$this->json_out->success('操作成功');
	}
}