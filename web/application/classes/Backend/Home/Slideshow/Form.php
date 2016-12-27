<?php

class Backend_Home_Slideshow_Form extends AVO_Data_Form
{

	public function __construct()
	{
		parent::__construct();

		$this->title_class = 'ico32 ico32-picture_dawn';
		$this->title = ['add new slide', 'edit slide'];
		$this->close_button_title = 'back';
		$this->class_extension = '{ framed_box: false }';
		$this->clear_cache = true;

		$this->controls = new AVO_Controls_List([
			new AVO_Field([
				'name'			=> 'id',
				'type'			=> AVO_Field::TYPE_INT,
				'key'			=> true,
				'hidden'		=> true,
			]),
			new AVO_Layout_Control([
				'row_id', 'image'
			]),
			new AVO_Layout_Control([
				'colspan',	'2',
				'layout',	'new AVO.Grid_Layout({columns: 1})'
			]),
				new Backend_Image_Upload_Field_Set([
					'title'					=> 'Image',
					'model'					=> 'Model_homeslide',
					'upload_variable_name'	=> '_fu_homeslide_image',
					'note'					=> '',
				]),
			AVO_Layout_Control::end_layout(),
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
	}
}
