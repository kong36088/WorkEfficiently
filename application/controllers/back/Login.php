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
	}

	public function index(){
		header('Location:/back/login/login');
	}

	/**
	 * 登陆
	 * get和post方法分开接口
	 */
	public function login()
	{
		if ($this->input->method(TRUE) != 'POST') {
			view('/back/login');
		} else {
			$this->load->library('form_validation');
			//验证表单
			if ($this->form_validation->run() === FALSE) {
				view('/back/login', array('errors' => validation_errors()));
				return;
			} else {
				$this->load->model('admin_user_model');
				$username = clean($this->input->post('username'));
				$password = clean($this->input->post('password'));
				if (!($userInfo = $this->admin_user_model->validPass($username, $password))) {
					view('/back/login', array('errors' => '密码错误或帐号不存在'));
					return;
				}
				//验证密码成功则更新登陆时间，并保存session
				$this->admin_user_model->loginSuccess($userInfo);
				
				header('Location:/back/count');
			}
		}
	}

	public function logout(){
		$this->load->model('admin_user_model');
		$this->admin_user_model->logout();
		header('Location:/back/login/login');
	}
}