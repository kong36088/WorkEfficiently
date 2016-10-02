<?php

/**
 * Created by PhpStorm.
 * Author: William
 * Date: 2016/9/30
 * Time: 13:35
 */
class Task_model extends WE_Model
{
	public $table = 'task';

	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * 根据category数组获取任务列表
	 * @param array $categoryList
	 * @return array()
	 */
	public function getTaskList(array $categoryList)
	{
		foreach ($categoryList as $key => $value) {
			$where = array(
				'task.is_delete' => 0,
				'task.status' => 1,
				'task.category_id' => $value['id'],
				'task.user_id' => $value['user_id']
			);
			$categoryList[$key]['task_list'] = $this->db->where($where)->order_by('id', 'asc')->get($this->table)->result_array();
		}
		return $categoryList;
	}

	/**
	 * 获取已完成任务列表
	 * @param $userId
	 * @param $categoryId
	 * @return mixed
	 */
	public function getFinishTaskList($userId, $categoryId)
	{
		$where = array(
			'task.is_delete' => 0,
			'task.status <>' => 1,
			'task.category_id' => $categoryId,
			'task.user_id' => $userId
		);
		$query = $this->db->where($where)->order_by('id', 'asc')->get($this->table)->result_array();

		return $query;
	}

	/**
	 * 获取完成任务和未完成任务统计
	 * @param $userId
	 * @return mixed
	 */
	public function getTaskCount($userId){
		$where = array(
			'status' => 1,
			'is_delete'=>0,
			'user_id'=>$userId
		);
		$result['正在进行'] = $this->db->where($where)->count_all_results($this->table);

		$where['status'] = 2;
		$result['已完成'] = $this->db->where($where)->count_all_results($this->table);

		return $result;
	}


}