<?php

class Backend_Home_Projects_Form extends AVO_Data_Form
{


	public $image_fs;


	public function __construct()
	{
		parent::__construct();

		$this->title_class = 'ico32 ico32-picture_dawn';
		$this->title = ['add new project', 'edit project'];
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
			new AVO_Field([
				'name'				=> 'project_id',
				'type'				=> AVO_Field::TYPE_LOOKUP,
				'title'				=> 'Project',
				'width'				=> 400,
				'lookup_offer_null'	=> false,
				'on_get_lookup_datasource' => [$this, 'get_projects'],
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
	}


	public function get_projects() {
		$project_id = (int) $this->controls->project_id->value();
		return new AVO_Data_Source_DB([
			'select_query'	=> "SELECT p.id, p.heading AS name
								FROM projects p
								WHERE p.is_new = 0
								AND p.is_online = 1
								AND p.id NOT IN(SELECT project_id FROM homeprojects)
								OR p.id = $project_id
								ORDER BY p.ord ASC",
			'find_query'	=> 'SELECT id, heading AS name FROM projects WHERE id = :id'
		]);
	}
}
