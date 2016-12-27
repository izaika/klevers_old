<?php

class Controller_Abstract_Public extends AVO_Controller
{
	const RESOURCE_SERIAL = 112;

	/**
	 * Current AJAX response, if any
	 * @var stdClass
	 */
	protected $result;
	/**
	 * is the request ajax+post?
	 * @var bool
	 */
	protected $is_ajax;

	protected $fb_app_id;

	public $rider;

	public function before() {

		$this->auto_view = TRUE;

		$detect = new Mobiledetect;

		if ($detect->isMobile() && strpos($detect->getUserAgent(), 'Mobile') !== false && strpos($detect->getUserAgent(), 'iPad') === false) {
			$this->device = 'mobile';
		} elseif ($detect->isTablet()) {
			$this->device = 'tablet';
		} else {
			$this->device = 'desktop';
		}
		$this->module = 'public';
		// $this->device = $this->module = 'mobile';
		View::set_global('device', $this->device);

		parent::before();

		// Prepare AJAX
		$this->is_ajax = ($this->request->is_ajax() AND ($this->request->is_post() OR $this->request->is_put()));
		$this->session = Session::instance();

		if ($this->is_ajax) {
			$this->force_ajax_response();
		} else {
			if (is_object($this->template)) {

				if (Kohana::$environment == Kohana::DEVELOPMENT && $this->device != 'mobile') $this->add_js_script('js/'.$this->module.'/lib/modernizr.js');


				$this->add_stylesheet('css/'.$this->module.'/app.' . self::RESOURCE_SERIAL . '.css');

				$this->template->serial_number = self::RESOURCE_SERIAL;
			}
		}
	}


	/**
	 * forces the controller to handler the current request as ajax
	 *
	 */
	public function force_ajax_response()
	{
		$this->is_ajax = TRUE;
		$this->auto_render = FALSE;
		$this->result = new stdClass;
	}


	/**
	 * Post-process the controller execution
	 * @see AVO_Controller::after()
	 */
	public function after()
	{
		if ($this->is_ajax)
		{
			$this->response
				->json()
				->no_cache()
				->body(json_encode($this->result));
		}
		parent::after();
	}


	/**
	 * appends a part to a title
	 *
	 * @param string $value
	 */
	public function append_title($value)
	{
		if ( ! $this->template) return;
		if ( ! is_array($this->template->title))
		{
			$this->template->title = [$this->template->title];
		}
		$this->template->title[] = $value;
	}


	public function error404()
	{
		$this->response->status(404);
		$this->set_view('public/404');
	}

}
