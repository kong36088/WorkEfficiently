<?php

/**
 * Created by PhpStorm.
 * Author: William
 * Date: 2016/9/26
 * Time: 17:10
 */
class User extends DC_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * 获取司机最近的评价
	 */
	public function getDriverComment(){
		
		$this->load->model('comment_model');
		$this->load->library('json_out');
		
		$comments = $this->comment_model->getRecentComment($this->user['id']);

		$this->json_out->data($comments);
	}
}