<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * Author: William
 * Date: 2016/9/22
 * Time: 12:35
 */
class Client extends Back_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
	}

	/**
	 * 显示用户列表
	 */
	public function index()
	{
		$data['input']['name'] = clean($this->input->get('name'));
		$page = intval(clean($this->input->get('page')));
		$page = $page > 0 ? $page : 1;

		$filed = 'user.*,school.school_name,school_area.area_name';
		//生成查询条件
		$where = array();
		if (!empty($data['input']['name'])) {
			$where['user.nickname like'] = '%' . $data['input']['name'] . '%';
		}
		//列表查询
		$perPage = 20;
		$data['list'] = $this->user_model->getAllUserWithSchool($where, $page, $perPage, 'user.id asc', $filed);
		//print_r($data);exit;
		//生成pager
		$pageParam = array(
			'total_rows' => $this->user_model->query_count,
			'per_page' => $perPage,
			'base_url' => base_url('/back/client/index') . "?" . http_build_query($data['input'])
		);

		$data['pager'] = get_page_nav($pageParam);

		view('/back/user', $data);
	}

	/**
	 * 禁用开启用户
	 */
	public function forbidUser()
	{
		$this->load->library('json_out');

		$id = intval(clean($this->input->post('id')));
		$is_forbidden = clean($this->input->post('is_forbidden'));

		if (empty($id) || (empty($is_forbidden) && $is_forbidden !== "0")) {
			$this->json_out->fail('参数有误');
			return;
		}
		$this->user_model->update($id, array('is_forbidden' => $is_forbidden));

		$this->json_out->success('操作成功');
	}

	public function detail(){
		$this->load->model('order_model');

		$data['input']['user_id'] = intval(clean($this->input->get('user_id')));

		//查询
		$data['info'] = $this->user_model->getUserById($data['input']['user_id']);
		if(empty($data['info'])){
			show_error('找不到用户信息');
		}
		$data['driver_order'] = $this->order_model->getDriverOrder($data['input']['user_id']);
		$data['customer_order'] = $this->order_model->getCustomerOrder($data['input']['user_id']);

		//print_r($data);exit;

		view('/back/user_detail', $data);
	}
}