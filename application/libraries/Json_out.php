<?php

/**
 * Created by PhpStorm.
 * Author: William
 * Date: 2016/9/21
 * Time: 14:52
 */
class Json_out
{
	const success_code = 1;
	const fail_code = 2;
	const output_code = -1;
	const success_status = 'ok';
	const fail_status = 'fail';

	/**
	 * 成功
	 * @param string $message
	 * @param int $code
	 * @param string $status
	 * @param array $header
	 */
	public function success($message = '', $code = self::success_code, $status = self::success_status, $header = array())
	{
		foreach ($header as $h) {
			header($h);
		}
		echo json_encode(array('code' => $code, 'message' => $message, 'status' => $status));
	}

	/**
	 * 失败
	 * @param string $message
	 * @param int $code
	 * @param string $status
	 * @param array $header
	 */
	public function fail($message = '', $code = self::fail_code, $status = self::fail_status, $header = array())
	{
		foreach ($header as $h) {
			header($h);
		}
		echo json_encode(array('code' => $code, 'message' => $message, 'status' => $status));
	}

	/**
	 * 输出信息
	 * @param string $message
	 * @param int $code
	 * @param array $header
	 */
	public function output($message = '', $code = self::output_code, $header = array())
	{
		foreach ($header as $h) {
			header($h);
		}
		echo json_encode(array('code' => $code, 'message' => $message));
	}
	
	/**
	 * 输出json数据
	 * @param array $data
	 * @param int $code
	 * @param array $header
	 */
	public function data($data = array(), $code = self::success_code, $header = array())
	{
		foreach ($header as $h) {
			header($h);
		}
		echo json_encode(array('code' => $code, 'data' => $data));
	}
}