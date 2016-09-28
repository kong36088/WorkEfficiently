<?php

/**
 * Created by PhpStorm.
 * Author: William
 * Date: 2016/9/21
 * Time: 19:34
 */
class School_model extends DC_Model
{
	public $table = 'school';

	public function __construct()
	{
		parent::__construct();
	}


	public function getSchoolById($school_id)
	{
		$query = $this->db->where(array('id' => $school_id))->get('school')->result_array();
		if (empty($query)) {
			return NULL;
		} else {
			return $query[0];
		}
	}

	/**
	 * 获取所有学校+校区信息
	 * @param array $where
	 * @param int $page
	 * @param int $count
	 * @param string $order_by
	 * @return mixed
	 */
	public function getAllSchoolAndArea($where = array(), $page = 1, $count = 15, $order_by = '', $filed = '*')
	{
		//计算数量
		$start = ($page - 1) * $count;

		$count_get = $this->db->where($where)->count_all_results('school');
		$this->query_count = $count_get;

		//查询学校列表
		$query = $this->db->where($where);
		if (!empty($order_by)) {
			$query = $query->order_by($order_by);
		}
		$list = $query->limit($count, $start)->select($filed)->get('school')->result_array();

		//查询校区
		foreach ($list as &$l) {
			$l['area'] = $this->db->where(array('school_id' => $l['id'], 'is_delete' => 0))->get('school_area')->result_array();
		}
		return $list;
	}

	/**
	 * 根据学校获取校区
	 * @param $school_id
	 * @return array
	 */
	public function getSchoolAreaBySchoolId($school_id, $order_by = '')
	{
		$query = $this->db->where(array('school_id' => $school_id, 'is_delete' => 0));
		if (!empty($order_by)) {
			$query = $query->order_by($order_by);
		}
		$list = $query->get('school_area')->result_array();

		return $list;
	}

	/**
	 * 获取所有学校
	 * @return array
	 */
	public function getAll()
	{
		return $this->db->where(array('is_delete' => 0))->get('school')->result_array();
	}
}