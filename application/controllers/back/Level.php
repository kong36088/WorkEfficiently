<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * Author: William
 * Date: 2016/9/22
 * Time: 12:35
 */
class Level extends Back_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('level_model');
	}

	/**
	 * 显示用户列表
	 */
	public function index()
	{

		//列表查询
		$data['list'] = $this->level_model->getAllLevel();
		//print_r($data);exit;

		view('/back/level', $data);
	}

	/**
	 * 获取单个等级的数据
	 */
	public function getLevel()
	{
		$this->load->library('json_out');

		$id = intval(clean($this->input->post('id')));

		if (empty($id)) {
			$this->json_out->fail('参数有误');
			return;
		}
		$data = $this->level_model->get($id);

		$this->json_out->data($data);
	}

	/**
	 * 增加等级
	 */
	public function addLevel()
	{
		$this->load->library('json_out');

		$orderNum = intval(clean($this->input->post('order_num')));
		$name = clean($this->input->post('name'));

		if (empty($orderNum) || empty($name)) {
			$this->json_out->fail('参数有误');
			return;
		}
		$this->level_model->add(array('name' => $name, 'order_num' => $orderNum));

		$this->json_out->success('新增等级成功');
	}

	/**
	 * 修改等级
	 */
	public function changeLevel()
	{
		$this->load->library('json_out');

		$id = intval(clean($this->input->post('id')));
		$name = clean($this->input->post('name'));
		$orderNum = intval(clean($this->input->post('order_num')));

		if (empty($id) || empty($name) || empty($orderNum) && $orderNum !== 0) {
			$this->json_out->fail('参数有误');
			return;
		}
		$this->level_model->update($id, array('name' => $name, 'order_num' => $orderNum));

		$this->json_out->success('修改等级成功');
	}

	/**
	 * 删除等级
	 */
	public function deleteLevel()
	{
		$this->load->library('json_out');

		$id = intval(clean($this->input->post('id')));

		if (empty($id)) {
			$this->json_out->fail('参数有误');
			return;
		}
		$this->level_model->delete($id);

		$this->json_out->success('操作成功');
	}

}