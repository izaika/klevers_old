<?php defined('SYSPATH') OR die('No direct script access.');

abstract class Controller_Admin_Abstract extends AVO_Controller {

	const RESOURCE_SERIAL = 0;

	/**
	 * Administrator
	 * @var Model_Administrator
	 */
	public $admin;

	public function before()
	{
		$this->module = 'admin';
		parent::before();

		if (is_object($this->template))
		{
			$this->template->is_admin = FALSE;
			$this->template->show_header = TRUE;

			$this->add_js_script('js/admin.js');
			// define the common styles
			$this->add_stylesheet(array('url' => 'css/admin/style.'.self::RESOURCE_SERIAL.'.css'));
			$this->add_stylesheet(array('url' => 'css/admin/jquery-ui-1.10.4.custom/css/cupertino/jquery-ui-1.10.4.custom.min.css'));

			$this->use_client_library(
				'modernizr', 'jquery', 'fancybox',
				'jquery-ui', 'jquery-ui-timepicker',
				'jquery-dataSelector',
				'bootstrap',  'tinymce', 'fileuploader', 'avo'
			);

		}
	}

	public function is_admin()
	{
		return ($this->admin AND $this->admin->loaded());
	}


	public function after()
	{
		parent::after();
		if (Kohana::$environment == Kohana::DEVELOPMENT && class_exists('ProfilerToolbar')) ProfilerToolbar::firebug();
	}

}
