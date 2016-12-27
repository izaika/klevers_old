<?php

class Backend_Home_About_Form extends AVO_Data_Form {

	public function __construct()
	{
		parent::__construct();

		$this->send_data_back_on_save = true;
		$this->title = 'About';
		$this->datasource = Model_Variable::get_datasource(
			'homepage_quote'
		);
		$this->clear_cache = true;

		$this->controls = new AVO_Controls_List([
			new AVO_Field([
				'name'			=> 'id',
				'type'			=> AVO_Field::TYPE_INT,
				'hidden'		=> true,
				'key'			=> true,
				'fixed_value'	=> 1,
			]),

			new AVO_Field([
				'name'			=> 'homepage_quote',
				'title'			=> 'Quote',
				'type'			=> AVO_Field::TYPE_TEXT,
				'width'			=> 400,
				'height'		=> 100,
				'max_length'	=> 255,
				'validator'		=> new AVO_Validator_Not_Null,
			]),

			new AVO_Label(),
			new AVO_Layout_Control(['align', 'right']),
			AVO_Button::standard(AVO_Button::STD_SAVE),
		]);
	}

}
