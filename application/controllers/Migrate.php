<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * Author: William
 * Date: 2016/9/18
 * Time: 23:57
 */
class Migrate extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		if (!$this->input->is_cli_request()) {
			show_404();
			return;
		}
		$this->load->library('migration');

	}

	public function index()
	{
		if ($this->migration->latest() === FALSE) {
			show_error($this->migration->error_string());
		} else {
			echo "done" . PHP_EOL;
		}
	}
}