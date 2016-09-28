<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * Author: William
 * Date: 2016/9/18
 * Time: 23:59
 */
class TD_Model extends CI_Model
{
	public $table = '';
	public $query_count = 0;

	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * 添加记录
	 *
	 * @return int
	 */
	public function add($data)
	{
		// 确认表名不能为空
		if (empty($this->table)) {
			return false;
		}

		$this->db->set($data)->insert($this->table);
		return $this->db->insert_id();
	}


	/**
	 * 根据ID获得单条记录信息
	 * @return array
	 */
	public function get($id)
	{
		// 确认表名不能为空
		if (empty($this->table)) {
			return false;
		}

		$query = $this->db->where(array('id' => $id))->get($this->table);
		$info = $query->result_array();

		if (empty($info[0])) {
			return array();
		} else {
			$info = $info[0];
			return $info;
		}

	}

	/**
	 * 通过where条件获得记录
	 */
	public function getByWhere($where = array())
	{
		if (empty($this->table)) {
			return false;
		}
		$query = $this->db->get_where($this->table, $where);
		return $query->result_array();
	}

	public function updateByWhere($set, $where)
	{
		if (empty($this->table)) {
			return false;
		}
		return $this->db->update($this->table, $set, $where);
	}

	/**
	 * 给一个字段的值加1
	 */
	public function filedPlusOne($id, $field, $num = 1)
	{
		if (empty($this->table)) {
			return false;
		}
		$sql = "update {$this->table} set ? = ? + ? where id = ?";
		$query = $this->db->query($sql, array($field, $field, $num, $id));
		if ($this->db->affected_rows()) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 *
	 */
	public function filedMinusOne($id, $field, $num = 1)
	{
		if (empty($this->table)) {
			return false;
		}
		$sql = "update {$this->table} set ? = ? - ? where id = ?";
		$query = $this->db->query($sql, array($field, $field, $num, $id));
		if ($this->db->affected_rows()) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * 更新记录
	 */
	public function update($id, $update)
	{
		// 确认表名不能为空
		if (empty($this->table)) {
			return false;
		}

		$ret = $this->db->update($this->table, $update, array(
			'id' => $id,
		));

		//$fp = fopen("/tmp/debug.log","a");
		//fwrite($fp,$this->db->last_query()."\n");
		//fclose($fp);

		return (bool)$ret;
	}


	/**
	 * 根据 id 删除记录
	 */
	public function delete($id)
	{
		// 确认表名不能为空
		if (empty($this->table)) {
			return false;
		}

		$sql = "DELETE FROM " . $this->table . " WHERE id = ?";
		$query = $this->db->query($sql, array($id));
		return $query;
	}

	/**
	 * 查询获得记录
	 */
	public function all($where = array(), $page = 1, $count = 15, $order_by = '')
	{
		// 确认表名不能为空
		if (empty($this->table)) {
			return false;
		}
		$start = ($page - 1) * $count;

		$count_get = $this->db->where($where)->count_all($this->table);
		$this->query_count = $count_get;

		$query = $this->db->where($where)->limit($count,$start);
		if (!empty($order_by)) {
			$query = $query->order_by($order_by);
		}
		$list = $query->get($this->table)->result_array();

		return $list;
	}

	/*
	*  查询最新的一条记录
	*  $where,跟db->where()用法一样，支持多种参数
	*  $field(字符串),默认为*,可以指定字段名,指定多字段名
	*  @return 最新的一条记录(数组),没有记录返回空数组
	*/

	public function last($where, $field = '*', $order_by = 'id')
	{
		// 确认表名不能为空
		if (empty($this->table)) {
			return false;
		}
		$this->db->select($field)->from($this->table)->where($where)->order_by($order_by, 'desc')->limit(1);
		$query = $this->db->get();
		$list = $query->result_array();
		if (empty($list)) {
			return array();
		}
		return $list[0];
	}
}