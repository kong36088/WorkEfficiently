<?php

/**
 * Created by PhpStorm.
 * Author: William
 * Date: 2016/9/21
 * Time: 12:23
 */
class Count extends Back_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * 统计首页
	 */
	public function index()
	{
		$this->load->model('school_model');

		$data['school_list'] = $this->school_model->getAll();

		view('/back/count', $data);
	}

	/**
	 * 根据参数获取订单数据量
	 * @param string $frequency 获取订单数量的频次 每周 每月
	 */
	public function getOrderNum()
	{
		$this->load->model('order_model');
		$this->load->library('json_out');

		$frequency = clean($this->input->post('frequency'));
		$school_id = clean($this->input->post('school_id'));

		$where = array();
		if (!empty($school_id)) {
			$where['school_id'] = $school_id;
		}

		switch ($frequency) {
			case 'week':
				$orderNum = $this->order_model->getWeekOrderNum($where);
				break;
			case 'year':
				$orderNum = $this->order_model->getYearOrderNum($where);
				break;
			case 'total':
				$orderNum = $this->order_model->getTotalOrderNum($where);
				break;
			default:
				return;
		}

		//输出数据
		$this->json_out->data($orderNum);
	}

	/**
	 * 获取客户数量接口
	 */
	public function getUserNum()
	{
		$this->load->model('user_model');
		$this->load->library('json_out');

		$school_id = clean($this->input->post('school_id'));
		$userType = clean($this->input->post('user_type'));

		$where = array();
		if (!empty($school_id)) {
			$where['school_id'] = $school_id;
		}

		//获取数据
		switch ($userType) {
			case 'driver':
				$orderNum['司机总数'] = $this->user_model->getDriverNum($where);
				break;
			case 'customer':
				$orderNum['客户总数'] = $this->user_model->getCustomerNum($where);
				break;
			default:
				return;
		}
		//输出数据
		$this->json_out->data($orderNum);
	}


	public function test()
	{
		$this->load->model('order_model');

		$frequency = clean($this->input->post('frequency'));

		$orderNum = $this->order_model->getYearOrderNum();

		print_r($orderNum);

	}
}