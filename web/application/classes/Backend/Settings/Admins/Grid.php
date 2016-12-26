<?php defined('SYSPATH') OR die('No direct script access.');

class Backend_Settings_Admins_Grid extends AVO_Data_Grid {

	public function __construct()
	{
		parent::__construct();

		$this->datasource = new Backend_Settings_Admins_Datasource();

		$edit_form = new Backend_Settings_Admins_Form();
		$edit_form->datasource = $this->datasource;
		$this->forms = array(
			'edit_form'	=> $edit_form
		);

		$this->fields = new AVO_Controls_List(array(
			new AVO_Field(array(
				'name'			=> 'no',
				'type'			=> AVO_Field::TYPE_INT,
				'width'			=> 40,
				'title'			=> __('#'),
				'calculated'	=> TRUE,
				'function'		=> 'ds_abspos',
			)),
			new AVO_Field(array(
				'name'			=> 'id',
				'type'			=> AVO_Field::TYPE_INT,
				'key'			=> TRUE,
				'width'			=> 40,
				'title'			=> __('id'),
			)),
			new AVO_Field(array(
				'name'			=> 'login',
				'type'			=> AVO_Field::TYPE_STRING,
				'title'			=> __('login'),
			)),
			new AVO_Field(array(
				'name'			=> 'full_name',
				'type'			=> AVO_Field::TYPE_STRING,
				'title'			=> __('name')
			)),
			new AVO_Field(array(
				'name'			=> 'email',
				'type'			=> AVO_Field::TYPE_STRING,
				'title'			=> __('email')
			)),
		));
	}

}
