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
				'task.is_delete'=>0,
				'task.status'=>1,
				'task.category_id'=>$value['id']
			);
			$categoryList[$key]['task_list'] = $this->db->where($where)->order_by('id','asc')->get($this->table)->result_array();
		}
		return $categoryList;
	}
}