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
		);
		$query = $this->db->where($where)
			->select('category.*')->order_by('category.id','asc')
			->get($this->table)->result_array();
		return $query;
	}
	
}