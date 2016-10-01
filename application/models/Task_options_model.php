<?php

/**
 * Created by PhpStorm.
 * Author: William
 * Date: 2016/9/30
 * Time: 13:35
 */
class Task_options_model extends WE_Model
{
	public $table = 'task_options';

	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * 获取子任务列表
	 * @param $userId
	 * @param $taskId
	 * @return array
	 */
	public function getTaskOptionsList($userId, $taskId)
	{
		$where = array(
			'task_id' => $taskId,
			'user_id' => $userId,
			'is_delete' => 0
		);
		return $this->db->where($where)->order_by('id','asc')->get($this->table)->result_array();
	}

}