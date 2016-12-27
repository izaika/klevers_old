<?php

class Backend_About_Cp_Items_Form extends AVO_Data_Form
{

	public function __construct()
	{
		parent::__construct();

		$this->title_class = 'ico32 ico32-picture_dawn';
		$this->title = ['Add new item', 'Edit item'];
		$this->close_button_title = __('Back');
		$this->clear_cache = true;

		$this->controls = new AVO_Controls_List([
			new AVO_Field([
				'name'			=> 'id',
				'type'			=> AVO_Field::TYPE_INT,
				'key'			=> true,
				'hidden'		=> true,
			]),

			new AVO_Field([
				'name'			=> 'num',
				'title'			=> 'Number',
				'type'			=> AVO_Field::TYPE_STRING,
				'width'			=> 400,
				'max_length'	=> 5,
				'validator'		=> new AVO_Validator_Not_Null,
			]),
			new AVO_Field([
				'name'			=> 'heading',
				'title'			=> 'Heading',
				'type'			=> AVO_Field::TYPE_STRING,
				'width'			=> 400,
				'max_length'	=> 256,
				'validator'		=> new AVO_Validator_Not_Null,
			]),
			new AVO_Field([
				'name'			=> 'short_text',
				'title'			=> 'Text',
				'type'			=> AVO_Field::TYPE_TEXT,
				'width'			=> 400,
				'height'		=> 100,
				'max_length'	=> 700,
				'validator'		=> new AVO_Validator_Not_Null,
			]),
			new AVO_Label,
			new AVO_Layout_Control([
				'align',	'right',
				'layout',	'new AVO.Horizontal_Layout({padding:4})'
			]),
				AVO_Button::standard(AVO_Button::STD_SAVE),
				new AVO_Layout_Control([
					'style', 'padding-left:30px',
				]),
				AVO_Button::standard(AVO_Button::STD_CANCEL),
			AVO_Layout_Control::end_layout(),
		]);

		$this->class_extension = '{
			layout: new AVO.Grid_Layout({columns: 2}),
		}';
	}


	public function after_save(AVO_Data_Form_Action_Result $result) {
		parent::after_save($result);

		$cp = new Model_Cp_Item($this->controls->id->value());
		if ($cp->loaded()) {
			Appsearch::add_document(AppSearch::open_index(AppSearch::INDEX_GENERAL), $cp, Appsearch::INDEX_GENERAL);
		}
	}
}
