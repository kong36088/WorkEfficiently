<?php

/**
 * Created by PhpStorm.
 * Author: William
 * Date: 2016/9/21
 * Time: 12:23
 */
class Count extends WE_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index(){
		view('/count');
	}

	/**
	 * 获取每个分类的统计情况
	 */
	public function getCategoryCount(){
		$this->load->model('category_model');
		$this->load->library('json_out');

		$userId = $this->user['id'];

		$count = $this->category_model->getCategoryCount($userId);

		$this->json_out->data($count);
	}

	/**
	 * 获取全部任务完成情况
	 */
	public function getTaskCount(){
		$this->load->model('task_model');
		$this->load->library('json_out');

		$userId = $this->user['id'];

		$count = $this->task_model->getTaskCount($userId);

		$this->json_out->data($count);
	}
}