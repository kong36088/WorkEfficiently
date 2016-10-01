<?php

/**
 * Created by PhpStorm.
 * Author: William
 * Date: 2016/9/29
 * Time: 20:52
 */
class Config_model extends WE_Model
{
	public $table = 'config';

	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * 获取配置
	 * @param $userId
	 * @param $key
	 */
	public function getConfig($userId, $key)
	{
		$where = array(
			'user_id' => $userId,
			'name' => $key
		);
		$query = $this->db->where($where)->order_by('id','desc')->get($this->table)->result_array();
		if (empty($query)) {
			return NULL;
		} else {
			return $query[0]['value'];
		}
	}


	/**
	 * 设置
	 * @param $userId
	 * @param $data array
	 * @return boolean
	 */
	public function setConfig($userId, $data)
	{
		foreach ($data as $key => $value) {
			if ($this->getConfig($userId, $key)) {
				$this->db->update($this->table, array('value' => $value),array('user_id' => $userId, 'name' => $key));
			} else {
				$this->add(array(
					'user_id' => $userId,
					'name' => $key,
					'value' => $value
				));
			}
		}
		return TRUE;
	}
}