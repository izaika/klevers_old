<?php

class Controller_Admin_Home extends Controller_Admin_Abstract_Authenticated
{

	const SUBMENU_SLIDESHOW	= 0;
	// const SUBMENU_PROJECTS	= 1;
	// const SUBMENU_ABOUT		= 2;


	public function before()
	{
		parent::before();

		if (is_object($this->template)) {
			$this->template->menu_id = self::MENU_HOME;
			$this->template->sub_menu = [
				self::SUBMENU_SLIDESHOW => [
					'title'	=> 'Slideshow',
					'url'	=> 'admin/home'
				],
				// self::SUBMENU_PROJECTS => [
				// 	'title'	=> 'Projects',
				// 	'url'	=> 'admin/home/projects'
				// ],
				// self::SUBMENU_ABOUT => [
				// 	'title'	=> 'About',
				// 	'url'	=> 'admin/home/about'
				// ],
			];
		}
	}


	public function action_index()
	{
	 	$grid = new Backend_Home_Slideshow_Grid;
 		$this->register_ajax_controller($grid);

 		if (is_object($this->view)) {
 			$this->template->sub_menu_id = self::SUBMENU_SLIDESHOW;
 			$this->view->grid = $grid;
 		}
	}


	// public function action_projects()
	// {
	//  	$grid = new Backend_Home_Projects_Grid;
 // 		$this->register_ajax_controller($grid);
	//
 // 		if (is_object($this->view)) {
 // 			$this->template->sub_menu_id = self::SUBMENU_PROJECTS;
 // 			$this->view->grid = $grid;
 // 		}
	// }
	//
	//
	// public function action_about()
	// {
	//  	$form = new Backend_Home_About_Form;
 // 		$this->register_ajax_controller($form);
	//
 // 		if (is_object($this->view)) {
 // 			$this->template->sub_menu_id = self::SUBMENU_ABOUT;
 // 			$this->view->form = $form;
 // 		}
	// }
}
