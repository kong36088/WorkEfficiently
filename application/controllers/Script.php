<?php

/**
 * 定时脚本控制器
 * Author: William
 * Date: 2016/9/26
 * Time: 17:34
 */
class Script extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		if(!is_cli()){
			show_404();
			exit;
		}
	}

	/**
	 * 零点执行任务
	 */
	public function zeroClockTask(){
		
	}

	/**
	 * 六点执行任务
	 */
	public function sixClockTask(){

	}

	/**
	 * 十二点执行任务
	 */
	public function twelveClockTask(){

	}
}