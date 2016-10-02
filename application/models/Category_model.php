<?php

/**
 * Created by PhpStorm.
 * Author: William
 * Date: 2016/9/30
 * Time: 13:35
 */
class Category_model extends WE_Model
{
	public $table = 'category';

	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * 获取用户的任务列表,按分类显示
	 * @param $userId
	 * @return array
	 */
	public function getCategoryList($userId)
	{
		$where = array(
			'category.user_id' => $userId,
			'category.is_delete'=>0
		);
		$query = $this->db->where($where)
			->select('category.*')->order_by('category.id','asc')
			->get($this->table)->result_array();
		return $query;
	}

	/**
	 * 按分类统计分类任务数量
	 * @param $userId
	 * @return mixed
	 */
	public function getCategoryCount($userId)
	{
		$where = array(
			'task.is_delete' => 0,
			'task.user_id' => $userId,
			'category.is_delete' => 0
		);
		$query = $this->db->where($where)
			->join('task', 'category.id = task.category_id','RIGHT')
			->select('category.category_name,task.category_id,count(*) as num')->group_by('task.category_id')
			->get($this->table)->result_array();
		return $query;
	}
}