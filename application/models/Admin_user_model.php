<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


/**
 * Created by PhpStorm.
 * Author: William
 * Date: 2016/9/20
 * Time: 22:56
 */
class Admin_user_model extends DC_Model
{
	public $table = 'admin_user';

	public function __construct()
	{
		parent::__construct();
	}

	public function getUserByUsername($username)
	{
		$query = $this->db->where(array('username' => $username))->get($this->table);
		if (empty($query)) {
			return NULL;
		} else {
			return $query->result_array()[0];
		}
	}

	/**
	 * 获取所有超级用户
	 * @param array $where
	 * @param int $page
	 * @param int $count
	 * @param string $order_by
	 * @param string $filed
	 * @return mixed
	 */
	public function getAllAdminUser($where = array(), $page = 1, $count = 15, $order_by = '', $filed = '*')
	{
		//计算数量
		$start = ($page - 1) * $count;

		$count_get = $this->db->where($where)
			->count_all_results('admin_user');
		$this->query_count = $count_get;

		//查询超级用户列表
		$query = $this->db->where($where);
		if (!empty($order_by)) {
			$query = $query->order_by($order_by);
		}
		$list = $query->limit($count, $start)->select($filed)->get('admin_user')->result_array();

		return $list;
	}

	/**
	 * 验证密码
	 * @param $username
	 * @param $password
	 * @return bool
	 */
	public function validPass($username, $password)
	{
		$userInfo = $this->getUserByUsername($username);
		if (empty($userInfo)) {
			return FALSE;
		}
		if ($userInfo['password'] == compile_pass($password, $userInfo['salt'])) {
			return $userInfo;
		} else {
			return NULL;
		}
	}

	/**
	 * 保存用户信息到session并且更新登陆时间
	 * @param $userInfo array 用户信息数组
	 */
	public function loginSuccess($userInfo)
	{
		//保存session
		$this->session->set_userdata('admin_user', $userInfo);
		//更新登陆时间
		$this->admin_user_model->updateByWhere(array('last_login' => date_now()), array('username' => $userInfo['username']));
	}

	/**
	 * 退出登陆
	 */
	public function logout()
	{
		$this->session->unset_userdata('admin_user');
	}

	public function changePass($user_id, $password, $salt)
	{
		$this->updateByWhere(array('password' => compile_pass($password, $salt)), array('id' => $user_id));
	}
}