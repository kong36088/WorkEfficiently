<?php

/**
 * Created by PhpStorm.
 * Author: William
 * Date: 2016/9/26
 * Time: 13:01
 */
class Order extends DC_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('order_model');
	}

	public function getWeekRanking(){
		$this->load->library('json_out');

		$ranking = $this->order_model->getWeekRanking();

		$this->json_out->data($ranking);
	}
	public function getTotalRanking(){
		$this->load->library('json_out');

		$ranking = $this->order_model->getWeekRanking();

		$this->json_out->data($ranking);
	}
}