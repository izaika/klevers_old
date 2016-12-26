<?php

class Backend_Contact_Form extends AVO_Data_Form {

	public function __construct()
	{
		parent::__construct();

		$this->send_data_back_on_save = true;
		$this->title = 'Contact';
		$this->datasource = Model_Variable::get_datasource(
			'contact_phone',
			'contact_email'
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
				'name'			=> 'contact_phone',
				'title'			=> 'Phone',
				'type'			=> AVO_Field::TYPE_STRING,
				'width'			=> 400,
				'max_length'	=> 255,
				'validator'		=> new AVO_Validator_Not_Null,
			]),
			new AVO_Field([
				'name'			=> 'contact_email',
				'title'			=> 'E-mail',
				'type'			=> AVO_Field::TYPE_STRING,
				'width'			=> 400,
				'max_length'	=> 255,
				'validator'		=> [new AVO_Validator_Not_Null, new AVO_Validator_Email]
			]),

			new AVO_Label(),
			new AVO_Layout_Control(['align', 'right']),
			AVO_Button::standard(AVO_Button::STD_SAVE),
		]);
	}

}
