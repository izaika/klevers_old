<?php defined('SYSPATH') OR die('No direct script access.');

abstract class Controller_Admin_Abstract_Authenticated extends Controller_Admin_Abstract {

	const MENU_HOME			= 1;
	const MENU_PROJECTS		= 2;
	const MENU_ABOUT		= 3;
	const MENU_BLOG			= 4;
	const MENU_CONTACT		= 5;
	const MENU_CATEGORIES	= 6;
	const MENU_SETTINGS		= 100;


	public function before()
	{
		parent::before();

		$this->admin = new Model_Administrator((int) $this->session->get('admin:user_id'));

		if (!$this->is_admin()) {
			$this->request->avo_redirect('admin/auth', [
				'perform_action'	=> 'doc_reload',
				'status'			=> 1,
				'message'			=> __('Access denied'),
			]);
		}

		if (is_object($this->template)) {
			$this->template->is_admin = true;
			$this->template->username = $this->admin->full_name;

			$this->template->menu = [
				self::MENU_HOME => [
					'title'	=> 'Home',
					'url'	=> 'admin/home'
				],
				self::MENU_PROJECTS => [
					'title'	=> 'Projects',
					'url'	=> 'admin/projects'
				],
				self::MENU_ABOUT => [
					'title'	=> 'About',
					'url'	=> 'admin/about'
				],
				self::MENU_BLOG => [
					'title'	=> 'Blog',
					'url'	=> 'admin/blog'
				],
				self::MENU_CONTACT => [
					'title'	=> 'Contact',
					'url'	=> 'admin/contact'
				],
				self::MENU_CATEGORIES => [
					'title'	=> 'Categories',
					'url'	=> 'admin/categories'
				],
				self::MENU_SETTINGS => [
					'title'	=> __('Settings'),
					'url'	=> 'admin/settings'
				],
			];
			$this->template->sub_menu = null;
			$this->template->menu_id = 0;
			$this->template->sub_menu_id = 0;
		}
	}

}
