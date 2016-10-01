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
	public function index(){
		$this->load->model('category_model');
		$this->load->model('task_model');

		$userId = $this->user['id'];

		$data['list'] = $this->category_model->getCategoryList($userId);
		$data['list'] = $this->task_model->getTaskList($data['list']);
		//print_r($data);exit;
		
		view('/todo',$data);
	}

	public function getTaskOptions(){
		$this->load->model('task_options_model');
		//验证输入
		if($this->form_validation->run()===FALSE){
			$this->json_out->fail( array('errors' => strip_tags(validation_errors())));
			return;
		}
		$userId = $this->user['id'];
		$taskId = $this->input->post('task_id');

		$taskOptions = $this->task_options_model->getByWhere(array('task_id'=>$taskId,'user_id'=>$userId,'is_delete'=>0,'status'=>1));

		$this->json_out->data($taskOptions);
	}

	public function addCategory(){
		$this->load->model('category_model');
		//验证输入
		if($this->form_validation->run()===FALSE){
			$this->json_out->fail( array('errors' => strip_tags(validation_errors())));
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
	public function addTask(){
		$this->load->model('task_model');
		//验证输入
		if($this->form_validation->run()===FALSE){
			$this->json_out->fail( array('errors' => strip_tags(validation_errors())));
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
	public function addTaskOptions(){
		$this->load->model('task_options_model');
		//验证输入
		if($this->form_validation->run()===FALSE){
			$this->json_out->fail( array('errors' => strip_tags(validation_errors())));
			return;
		}
		$data['title'] = clean($this->input->post('title'));
		$data['task_id'] = intval($this->input->post('task_id'));
		$data['user_id'] = $this->user['id'];

		$insertId = $this->task_options_model->add($data);

		$this->json_out->data($this->task_options_model->get($insertId));
	}
}