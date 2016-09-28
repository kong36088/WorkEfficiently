<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * Author: William
 * Date: 2016/9/20
 * Time: 13:00
 */

require_once 'vendor/autoload.php';
use Philo\Blade\Blade;

if (!function_exists('view')) {
	function view($name = NULL, $data = [], $mergeData = []) {
		$CI =& get_instance();
		if (!isset($CI->blade)) {
			$views = __DIR__ . '/../views';
			$cache = __DIR__ . '/../cache';
			$CI->blade = new Blade($views, $cache);
		}
		echo $CI->blade->view()->make($name, $data, $mergeData)->render();
	}
}