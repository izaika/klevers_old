<?php

class Controller_Admin_About extends Controller_Admin_Abstract_Authenticated
{

	const SUBMENU_QUOTE				= 0;
	const SUBMENU_BLOCKS			= 1;
	const SUBMENU_COMPETENCE		= 2;
	const SUBMENU_CREATIVE_PROCESS	= 3;
	const SUBMENU_EMPLOYEES			= 5;
	const SUBMENU_BOTTOM			= 6;


	public function before()
	{
		parent::before();

		if (is_object($this->template)) {
			$this->template->menu_id = self::MENU_ABOUT;
			$this->template->sub_menu = [
				self::SUBMENU_QUOTE => [
					'title'	=> 'Quote',
					'url'	=> 'admin/about'
				],
				self::SUBMENU_BLOCKS => [
					'title'	=> 'Blocks',
					'url'	=> 'admin/about/blocks'
				],
				self::SUBMENU_COMPETENCE => [
					'title'	=> 'Competence',
					'url'	=> 'admin/about/competence'
				],
				self::SUBMENU_CREATIVE_PROCESS => [
					'title'	=> 'Creative process',
					'url'	=> 'admin/about/creative_process'
				],
				self::SUBMENU_EMPLOYEES => [
					'title'	=> 'Employees',
					'url'	=> 'admin/about/employees'
				],
				self::SUBMENU_BOTTOM => [
					'title'	=> 'Bottom block',
					'url'	=> 'admin/about/bottom'
				],
			];
		}
	}


	public function action_index()
	{
	 	$form = new Backend_About_Quote_Form;
 		$this->register_ajax_controller($form);

 		if (is_object($this->view)) {
 			$this->template->sub_menu_id = self::SUBMENU_QUOTE;
 			$this->view->form = $form;
 		}
	}


	public function action_blocks()
	{
	 	$grid = new Backend_About_Blocks_Grid;
 		$this->register_ajax_controller($grid);

 		if (is_object($this->view)) {
 			$this->template->sub_menu_id = self::SUBMENU_BLOCKS;
 			$this->view->grid = $grid;
 		}
	}


	public function action_competence()
	{
	 	$form = new Backend_About_Competence_Form;
 		$this->register_ajax_controller($form);

 		if (is_object($this->view)) {
 			$this->template->sub_menu_id = self::SUBMENU_COMPETENCE;
 			$this->view->form = $form;
 		}
	}


	public function action_creative_process()
	{
	 	$grid = new Backend_About_Cp_Items_Grid;
 		$this->register_ajax_controller($grid);

 		if (is_object($this->view)) {
 			$this->template->sub_menu_id = self::SUBMENU_CREATIVE_PROCESS;
 			$this->view->grid = $grid;
 		}
	}


	public function action_employees()
	{
	 	$grid = new Backend_About_Employees_Grid;
 		$this->register_ajax_controller($grid);

 		if (is_object($this->view)) {
 			$this->template->sub_menu_id = self::SUBMENU_EMPLOYEES;
 			$this->view->grid = $grid;
 		}
	}


	public function action_bottom()
	{
		$form = new Backend_About_Bottom_Form;
		$this->register_ajax_controller($form);

		if (is_object($this->view)) {
			$this->template->sub_menu_id = self::SUBMENU_BOTTOM;
			$this->view->form = $form;
		}
	}
}
