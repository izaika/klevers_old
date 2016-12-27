<?php

class Backend_About_Employees_Form extends AVO_Data_Form
{
	public function __construct()
	{
		parent::__construct();

		$this->title_class = 'ico32 ico32-picture_dawn';
		$this->title = ['Add new employee', 'Edit employee'];
		$this->close_button_title = __('Back');
		$this->clear_cache = true;

		$this->controls = new AVO_Controls_List([
			new AVO_Field([
				'name'			=> 'id',
				'type'			=> AVO_Field::TYPE_INT,
				'key'			=> true,
				'hidden'		=> true,
			]),
			new AVO_Layout_Control([
				'colspan',	'2',
				'layout',	'new AVO.Grid_Layout({columns: 1})'
			]),
				new Backend_Image_Upload_Field_Set([
					'title'					=> 'Image',
					'model'					=> 'Model_Employee',
					'upload_variable_name'	=> '_fu_employee_image',
					'note'					=> '',
				]),
			AVO_Layout_Control::end_layout(),
			new AVO_Field([
				'name'			=> 'name',
				'title'			=> 'Name',
				'type'			=> AVO_Field::TYPE_STRING,
				'width'			=> 400,
				'max_length'	=> 256,
				'validator'		=> new AVO_Validator_Not_Null,
			]),
			new Backend_Field_Body_Text([
				'name'			=> 'info',
				'title'			=> 'Info',
				'max_length'	=> 700,
				'height'		=> 100
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

		$employee = new Model_Employee($this->controls->id->value());
		if ($employee->loaded()) {
			Appsearch::add_document(AppSearch::open_index(AppSearch::INDEX_GENERAL), $employee, Appsearch::INDEX_GENERAL);
		}
	}
}
