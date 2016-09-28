<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * Author: William
 * Date: 2016/9/19
 * Time: 21:09
 */
class User extends Back_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin_user_model');
	}

	public function index()
	{
		$data['input']['name'] = clean($this->input->get('name'));
		$page = intval(clean($this->input->get('page')));
		$page = $page > 0 ? $page : 1;

		$filed = 'admin_user.*';
		//生成查询条件
		$where = array();
		if (!empty($data['input']['name'])) {
			$where['admin_user.username like'] = '%' . $data['input']['name'] . '%';
		}
		//列表查询
		$perPage = 20;
		$data['list'] = $this->admin_user_model->getAllAdminUser($where, $page, $perPage, 'admin_user.id asc', $filed);
		//print_r($data);exit;
		//生成pager
		$pageParam = array(
			'total_rows' => $this->admin_user_model->query_count,
			'per_page' => $perPage,
			'base_url' => base_url('/back/user/index') . "?" . http_build_query($data['input'])
		);

		$data['pager'] = get_page_nav($pageParam);

		view('/back/admin_user', $data);
	}

	/**
	 * 添加管理员帐号
	 */
	public function addAdminUser()
	{
		$this->load->library('form_validation');
		$this->load->library('json_out');

		$username = clean($this->input->post('username'));

		//验证表单
		if ($this->form_validation->run() === FALSE) {
			$this->json_out->fail(strip_tags(validation_errors()));
			return;
		}

		//添加用户进数据库
		$salt = generateSalt();
		$this->admin_user_model->add(array(
			'username' => $username,
			'password' => compile_pass($username, $salt),
			'salt' => $salt,
			'root' => 1
		));

		$this->json_out->success('添加成功');
	}

	/**
	 * 删除管理员用户
	 */
	public function deleteAdminUser()
	{
		$this->load->library('json_out');

		$id = intval(clean($this->input->post('id')));

		if (empty($id)) {
			$this->json_out->fail('参数有误');
			return;
		}

		//操作数据库
		if ($this->admin_user_model->delete($id)) {
			$this->json_out->success('删除成功');
		} else {
			$this->json_out->fail('删除失败');
		}
	}

	/**
	 *
	 * get和post方法分开接口
	 */
	public function changePass()
	{
		view('/back/admin_change_pass');
	}

	public function ajaxChangePass()
	{
		$this->load->library('form_validation');
		//验证表单
		if ($this->form_validation->run() === FALSE) {
			view('/back/admin_change_pass', array('errors' => strip_tags(validation_errors())));
			return;
		}

		$opass = clean($this->input->post('opass'));
		$newpass = clean($this->input->post('password'));
		if (!$this->admin_user_model->validPass($this->user['username'], $opass)) {
			view('/back/admin_change_pass', array('errors' => '密码不正确'));
			return;
		}

		$this->admin_user_model->changePass($this->user['id'], $newpass, $this->user['salt']);

		echo '<script>alert("修改成功");window.location.href="' . base_url('/back/user/changePass') . '"</script>';
	}

	public function test()
	{
		$this->load->library('json_out');
		$this->json_out->output('test');
	}
}