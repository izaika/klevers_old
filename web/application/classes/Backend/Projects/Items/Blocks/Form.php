<?php

class Backend_Projects_Items_Blocks_Form extends AVO_Data_Form
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
				'name'				=> 'size',
				'type'				=> AVO_Field::TYPE_LOOKUP,
				'lookup_datasource'	=> new AVO_Data_Source_Array([
					'dataset'	=> [
						['id' => Model_Project_Block::SIZE_HALF_WIDTH,	'name' => 'Half width'],
						['id' => Model_Project_Block::SIZE_FULL_WIDTH,	'name' => 'Full width'],
					],
				]),
				'lookup_offer_null' => false,
				'width'				=> 400,
				'title'				=> 'Size',
				'validator'			=> new AVO_Validator_Not_Null,
				'class_extension'	=> '{
					onChange: function (e) {
						var form = this.parent();
						var value = form.control("size").formValue();
						if (value == "'.Model_Project_Block::SIZE_FULL_WIDTH.'") {
							$("#side").hide();
						} else {
							$("#side").show();
						}
					}
				}'
			)),
			new AVO_Layout_Control([
				'row_id', 'side'
			]),
			new AVO_Field(array(
				'name'				=> 'side',
				'type'				=> AVO_Field::TYPE_LOOKUP,
				'lookup_datasource'	=> new AVO_Data_Source_Array([
					'dataset'	=> [
						['id' => Model_Project_Block::SIDE_LEFT,	'name' => 'Left'],
						['id' => Model_Project_Block::SIDE_RIGHT,	'name' => 'Right'],
					],
				]),
				'lookup_offer_null' => false,
				'width'				=> 400,
				'title'				=> 'Side',
				'validator'			=> new AVO_Validator_Not_Null,
			)),
			new AVO_Field(array(
				'name'				=> 'type',
				'type'				=> AVO_Field::TYPE_LOOKUP,
				'lookup_datasource'	=> new AVO_Data_Source_Array([
					'dataset'	=> [
						['id' => Model_Project_Block::TYPE_TEXT,	'name' => 'Text'],
						['id' => Model_Project_Block::TYPE_QUOTE,	'name' => 'Quote'],
						['id' => Model_Project_Block::TYPE_CREDITS,	'name' => 'Credits'],
						['id' => Model_Project_Block::TYPE_IMAGE,	'name' => 'Image'],
						['id' => Model_Project_Block::TYPE_VIDEO,	'name' => 'Video'],
					],
				]),
				'lookup_offer_null' => false,
				'width'				=> 400,
				'title'				=> 'Type',
				'validator'			=> new AVO_Validator_Not_Null,
				'class_extension'	=> '{
					onChange: function (e) {
						var form = this.parent();
						var value = form.control("type").formValue();
						switch (value) {
							case "'.Model_Project_Block::TYPE_TEXT.'":
								$(".hint-label").show();
								$("#body_text").show();
								$("#use_in_pdf").show();
								$("#image").hide();
								$("#video_url").hide();
								$("#emb_link").hide();
								break;
							case "'.Model_Project_Block::TYPE_QUOTE.'":
								$(".hint-label").hide();
								$("#body_text").show();
								$("#use_in_pdf").hide();
								$("#image").hide();
								$("#video_url").hide();
								$("#emb_link").hide();
								break;
							case "'.Model_Project_Block::TYPE_CREDITS.'":
								$(".hint-label").hide();
								$("#body_text").show();
								$("#use_in_pdf").show();
								$("#image").hide();
								$("#video_url").hide();
								$("#emb_link").hide();
								break;
							case "'.Model_Project_Block::TYPE_IMAGE.'":
								$(".hint-label").hide();
								$("#body_text").hide();
								$("#use_in_pdf").hide();
								$("#image").show();
								$("#video_url").hide();
								$("#emb_link").hide();
								break;
							case "'.Model_Project_Block::TYPE_VIDEO.'":
								$(".hint-label").hide();
								$("#body_text").hide();
								$("#use_in_pdf").hide();
								$("#image").show();
								$("#video_url").show();
								$("#emb_link").show();
								break;
							default:
								$(".hint-label").show();
								$("#body_text").show();
								$("#use_in_pdf").show();
								$("#image").hide();
								$("#video_url").hide();
								$("#emb_link").hide();
								break;
						}
					}
				}'
			)),
			new AVO_Layout_Control([
				'row_id', 'use_in_pdf'
			]),
			new AVO_Field(array(
				'name'				=> 'use_in_pdf',
				'type'				=> AVO_Field::TYPE_BOOL,
				'width'				=> 400,
				'title'				=> 'Use in PDF?',
			)),
			new AVO_Layout_Control([
				'row_class', 'hint-label'
			]),
			new AVO_Label,
			new AVO_Layout_Control([
				'row_class', 'hint-label'
			]),
			new AVO_Label([
				'value' => 'To add linebreak press SHIFT + ENTER.<br>To create new paragraph press ENTER.<br>Add *split* into the text to break it into two columns in PDF.<br>Make sure *split* stands alone in the paragraph.<br>Make sure you have only one *split* in the text.',
				'encoded' => true]),
			new AVO_Layout_Control([
				'row_id', 'body_text'
			]),
			new Backend_Field_Body_Text,
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
					'model'					=> 'Model_Project_Block',
					'upload_variable_name'	=> '_fu_project_column_block_image',
					'note'					=> '',
				]),
			AVO_Layout_Control::end_layout(),
			new AVO_Layout_Control([
				'row_id', 'video_url'
			]),
			new AVO_Field([
				'name'				=> 'video_url',
				'type'				=> AVO_Field::TYPE_STRING,
				'width'				=> 400,
				'max_length'		=> 512,
				'title'				=> 'URL to video .mp4 file (seamless video)',
				'validator'			=> new AVO_Validator_Not_Null,
			]),
			new AVO_Layout_Control([
				'row_id', 'emb_link'
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
				'name'			=> 'project_id',
				'type'			=> AVO_Field::TYPE_INT,
			]),
		]);

		$this->class_extension = '{
			layout: new AVO.Grid_Layout({columns: 2}),
		}';
	}

	public function on_validate(AVO_Data_Form_Action_Result $result)
	{
		switch ($this->controls->type->value()) {
			case Model_Project_Block::TYPE_IMAGE:
				$this->controls->body_text->validator			= null;
				$this->controls->video_url->validator			= null;
				$this->controls->embedded_video_link->validator = null;
				break;
			case Model_Project_Block::TYPE_VIDEO:
				$this->controls->body_text->validator			= null;
				break;
			default:
				$this->image_fs->disable_validation();
				$this->controls->video_url->validator			= null;
				$this->controls->embedded_video_link->validator	= null;
				break;
		}

		if ($this->controls->size->value() == Model_Project_Block::SIZE_FULL_WIDTH) {
			$this->controls->side->validator = null;
		}

		$validation = parent::on_validate($result);
		// if current block is on the right side
		if ($this->controls->size->value() == Model_Project_Block::SIZE_HALF_WIDTH && $this->controls->side->value == Model_Project_Block::SIDE_RIGHT) {
			$block = Model_Project_Block::factory(null, $this->controls->id->value());
			$project = Model_Project::factory(null, $this->parameters->project_id->value());
			if ($block->loaded()) {
				// block is already saved
				// find previous block
				$previous_block = $project->blocks
					->where('ord', '<=', $block->ord)
					->and_where('id', '<>', $block->id)
					->order_by('ord', 'DESC')
					->order_by('id', 'DESC')
					->find();
				if ($previous_block->loaded()) {
					// check if previous block is not wide
					if ($previous_block->size == Model_Project_Block::SIZE_FULL_WIDTH) {
						// GENERATE ERROR
						$validation[] = ['side', 'Left column should be filled first. 1'];
					}
				} else {
					// current block is first
					// GENERATE ERROR
					$validation[] = ['side', 'Left column should be filled first. 2'];
				}
			} else {
				// block is new
				// find latest block
				$latest_block = $project->blocks
					->order_by('ord', 'DESC')
					->order_by('id', 'DESC')
					->find();
				if ($latest_block->loaded()) {
					// check if last block is not wide
					if ($latest_block->size == Model_Project_Block::SIZE_FULL_WIDTH) {
						// GENERATE ERROR
						$validation[] = ['side', 'Left column should be filled first. 3'];
					}
				} else {
					// current block is first
					// GENERATE ERROR
					$validation[] = ['side', 'Left column should be filled first. 4'.$project->id];
				}
			}
		}





		return $validation;
	}
}
