<?php defined('SYSPATH') OR die('No direct access allowed.');

class HTTP_Exception_404 extends Kohana_HTTP_Exception_404 {
	public function get_response()
	{
		return Response::factory()
			->status(404)
			->body(Request::factory('/http404', array('callback_params' => array('message' => $this->getMessage())))->execute());
	}
}