<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

$CI =& get_instance();

$config = array(
	'login/login' => array(
		array(
			'field' => 'username',
			'label' => '用户名',
			'rules' => 'required|min_length[4]|max_length[20]|alpha_numeric',
		),
		array(
			'field' => 'password',
			'label' => '密码',
			'rules' => 'required|min_length[4]|max_length[20]',
		),
	),
	'login/register' => array(
		array(
			'field' => 'username',
			'label' => '用户名',
			'rules' => 'required|min_length[4]|max_length[20]|alpha_numeric',
		),
		array(
			'field' => 'password',
			'label' => '密码',
			'rules' => 'required|min_length[4]|max_length[20]',
		),
	),
	'user/postChangePass' => array(
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
	'user/postSetting' => array(
		array(
			'field' => 'per_page',
			'label' => '每页显示数量',
			'rules' => 'is_natural',
		),
		array(
			'field' => 'site_name',
			'label' => '站点名称',
			'rules' => 'max_length[50]',
		),
	),
	'todo/addCategory' => array(
		array(
			'field' => 'category_name',
			'label' => '分类名称',
			'rules' => 'required|max_length[100]',
		),
	),
	'todo/addTask' => array(
		array(
			'field' => 'title',
			'label' => '任务内容',
			'rules' => 'required|max_length[255]',
		),
		array(
			'field' => 'category_id',
			'label' => 'category_id',
			'rules' => 'required|is_natural',
		),
	),
	'todo/addTaskOptions' => array(
		array(
			'field' => 'title',
			'label' => '子任务内容',
			'rules' => 'required|max_length[255]',
		),
		array(
			'field' => 'task_id',
			'label' => 'task_id',
			'rules' => 'required|is_natural',
		),
	),
	'todo/getTaskOptions' => array(
		array(
			'field' => 'task_id',
			'label' => 'task_id',
			'rules' => 'required|is_natural',
		),
	),
	'todo/getFinishTask' => array(
		array(
			'field' => 'category_id',
			'label' => 'category_id',
			'rules' => 'required|is_natural',
		),
	),
	'todo/changeTaskStatus' => array(
		array(
			'field' => 'task_id',
			'label' => 'task_id',
			'rules' => 'required|is_natural',
		),
		array(
			'field' => 'status',
			'label' => '状态',
			'rules' => 'required|is_natural',
		),
	),
	'todo/changeTaskOptionStatus' => array(
		array(
			'field' => 'task_option_id',
			'label' => 'task_option_id',
			'rules' => 'required|is_natural',
		),
		array(
			'field' => 'status',
			'label' => '状态',
			'rules' => 'required|is_natural',
		),
	),
	'todo/deleteTask' => array(
		array(
			'field' => 'task_id',
			'label' => 'task_id',
			'rules' => 'required|is_natural',
		),
	),
	'todo/deleteTaskOption' => array(
		array(
			'field' => 'task_option_id',
			'label' => 'task_option_id',
			'rules' => 'required|is_natural',
		),
	),
	'todo/changeCategoryName' => array(
		array(
			'field' => 'category_id',
			'label' => 'category_id',
			'rules' => 'required|is_natural',
		),
		array(
			'field' => 'category_name',
			'label' => '分类名称',
			'rules' => 'required|max[255]',
		),
	),
	'todo/deleteCategory' => array(
		array(
			'field' => 'category_id',
			'label' => 'category_id',
			'rules' => 'required|is_natural',
		),
	),
);

$config['error_prefix'] = ' ';
$config['error_suffix'] = ' ';