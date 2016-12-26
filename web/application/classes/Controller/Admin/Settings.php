<?php defined('SYSPATH') OR die('No direct script access.');

class Controller_Admin_Settings extends Controller_Admin_Abstract_Authenticated {

	const SUBMENU_GENERAL			= 0;
	const SUBMENU_SEO				= 1;
	const SUBMENU_EMAIL_TEMPLATES	= 2;
	const SUBMENU_ADMIN_USERS		= 3;


	public function before()
	{
		parent::before();

		if (is_object($this->template))
		{
			$this->template->menu_id = self::MENU_SETTINGS;
			$this->template->sub_menu = array(
				self::SUBMENU_GENERAL => array(
					'title'	=> __('Links'),
					'url'	=> 'admin/settings'
				),
				self::SUBMENU_SEO => array(
					'title'	=> __('SEO'),
					'url'	=> 'admin/settings/seo'
				),
				self::SUBMENU_EMAIL_TEMPLATES => array(
					'title'	=> __('email templates'),
					'url'	=> 'admin/settings/emails'
				),
				self::SUBMENU_ADMIN_USERS => array(
					'title'	=> __('administrative accounts'),
					'url'	=> 'admin/settings/admin_users'
				),
			);
		}
	}


	/**
	 * Default (index) action handler.
	 * Processes the calls to the general application settings
	 *
	 */
	public function action_index()
	{
		$form = new Backend_Settings_General_Form();
		$this->register_ajax_controller($form);

		if (is_object($this->view))
		{
			$this->template->sub_menu_id = self::SUBMENU_GENERAL;
			$this->view->form = $form;
		}
	}


	public function action_seo()
	{
		$form = new Backend_Settings_Seo_Form();
		$this->register_ajax_controller($form);

		if (is_object($this->view))
		{
			$this->template->sub_menu_id = self::SUBMENU_SEO;
			$this->view->form = $form;
		}
	}


	/**
	 * admin_users action handler.
	 * Manages the administrative accounts
	 *
	 */
	public function action_admin_users()
	{
		$grid = new Backend_Settings_Admins_Grid();
		$this->register_ajax_controller($grid);

		if (is_object($this->view))
		{
			$this->template->sub_menu_id = self::SUBMENU_ADMIN_USERS;
			$this->view->grid = $grid;
		}
	}


	/**
	 * admin_profile action handler.
	 * Manages the current administrative account
	 *
	 */
	public function action_admin_profile()
	{
		$form = new Backend_Settings_Admins_Profile_Form($this->admin->id);
		$this->register_ajax_controller($form);

		if (is_object($this->view))
		{
			$this->template->sub_menu_id = self::SUBMENU_ADMIN_USERS;
			$this->view->form = $form;
		}
	}


	/**
	 * emails action handler.
	 * Manages the email templates
	 *
	 */
	public function action_emails()
	{
		$form = new Backend_Settings_Message_Template_Form();
		$this->register_ajax_controller($form);

		if (is_object($this->view))
		{
			$this->template->sub_menu_id = self::SUBMENU_EMAIL_TEMPLATES;
			$this->template->scripts[] = 'lib/jstree_pre1/jquery.jstree.js';
			$this->view->form = $form;

			// email templates list
			$ds_templates = DB::query(Database::SELECT, 'SELECT id, group_title, title FROM message_templates ORDER BY group_title, id')->execute();
			$data = array();
			$current_group = NULL;
			$current_group_title = NULL;
			foreach ($ds_templates as $row)
			{
				if ($current_group_title != $row['group_title'])
				{
					$data[] = array(
						'data' => $row['group_title'],
						'attr'	=> array('rel' => 'root'),
						'state' => count($data) ? 'closed' : 'open',
						'children' => array()
					);
					$current_group = &$data[count($data) - 1];
					$current_group_title = $row['group_title'];
				}
				$current_group['children'][] = array(
					'data' => $row['title'],
					'metadata' => array('id' => $row['id']),
				);
			}

			$this->view->tree_data = $data;
		}
	}

}
