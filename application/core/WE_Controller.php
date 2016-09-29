<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * Author: William
 * Date: 2016/9/18
 * Time: 23:58
 */

/**
 * 核心控制器，负责前置操作
 * Class TD_Controller
 */
class WE_Controller extends CI_Controller
{
	public $user;

	public function __construct()
	{
		parent::__construct();

		$this->user = $this->session->userdata('we_user');

		if (empty($this->user['username'])) {
			$this->session->unset_userdata('we_user');
			redirect('/login/login');
			return;
		}
	}
}