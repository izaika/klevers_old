<?php

use Dompdf\Dompdf;

class Controller_Public extends Controller_Abstract_Public
{

	public function before()
	{
		parent::before();
	}

// SPLASH
	public function action_index()
	{
		$this->set_view($this->module.'/index');

		$this->template->seo_title			= Model_Variable::value_by_name('global_title', true);
		$this->template->seo_keywords		= Model_Variable::value_by_name('global_keywords', true);
		$this->template->seo_description	= Model_Variable::value_by_name('global_description', true);

		$this->view->slides	= Model_Homeslide::factory()->cached()->find_all();
		View::set_global('active_page', 'index');
	}



	/**
	 * @nosession
	 */
	public function action_http404()
	{
		$this->set_view($this->module.'/404');
	}
}
