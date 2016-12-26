<?php

class Controller_Admin_Categories extends Controller_Admin_Abstract_Authenticated
{

	const SUBMENU_CATEGORIES	= 0;
	const SUBMENU_PDF			= 1;

	public function before()
	{
		parent::before();

		if (is_object($this->template)) {
			$this->template->menu_id = self::MENU_CATEGORIES;
			$this->template->sub_menu = [
				self::SUBMENU_CATEGORIES => [
					'title'	=> 'Categories',
					'url'	=> 'admin/categories'
				],
				self::SUBMENU_PDF => [
					'title'	=> 'Last ned alle kompetansebevis PDF',
					'url'	=> 'admin/categories/pdf'
				],
			];
		}
	}


	public function action_index()
	{
	 	$grid = new Backend_Categories_Grid;
 		$this->register_ajax_controller($grid);

 		if (is_object($this->view)) {
			$this->template->sub_menu_id = self::SUBMENU_CATEGORIES;
 			$this->view->grid = $grid;
 		}
	}


	public function action_pdf()
	{
	 	$form = new Backend_Categories_Pdf_Form;
 		$this->register_ajax_controller($form);

 		if (is_object($this->view)) {
			$this->template->sub_menu_id = self::SUBMENU_PDF;
 			$this->view->form = $form;
 		}
	}
}
