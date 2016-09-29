<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * Author: William
 * Date: 2016/9/19
 * Time: 21:09
 */
class Login extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('view');

		$this->load->library('encryption');
		$this->encryption->initialize(array('driver' => 'openssl'));

		$this->load->model('user_model');
	}

	public function index()
	{
		redirect('/login/login');
	}

	/**
	 * 登陆
	 * get和post方法分开接口
	 */
	public function login()
	{
		//验证记住登陆
		$remember = get_cookie('_user_login');
		$remember = $this->encryption->decrypt($remember);
		if (!empty($remember)) {
			$userInfo = json_decode($remember, TRUE);

			$username = $userInfo['username'];
			$password = $userInfo['password'];
			if (($userInfo = $this->user_model->validPass($username, $password))) {
				//验证密码成功则更新登陆时间，并保存session
				$this->user_model->loginSuccess($userInfo);
				redirect('/todo/index');
			} else {
				set_cookie('_user_login', '', time() - 3600);
			}
		}

		if ($this->input->method(TRUE) != 'POST') {
			view('/login');
			return;
		} else {

			$this->load->library('form_validation');
			//验证表单
			if ($this->form_validation->run() === FALSE) {
				view('/login', array('errors' => validation_errors()));
				return;
			}
			$username = clean($this->input->post('username'));
			$password = clean($this->input->post('password'));
			if (!($userInfo = $this->user_model->validPass($username, $password))) {
				view('/login', array('errors' => '密码错误或帐号不存在'));
				return;
			}
			//验证密码成功则更新登陆时间，并保存session
			$this->user_model->loginSuccess($userInfo);

			redirect('/todo/index');

		}
	}

	public function logout()
	{
		$this->user_model->logout();
		redirect('/login/login');
	}
}