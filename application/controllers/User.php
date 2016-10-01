<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * Author: William
 * Date: 2016/9/19
 * Time: 21:09
 */
class User extends WE_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
	}

	/**
	 *
	 * get和post方法分开接口
	 */
	public function changePass()
	{
		view('/change_pass');
	}

	public function postChangePass()
	{
		$this->load->library('form_validation');
		//验证表单
		if ($this->form_validation->run() === FALSE) {
			view('/change_pass', array('errors' => strip_tags(validation_errors())));
			return;
		}

		$opass = clean($this->input->post('opass'));
		$newpass = clean($this->input->post('password'));
		if (!$this->admin_user_model->validPass($this->user['username'], $opass)) {
			view('/back/admin_change_pass', array('errors' => '密码不正确'));
			return;
		}

		$this->admin_user_model->changePass($this->user['id'], $newpass, $this->user['salt']);

		echo '<script>alert("修改成功");window.location.href="' . base_url('/user/changePass') . '"</script>';
	}

	public function setting(){
		$data['per_page'] = $this->config_model->getConfig($this->user['id'],'per_page');

		$data['site_name'] = $this->config_model->getConfig($this->user['id'],'site_name');

		view('/setting',$data);
	}

	public function postSetting(){
		$this->load->library('form_validation');
		$this->load->library('json_out');
		$this->load->model('config_model');

		//验证表单
		if ($this->form_validation->run() === FALSE) {
			$this->json_out->fail( array('errors' => strip_tags(validation_errors())));
			return;
		}
		$data['per_page'] = empty($this->input->post('per_page'))?'':$this->input->post('per_page');
		$data['site_name'] = empty($this->input->post('site_name'))?'':$this->input->post('site_name');

		$this->config_model->setConfig($this->user['id'],$data);

		$this->json_out->success('操作成功');
	}

}