<?php

class Backend_Articles_Images_Form extends AVO_Data_Form
{

	public function __construct()
	{
		parent::__construct();

		$this->title_class = 'ico32 ico32-picture_dawn';
		$this->title = ['Add new image', 'Edit image'];
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
					'model'					=> 'Model_Article_Image',
					'upload_variable_name'	=> '_fu_article_image',
					'note'					=> '',
				]),
			AVO_Layout_Control::end_layout(),
			new AVO_Field([
				'name'				=> 'use_video',
				'type'				=> AVO_Field::TYPE_BOOL,
				'width'				=> 400,
				'title'				=> 'Use video?',
			]),
			new AVO_Field([
				'name'				=> 'video_url',
				'type'				=> AVO_Field::TYPE_STRING,
				'width'				=> 400,
				'max_length'		=> 512,
				'title'				=> 'URL to video .mp4 file (seamless video)',
				'validator'			=> new AVO_Validator_Not_Null,
			]),
			new AVO_Field([
				'name'				=> 'embedded_video_link',
				'type'				=> AVO_Field::TYPE_STRING,
				'width'				=> 400,
				'max_length'		=> 256,
				'title'				=> 'Vimeo/Youtube link (embedded video)',
				'validator'			=> new AVO_Validator_Not_Null,
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

		$this->parameters = new AVO_Controls_List([
			new AVO_Field([
				'name'			=> 'article_id',
				'type'			=> AVO_Field::TYPE_INT,
			]),
		]);

		$this->class_extension = '{
			layout: new AVO.Grid_Layout({columns: 2}),
		}';
	}


	public function on_validate(AVO_Data_Form_Action_Result $result)
	{
		if (!$this->controls->use_video->value()) {
			$this->controls->video_url->validator			= null;
			$this->controls->embedded_video_link->validator	= null;
		}
		return parent::on_validate($result);
	}
}
