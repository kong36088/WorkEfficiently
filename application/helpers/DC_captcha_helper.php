<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * Author: William
 * Date: 2016/9/20
 * Time: 20:09
 */

if (!function_exists('generate')) {
	/**
	 * 生成验证码，并写入cookie
	 * @param string $url
	 * @return array
	 */
	function generate($url = '')
	{
		$vals = array(
			'word'      => 'Random word',
			'img_path'  => './captcha/',
			'img_url'   => empty($url) ? base_url('/captcha') : $url,
			'img_width' => '150',
			'img_height'    => 30,
			'expiration'    => 7200,
			'word_length'   => 4,
			'font_size' => 20,
			'pool'      => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',

			// White background and border, black text and red grid
			'colors'    => array(
				'background' => array(255, 255, 255),
				'border' => array(255, 255, 255),
				'text' => array(0, 0, 0),
				'grid' => array(255, 40, 40)
			)
		);
		$cap = create_captcha($vals);
		$data = array(
			'captcha_time' => $cap['time'],
			//'ip_address' => $this->input->ip_address(),
			'word' => $cap['word']
		);
		return $data;
	}
}