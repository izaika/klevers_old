<?php

class Backend_Settings_General_Form extends AVO_Data_Form {

	public function __construct()
	{
		parent::__construct();

		$this->send_data_back_on_save = true;
		$this->title_class = 'ico32 ico32-tools';
		$this->title = __('Links');
		$this->datasource = Model_Variable::get_datasource(
			'facebook_url',
			'instagram_url',
			'linkedin_url'
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
				'name'			=> 'facebook_url',
				'title'			=> 'Facebook URL',
				'type'			=> AVO_Field::TYPE_STRING,
				'width'			=> 400,
				'max_length'	=> 255,
				'validator'		=> new AVO_Validator_Not_Null,
			]),
			new AVO_Field([
				'name'			=> 'instagram_url',
				'title'			=> 'Instagram URL',
				'type'			=> AVO_Field::TYPE_STRING,
				'width'			=> 400,
				'max_length'	=> 255,
				'validator'		=> new AVO_Validator_Not_Null,
			]),
			new AVO_Field([
				'name'			=> 'linkedin_url',
				'title'			=> 'Linkedin URL',
				'type'			=> AVO_Field::TYPE_STRING,
				'width'			=> 400,
				'max_length'	=> 255,
				'validator'		=> new AVO_Validator_Not_Null,
			]),
			new AVO_Label(),
			new AVO_Layout_Control(['align', 'right']),
			AVO_Button::standard(AVO_Button::STD_SAVE),
		]);
	}

}
