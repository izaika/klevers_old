<?php

class Backend_About_Quote_Form extends AVO_Data_Form {

	public function __construct()
	{
		parent::__construct();

		$this->send_data_back_on_save = true;
		$this->title = 'Quote';
		$this->datasource = Model_Variable::get_datasource(
			'about_quote'
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
				'name'			=> 'about_quote',
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

	public function after_save(AVO_Data_Form_Action_Result $result) {
		parent::after_save($result);

		Appsearch::add_document(AppSearch::open_index(AppSearch::INDEX_GENERAL), Model_Homeslide::factory(null, 0), Appsearch::INDEX_GENERAL, [
			['name'	=> 'name',			'type' => 'unIndexed',	'value' => 'Om oss'								],
			['name'	=> 'text_value',	'type' => 'unStored',	'value' => $this->controls->about_quote->value()],
			['name'	=> 'url',			'type' => 'unIndexed',	'value' => '/om-oss'							],
			['name'	=> 'is_online',		'type' => 'unIndexed',	'value' => 1									],
		], 'about_quote');
	}
}
