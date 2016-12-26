<?php defined('SYSPATH') OR die('No direct script access.');

class Controller_Admin_Auth extends Controller_Admin_Abstract {

	/**
	 * Default (index) action handler.
	 * Processes the administrator authentication
	 *
	 */
	public function action_index()
	{
		$form = new Backend_Auth_Login_Form();
		$this->register_ajax_controller($form);

		if (is_object($this->view))
		{
			$this->view->form = $form;
		}
	}


	/**
	 * Remind action handler.
	 * Manages the remind-my-password request form
	 *
	 */
	public function action_remind()
	{
		$form = new Backend_Auth_Remind_Password_Form();
		$this->register_ajax_controller($form);

		if (is_object($this->view))
		{
			$this->view->from = $form;
		}
	}


	/**
	 * Quit action handler.
	 * Quits the administrator out of the admin panel
	 *
	 */
	public function action_quit()
	{
		$this->session->set('admin:user_id', null);
		$this->request->avo_redirect('admin/auth');
	}

}
