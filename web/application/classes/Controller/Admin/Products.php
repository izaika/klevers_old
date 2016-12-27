<?php

class Controller_Admin_Products extends Controller_Admin_Abstract_Authenticated
{

	const SUBMENU_CATEGORIES	= 0;
	const SUBMENU_PRODUCTS		= 1;

	public function before()
	{
		parent::before();

		if (is_object($this->template)) {
			$this->template->menu_id = self::MENU_PRODUCTS;
			$this->template->sub_menu = [
				self::SUBMENU_CATEGORIES => [
					'title'	=> 'Categories',
					'url'	=> 'admin/products'
				],
				self::SUBMENU_PRODUCTS => [
					'title'	=> 'Products',
					'url'	=> 'admin/products/categories'
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
}
