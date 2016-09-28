<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


/**
 * Created by PhpStorm.
 * Author: William
 * Date: 2016/9/20
 * Time: 22:55
 */
class Order_model extends DC_Model
{
	public $table = 'order';

	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * 获取所有作为司机的订单
	 * @param $driverId
	 */
	public function getDriverOrder($driverId)
	{
		$where['order.driver_id'] = $driverId;
		$where['order.is_delete'] = 0;
		return $this->db->where($where)
			->join('comment', 'order.id = comment.order_id', 'LEFT')
			->join('school', 'order.school_id = school.id', 'LEFT')
			->join('school_area', 'order.area_id = school_area.id', 'LEFT')
			->select('order.*,comment.star,comment.comment,school.school_name,school_area.area_name')
			->get($this->table)->result_array();
	}

	/**
	 * 获取所有作为乘客的订单
	 * @param $driverId
	 */
	public function getCustomerOrder($driverId)
	{
		$where['order.customer_id'] = $driverId;
		$where['order.is_delete'] = 0;

		return $this->db->where($where)
			->join('comment', 'order.id = comment.order_id', 'LEFT')
			->join('school', 'order.school_id = school.id', 'LEFT')
			->join('school_area', 'order.area_id = school_area.id', 'LEFT')
			->select('order.*,comment.star,comment.comment,school.school_name,school_area.area_name')
			->get($this->table)->result_array();
	}

	/**
	 * 获得订单列表
	 * @param array $where
	 * @param int $page
	 * @param int $count
	 * @param string $order_by
	 * @param string $filed
	 * @return mixed
	 */
	public function getAllOrder($where = array(), $page = 1, $count = 15, $order_by = '', $filed = '*')
	{
		//计算数量
		$start = ($page - 1) * $count;

		$count_get = $this->db->where($where)
			->join('comment', 'order.id = comment.order_id', 'LEFT')
			->join('school', 'order.school_id = school.id', 'LEFT')
			->join('school_area', 'order.area_id = school_area.id', 'LEFT')
			->count_all_results('order');
		$this->query_count = $count_get;

		//查询学校列表
		$query = $this->db->where($where)
			->join('comment', 'order.id = comment.order_id', 'LEFT')
			->join('school', 'order.school_id = school.id', 'LEFT')
			->join('school_area', 'order.area_id = school_area.id', 'LEFT');
		if (!empty($order_by)) {
			$query = $query->order_by($order_by);
		}
		$list = $query->limit($count, $start)->select($filed)->get('order')->result_array();

		return $list;
	}

	/**
	 * 计算一个星期的订单数量
	 * @return array
	 */
	public function getWeekOrderNum($where = array())
	{
		$result = array();
		//从七天前开始计算
		for ($i = -6; $i <= 0; $i++) {
			$result[date('d', strtotime($i . ' day')) . '日'] = $this->db->where($where)->where(array(
				'status' => 3,
				'create_time >=' => get_day_start($i),
				'create_time <' => get_day_start($i + 1)
			))->count_all_results('order');
		}
		return $result;
	}

	/**
	 * 计算一年的订单数量
	 * @return array
	 */
	public function getYearOrderNum($where = array())
	{
		$result = array();
		//从七天前开始计算
		for ($i = -11; $i <= 0; $i++) {
			$result[date('m', strtotime($i . ' month')) . '月'] = $this->db->where($where)->where(array(
				'status' => 3,
				'create_time >=' => get_month_start($i),
				'create_time <' => get_month_start($i + 1)
			))->count_all_results('order');
			//echo $this->db->last_query();
		}
		return $result;
	}

	public function getTotalOrderNum($where = array())
	{
		$result['全部'] = $this->db->where($where)->where(array(
			'status' => 3,
		))->count_all_results('order');
		//echo $this->db->last_query();

		return $result;
	}

	/**
	 * 获取周排行榜
	 */
	public function getWeekRanking(){
		$where = array(
			'order.status' => 3,
			'order.is_delete'=>0,
			'order.create_time >='=>get_day_start(-7)
		);
		$query = $this->db->where($where)->group_by('order.driver_id')
			->join('user as u','order.driver_id = u.id','LEFT')
			->order_by('order_num','desc')
			->select('order.driver_id,count(*) as order_num,u.*')->get($this->table)->result_array();
		return $query;

	}

	/**
	 * 获取总排行榜
	 */
	public function getTotalRanking(){
		$where = array(
			'order.status' => 3,
			'order.is_delete'=>0,
		);
		$query = $this->db->where($where)->group_by('order.driver_id')
			->join('user as u','order.driver_id = u.id','LEFT')
			->order_by('order_num','desc')
			->select('order.driver_id,count(*) as order_num,u.*')->get($this->table)->result_array();
		return $query;

	}
}