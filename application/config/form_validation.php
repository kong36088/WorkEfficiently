<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

$CI =& get_instance();

$config = array(
	'back/login/login' => array(
		array(
			'field' => 'username',
			'label' => '用户名',
			'rules' => 'required|min_length[4]|max_length[20]',
		),
		array(
			'field' => 'password',
			'label' => '密码',
			'rules' => 'required|min_length[4]|max_length[20]',
		),
	),
	'back/user/ajaxChangePass' => array(
		array(
			'field' => 'opass',
			'label' => '旧密码',
			'rules' => 'required|min_length[4]|max_length[20]',
		),
		array(
			'field' => 'password',
			'label' => '新密码',
			'rules' => 'required|min_length[4]|max_length[20]',
		),
		array(
			'field' => 'repass',
			'label' => '重复密码',
			'rules' => 'required|min_length[4]|max_length[20]',
		),
	),
);