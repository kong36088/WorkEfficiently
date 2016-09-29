<?php

/**
 * Created by PhpStorm.
 * Author: William
 * Date: 2016/9/21
 * Time: 12:23
 */
class School extends Back_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('school_model');
	}

	public function index()
	{
		$data['input']['school'] = clean($this->input->get('school'));
		$page = intval(clean($this->input->get('page')));
		$page = $page > 0 ? $page : 1;

		$filed = 'school.*';
		//生成查询条件
		$where = array();
		$where['is_delete'] = 0;
		if (!empty($data['input']['school'])) {
			$where['school.school_name like'] = '%' . $data['input']['school'] . '%';
		}
		//列表查询
		$perPage = 20;
		$data['list'] = $this->school_model->getAllSchoolAndArea($where, $page, $perPage, 'school.id asc', $filed);

		//生成pager
		$pageParam = array(
			'total_rows' => $this->school_model->query_count,
			'per_page' => $perPage,
			'base_url' => base_url('/back/school/index') . "?" . http_build_query($data['input'])
		);

		$data['pager'] = get_page_nav($pageParam);

		view('/back/school', $data);
	}

	/**
	 * 增加学校
	 */
	public function addSchool()
	{
		$this->load->library('json_out');

		$schoolName = clean($this->input->post('school_name'));


		if (empty($schoolName)) {
			$this->json_out->fail('参数有误');
			return;
		}
		$this->school_model->add(array('school_name' => $schoolName));

		$this->json_out->success('新增学校成功');
	}

	/**
	 * 修改学校名称
	 */
	public function changeSchoolName()
	{
		$this->load->library('json_out');

		$id = intval(clean($this->input->post('id')));
		$schoolName = clean($this->input->post('school_name'));
		if (empty($id) || empty($schoolName)) {
			$this->json_out->fail('参数有误');
			return;
		}
		$this->school_model->update($id, array('school_name' => $schoolName));

		$this->json_out->success('修改学校名称成功');
	}

	/**
	 * 删除学校
	 */
	public function deleteSchool()
	{
		$this->load->library('json_out');

		$id = intval(clean($this->input->post('id')));

		if (empty($id)) {
			$this->json_out->fail('参数有误');
			return;
		}
		$this->school_model->update($id, array('is_delete' => 1));

		$this->json_out->success('删除成功');
	}

	/**
	 * 查看校区页面
	 */
	public function area()
	{
		$data['input']['school_id'] = clean($this->input->get('school_id'));

		//列表查询
		$data['list'] = $this->school_model->getSchoolAreaBySchoolId($data['input']['school_id']);

		//获取学校名称
		$data['school'] = $this->school_model->getSchoolById($data['input']['school_id']);

		view('/back/school_area', $data);
	}

	/**
	 * 增加校区
	 */
	public function addSchoolArea()
	{
		$this->load->library('json_out');
		$this->school_model->table = 'school_area';

		$areaName = clean($this->input->post('area_name'));
		$schoolId = intval(clean($this->input->post('school_id')));

		if (empty($areaName) || empty($schoolId)) {
			$this->json_out->fail('参数有误');
			return;
		}
		$this->school_model->add(array('area_name' => $areaName, 'school_id' => $schoolId));

		$this->json_out->success('新增学校成功');
	}

	/**
	 * 修改校区名称
	 */
	public function changeSchoolAreaName()
	{
		$this->load->library('json_out');
		$this->school_model->table = 'school_area';

		$id = intval(clean($this->input->post('id')));
		$areaName = clean($this->input->post('area_name'));
		if (empty($id) || empty($areaName)) {
			$this->json_out->fail('参数有误');
			return;
		}
		$this->school_model->update($id, array('area_name' => $areaName));

		$this->json_out->success('修改学校名称成功');
	}

	/**
	 * 删除校区
	 */
	public function deleteSchoolArea()
	{
		$this->load->library('json_out');
		$this->school_model->table = 'school_area';

		$id = intval(clean($this->input->post('id')));

		if (empty($id)) {
			$this->json_out->fail('参数有误');
			return;
		}
		$this->school_model->update($id, array('is_delete' => 1));

		$this->json_out->success('删除成功');
	}
}