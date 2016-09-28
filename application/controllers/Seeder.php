<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * Author: William
 * Date: 2016/9/20
 * Time: 23:26
 */
class Seeder extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (!$this->input->is_cli_request()) {
			show_404();
			return;
		}
	}

	public function start()
	{
		$this->userSeeder();
	}

	protected function userSeeder()
	{
		$this->load->model('user_model');
		$salt = generateSalt();
		$data = array(
			'username' => 'root',
			'password' => compile_pass('root', $salt),
			'salt' => $salt,
			'root' => 1,
		);
		$this->user_model->add($data);
	}


}