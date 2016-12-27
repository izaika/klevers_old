<?php

class Controller_Admin_Blog extends Controller_Admin_Abstract_Authenticated
{

	public function before()
	{
		parent::before();

		if (is_object($this->template)) {
			$this->template->menu_id = self::MENU_BLOG;
		}
	}


	public function action_index()
	{
	 	$grid = new Backend_Articles_Grid;
 		$this->register_ajax_controller($grid);

 		if (is_object($this->view)) {
 			$this->view->grid = $grid;
 		}
	}
}
