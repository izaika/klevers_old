<?php

class Backend_Home_Projects_Grid extends AVO_Data_Grid
{

	public function __construct()
	{
		parent::__construct();

		$this->clear_cache = true;

		$edit_form = new Backend_Home_Projects_Form;
		$edit_form->datasource = $this->datasource = new AVO_Data_Source_DB([
			'count_query'		=> 'SELECT COUNT(*) FROM homeprojects',
			'select_query'		=> 'SELECT * FROM homeprojects ORDER BY ord',
			'find_query'		=> 'SELECT * FROM homeprojects WHERE id = :id',
			'delete_query'		=> 'DELETE FROM homeprojects WHERE id = :id',

			'update_query'		=> '
				UPDATE homeprojects
				SET
					project_id = :project_id
				WHERE
					id = :id',

			'insert_query'	=>
				'INSERT INTO homeprojects (
						ord,
						project_id
					)
					VALUES
					(
						(SELECT * FROM (SELECT IFNULL(MIN(ord), 0) - 1 FROM homeprojects) assets_ord),
						:project_id
					)',

			'move_parameters'	=> [
				'table'			=> 'homeprojects',
				'where'			=> 'id IS NOT NULL',
				'order_by'		=> 'ord'
			],

			'on_calc_parameter'	=> [$this, 'on_calc_data_source_parameter'],

			'model_class_name'	=> 'Model_Homeproject',
		]);

		$this->forms = ['edit_form'	=> $edit_form];

		$this->height = 340;
		$this->width = 745;

		$this->fields = new AVO_Controls_List([
			AVO_Field::std_drag_field(),
			new AVO_Field([
				'name'			=> 'no',
				'type'			=> AVO_Field::TYPE_INT,
				'width'			=> 40,
				'title'			=> '#',
				'calculated'	=> true,
				'function'		=> 'ds_abspos',
				'sortable'		=> false,
			]),
			new AVO_Field([
				'name'			=> 'id',
				'type'			=> AVO_Field::TYPE_INT,
				'key'			=> true,
				'hidden'		=> true,
				'sortable'		=> false,
			]),
			new AVO_Field([
				'name'			=> 'project_id',
				'type'			=> AVO_Field::TYPE_INT,
				'hidden'		=> true,
				'sortable'		=> false,
			]),
			new AVO_Field([
				'name'			=> 'preview',
				'type'			=> AVO_Field::TYPE_STRING,
				'encoded'		=> true,
				'title'			=> 'Image',
				'width'			=> Model_Project::GRID_PREVIEW_W,
				'calculated'	=> true,
			]),
			new AVO_Field([
				'name'			=> 'heading',
				'type'			=> AVO_Field::TYPE_STRING,
				'title'			=> 'Heading',
				'sortable'		=> false,
				'calculated'	=> true,
			]),
			new AVO_Field([
				'name'			=> 'subheading',
				'type'			=> AVO_Field::TYPE_STRING,
				'title'			=> 'Subheading',
				'sortable'		=> false,
				'calculated'	=> true,
			]),
			new AVO_Field([
				'name'			=> 'warning',
				'type'			=> AVO_Field::TYPE_STRING,
				'title'			=> 'Warning field',
				'sortable'		=> false,
				'encoded'		=> true,
				'calculated'	=> true,
				'html_class'	=> 'warning_field',
				'width'			=> 200
			]),
		]);
	}

	public function on_calc()
	{
		$item 		= new Model_Homeproject($this->fields->id->value());
		$project_id = $this->fields->project_id->value;
		$project 	= new Model_Project($project_id);
		$this->fields->warning->value('');
		if ($project->loaded()) {
			if ($project->preview_uid) {
				$preview_obj = new Model_Project_Preview($project->id);
				$this->fields->preview->value($preview_obj->grid_preview_link());
			} else {
				$this->fields->preview->value($project->grid_preview_link());
			}
			$this->fields->heading->value($project->heading);
			$this->fields->subheading->value($project->name);
			if (!$project->is_online) {
				$this->fields->warning->value('Linked project is offline!');
			}
		}
	}
}

















