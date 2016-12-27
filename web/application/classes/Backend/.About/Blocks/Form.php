<?php

class Backend_About_Blocks_Form extends AVO_Data_Form
{
	public $image_fs;


	public function __construct()
	{
		parent::__construct();

		$this->title_class = 'ico32 ico32-picture_dawn';
		$this->title = ['Add new block', 'Edit block'];
		$this->close_button_title = __('Back');
		$this->clear_cache = true;

		$this->controls = new AVO_Controls_List([
			new AVO_Field([
				'name'			=> 'id',
				'type'			=> AVO_Field::TYPE_INT,
				'key'			=> true,
				'hidden'		=> true,
			]),
			new AVO_Field(array(
				'name'				=> 'type',
				'type'				=> AVO_Field::TYPE_LOOKUP,
				'lookup_datasource'	=> new AVO_Data_Source_Array([
					'dataset'	=> [
						['id' => Model_About_Block::TYPE_IMAGE_AND_TEXT,	'name' => 'Image/video with text'],
						['id' => Model_About_Block::TYPE_IMAGE,				'name' => 'Only image/video'],
						['id' => Model_About_Block::TYPE_TEXT,				'name' => 'Only text'],
					],
				]),
				'lookup_offer_null' => false,
				'width'				=> 400,
				'title'				=> 'Type',
				'validator'			=> new AVO_Validator_Not_Null,
				'class_extension'	=> '{
					onChange: function (e) {
						var form = this.parent();
						switch (form.control("type").formValue()) {
							case "'.Model_About_Block::TYPE_IMAGE.'":
								$(".text-input").hide();
								$("#image").show();
								$("#video").show();
								break;
							case "'.Model_About_Block::TYPE_TEXT.'":
								$(".text-input").show();
								$("#image").hide();
								$("#video").hide();
								break;
							default: // Model_About_Block::TYPE_IMAGE_AND_TEXT
								$(".text-input").show();
								$("#image").show();
								$("#video").show();
								break;
						}
					}
				}'
			)),
			new AVO_Layout_Control([
				'row_class', 'text-input'
			]),
			new AVO_Field([
				'name'			=> 'heading',
				'title'			=> 'Heading',
				'type'			=> AVO_Field::TYPE_TEXT,
				'width'			=> 400,
				'max_length'	=> 256,
				'validator'		=> new AVO_Validator_Not_Null,
			]),
			new AVO_Layout_Control([
				'row_class', 'text-input'
			]),
			new AVO_Field([
				'name'			=> 'body_text',
				'title'			=> 'Text',
				'type'			=> AVO_Field::TYPE_TEXT,
				'width'			=> 400,
				'height'		=> 300,
				'max_length'	=> 65535,
				'validator'		=> new AVO_Validator_Not_Null,
			]),
			new AVO_Layout_Control([
				'row_id', 'image'
			]),
			new AVO_Layout_Control([
				'colspan',	'2',
				'layout',	'new AVO.Grid_Layout({columns: 1})'
			]),
				$this->image_fs =
				new Backend_Image_Upload_Field_Set([
					'title'					=> 'Image',
					'model'					=> 'Model_About_Block',
					'upload_variable_name'	=> '_fu_about_block_image',
					'note'					=> '',
				]),
			AVO_Layout_Control::end_layout(),
			new AVO_Layout_Control([
				'row_id', 'video'
			]),
			new AVO_Field(array(
				'name'				=> 'video_url',
				'type'				=> AVO_Field::TYPE_STRING,
				'width'				=> 400,
				'max_length'		=> 512,
				'title'				=> 'URL to video .mp4 file',
			)),
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


	public function on_validate(AVO_Data_Form_Action_Result $result)
	{
		switch ($this->controls->type->value()) {
			case Model_About_Block::TYPE_IMAGE:
				$this->controls->heading->validator = null;
				$this->controls->body_text->validator = null;
				break;
			case Model_About_Block::TYPE_TEXT:
				$this->image_fs->disable_validation();
				break;
		}

		return parent::on_validate($result);
	}


	public function after_save(AVO_Data_Form_Action_Result $result) {
		parent::after_save($result);

		$block = new Model_About_Block($this->controls->id->value());
		if ($block->loaded()) {
			Appsearch::add_document(AppSearch::open_index(AppSearch::INDEX_GENERAL), $block, Appsearch::INDEX_GENERAL);
		}
	}
}
