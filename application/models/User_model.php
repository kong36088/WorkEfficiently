<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


/**
 * Created by PhpStorm.
 * Author: William
 * Date: 2016/9/20
 * Time: 22:55
 */
class User_model extends DC_Model
{
	public $table = 'user';

	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * 获取所有用户+学校信息
	 * @param array $where
	 * @param int $page
	 * @param int $count
	 * @param string $order_by
	 * @return array
	 */
	public function getAllUserWithSchool($where = array(), $page = 1, $count = 15, $order_by = '', $filed = '*')
	{
		//计算数量
		$start = ($page - 1) * $count;

		$count_get = $this->db->where($where)
			->join('school', 'user.school_id = school.id', 'LEFT')
			->join('school_area', 'user.area_id = school_area.id', 'LEFT')
			->count_all_results('user');
		$this->query_count = $count_get;

		//查询用户列表+关联查询学校信息
		$query = $this->db->where($where)
			->join('school', 'user.school_id = school.id', 'LEFT')
			->join('school_area', 'user.area_id = school_area.id', 'LEFT');
		if (!empty($order_by)) {
			$query = $query->order_by($order_by);
		}
		$list = $query->limit($count, $start)->select($filed)->get('user')->result_array();

		return $list;
	}

	/**
	 * 根据ID获取用户信息
	 * @param $userId
	 * @return array
	 */
	public function getUserById($userId)
	{
		$query = $this->db->where(array('user.id' => $userId))
			->join('school', 'user.school_id = school.id', 'LEFT')
			->join('school_area', 'user.area_id = school_area.id', 'LEFT')
			->select('user.*,school.school_name,school_area.area_name')
			->get($this->table)->result_array();
		if (!empty($query)) {
			return $query[0];
		} else {
			return NULL;
		}
	}

	public function getUserByOpenid($openid){
		$query = $this->db->where(array('user.openid' => $openid))
			->join('school', 'user.school_id = school.id', 'LEFT')
			->join('school_area', 'user.area_id = school_area.id', 'LEFT')
			->select('user.*,school.school_name,school_area.area_name')
			->get($this->table)->result_array();
		if (!empty($query)) {
			return $query[0];
		} else {
			return NULL;
		}
	}

	/**
	 * 获取司机总数
	 * @param array $where
	 * @return mixed
	 */
	public function getDriverNum($where=array()){
		return $this->db->where($where)->where(array(
			'get_order_num >' => 0
		))->count_all_results($this->table);
	}

	/**
	 * 获取客户总数
	 * @param array $where
	 * @return mixed
	 */
	public function getCustomerNum($where=array()){
		return $this->db->where($where)->where(array(
			'get_order_num >' => 0
		))->count_all_results($this->table);
	}

	/**
	 * 增加注册微信用户
	 * @param $wechatData
	 * @return int
	 */
	public function addWechatUser($wechatData){
		$data = array(
			'sex'=>$wechatData['sex'],
			'nickname' => $wechatData['nickname'],
			'province' =>$wechatData['province'],
			'city' =>$wechatData['city'],
			'openid'=>$wechatData['openid'],
			'head'=>$wechatData['headimgurl'],
		);
		return $this->add($data);
	}

	/**
	 * 更新上次登陆时间
	 * @param $id
	 * @return bool
	 */
	public function updateLoginTime($id){
		return $this->update($id,array('last_login'=>date_now()));
	}

}