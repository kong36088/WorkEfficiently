<?php

/**
 * Created by PhpStorm.
 * Author: William
 * Date: 2016/9/26
 * Time: 17:14
 */
class Comment_model extends DC_Model
{
	public $table = 'comment';

	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * 返回最近的评价内容
	 * @param $driver_id
	 * @return array
	 */
	public function getRecentComment($driver_id, $limit = 5)
	{
		$where = array(
			'driver_id' => $driver_id
		);
		return $this->db->where($where)->limit($limit)->order_by('create_time','desc')->get($this->table)->result_array();
	}
}