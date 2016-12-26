<?php

class Backend_Home_Slideshow_Form extends AVO_Data_Form
{


	public $image_fs;


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
			new AVO_Field(array(
				'name'				=> 'link_type',
				'type'				=> AVO_Field::TYPE_LOOKUP,
				'lookup_datasource'	=> new AVO_Data_Source_Array([
					'dataset'	=> [
						['id' => Model_Homeslide::LINK_TYPE_NONE,		'name' => 'None'],
						['id' => Model_Homeslide::LINK_TYPE_PROJECT,	'name' => 'Internal project'],
						['id' => Model_Homeslide::LINK_TYPE_EXTERNAL,	'name' => 'External'],
					],
				]),
				'lookup_offer_null' => false,
				'width'				=> 400,
				'title'				=> 'Link type',
				'validator'			=> new AVO_Validator_Not_Null,
				'class_extension'	=> '{
					onChange: function (e) {
						var form = this.parent();
						var value = form.control("link_type").formValue();
						switch (value) {
							case "'.Model_Homeslide::LINK_TYPE_PROJECT.'":
								$("#project_id").show();
								$("#image").hide();
								$("#url").hide();
								$("#heading").hide();
								$("#subheading").hide();
								$("#open_link_in_new_window").hide();
								break;
							case "'.Model_Homeslide::LINK_TYPE_EXTERNAL.'":
								$("#project_id").hide();
								$("#image").show();
								$("#url").show();
								$("#heading").show();
								$("#subheading").show();
								$("#open_link_in_new_window").show();
								break;
							default:
								$("#project_id").hide();
								$("#image").show();
								$("#url").hide();
								$("#heading").show();
								$("#subheading").show();
								$("#open_link_in_new_window").hide();
								break;
						}
					}
				}'
			)),
			new AVO_Layout_Control([
				'row_id', 'project_id'
			]),
			new AVO_Field([
				'name'				=> 'project_id',
				'type'				=> AVO_Field::TYPE_LOOKUP,
				'title'				=> 'Project',
				'width'				=> 400,
				'lookup_offer_null'	=> false,
				'on_get_lookup_datasource' => [$this, 'get_projects'],
				'validator'			=> new AVO_Validator_Not_Null,
			]),
			new AVO_Layout_Control([
				'row_id', 'url'
			]),
			new AVO_Field([
				'name'			=> 'url',
				'title'			=> 'Link URL',
				'type'			=> AVO_Field::TYPE_STRING,
				'width'			=> 400,
				'max_length'	=> 256,
				'validator'		=> new AVO_Validator_Not_Null,
			]),
			new AVO_Layout_Control([
				'row_id', 'open_link_in_new_window'
			]),
			new AVO_Field([
				'name'			=> 'open_link_in_new_window',
				'title'			=> 'Open link in new window?',
				'type'			=> AVO_Field::TYPE_BOOL,
			]),
			new AVO_Layout_Control([
				'row_id', 'heading'
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
				'row_id', 'subheading'
			]),
			new AVO_Field([
				'name'			=> 'subheading',
				'title'			=> 'Subheading',
				'type'			=> AVO_Field::TYPE_STRING,
				'width'			=> 400,
				'max_length'	=> 256,
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
					'model'					=> 'Model_homeslide',
					'upload_variable_name'	=> '_fu_homeslide_image',
					'note'					=> '',
				]),
			AVO_Layout_Control::end_layout(),
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
	}


	public function get_projects() {
		$project_id = (int) $this->controls->project_id->value();
		return new AVO_Data_Source_DB([
			'select_query'	=> "SELECT p.id, p.heading AS name
								FROM projects p
								WHERE p.is_new = 0
								AND p.is_online = 1
								AND p.id NOT IN(SELECT project_id FROM homeslides WHERE link_type = ".Model_Homeslide::LINK_TYPE_PROJECT.")
								OR p.id = $project_id
								ORDER BY p.ord ASC",
			'find_query'	=> 'SELECT id, heading AS name FROM projects WHERE id = :id'
		]);
	}


	public function on_validate(AVO_Data_Form_Action_Result $result)
	{
		switch ($this->controls->link_type->value()) {
			case Model_Homeslide::LINK_TYPE_PROJECT:
				$this->controls->heading->validator 	= null;
				$this->controls->url->validator 		= null;
				$this->image_fs->disable_validation();
				break;
			case Model_Homeslide::LINK_TYPE_EXTERNAL:
				$this->controls->project_id->validator 	= null;
				break;
			default:
				$this->controls->project_id->validator 	= null;
				$this->controls->url->validator 		= null;
				break;
		}

		return parent::on_validate($result);
	}
}
