<?php

/**
 * Created by PhpStorm.
 * Author: William
 * Date: 2016/9/22
 * Time: 19:45
 */
class Order extends Back_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('order_model');
	}

	/**
	 * 订单列表
	 */
	public function index()
	{
		$this->load->model('school_model');

		$data['input']['id'] = empty(clean($this->input->get('id'))) ? '' : clean($this->input->get('id'));
		$data['input']['school_id'] = empty(clean($this->input->get('school_id'))) ? '' : clean($this->input->get('school_id'));
		$page = intval(clean($this->input->get('page')));
		$page = $page > 0 ? $page : 1;

		$filed = 'order.*,comment.star,comment.comment,school.school_name,school_area.area_name';
		//生成查询条件
		$where = array();
		$where['order.is_delete'] = 0;
		if (!empty($data['input']['id'])) {
			$where['order.id'] = $data['input']['id'];
		}
		if (!empty($data['input']['school_id'])) {
			$where['order.school_id'] = $data['input']['school_id'];
		}

		//列表查询
		$perPage = 20;
		$data['list'] = $this->order_model->getAllOrder($where, $page, $perPage, 'order.id desc', $filed);


		//生成pager
		$pageParam = array(
			'total_rows' => $this->order_model->query_count,
			'per_page' => $perPage,
			'base_url' => base_url('/back/order/index') . "?" . http_build_query($data['input'])
		);

		//获取所有学校
		$data['school_list'] = $this->school_model->getAll();
		//print_r($data);exit;
		
		$data['pager'] = get_page_nav($pageParam);

		//渲染页面
		view('/back/order', $data);
	}
}