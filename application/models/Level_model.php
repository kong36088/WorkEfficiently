<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


/**
 * Created by PhpStorm.
 * Author: William
 * Date: 2016/9/20
 * Time: 22:55
 */
class Level_model extends DC_Model
{
	public $table = 'level';

	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * 获取用户对应等级
	 * @param int $order_num 订单数量
	 * @return array
	 */
	public function getUserLevel($order_num)
	{
		$query = $this->db->where(array('order_num <=' => $order_num))->limit(1)->order_by('order_num', 'desc')->get($this->table)->result_array();
		if (!empty($query)) {
			return $query[0];
		} else {
			return NULL;
		}
	}

	/**
	 * 获取所有订单
	 * @return array
	 */
	public function getAllLevel()
	{
		return $this->db->order_by('order_num','asc')->get($this->table)->result_array();
	}
}