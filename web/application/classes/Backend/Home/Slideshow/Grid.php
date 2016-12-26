<?php

class Backend_Home_Slideshow_Grid extends AVO_Data_Grid
{

	public function __construct()
	{
		parent::__construct();

		$this->clear_cache = true;

		$edit_form = new Backend_Home_Slideshow_Form;
		$edit_form->datasource = $this->datasource = new AVO_Data_Source_DB([
			'count_query'		=> 'SELECT COUNT(*) FROM homeslides',
			'select_query'		=> 'SELECT * FROM homeslides ORDER BY ord',
			'find_query'		=> 'SELECT * FROM homeslides WHERE id = :id',
			'delete_query'		=> 'DELETE FROM homeslides WHERE id = :id',

			'update_query'		=> '
				UPDATE homeslides
				SET
					project_id				= :project_id,
					link_type				= :link_type,
					heading					= :heading,
					subheading				= :subheading,
					video_url				= :video_url,
					url						= :url,
					open_link_in_new_window	= :open_link_in_new_window
				WHERE
					id = :id',

			'insert_query'	=>
				'INSERT INTO homeslides (
						ord,
						project_id,
						link_type,
						heading,
						subheading,
						video_url,
						url,
						open_link_in_new_window
					)
					VALUES
					(
						(SELECT * FROM (SELECT IFNULL(MIN(ord), 0) - 1 FROM homeslides) assets_ord),
						:project_id,
						:link_type,
						:heading,
						:subheading,
						:video_url,
						:url,
						:open_link_in_new_window
					)',

			'move_parameters'	=> [
				'table'			=> 'homeslides',
				'where'			=> 'id IS NOT NULL',
				'order_by'		=> 'ord'
			],

			'on_calc_parameter'	=> [$this, 'on_calc_data_source_parameter'],

			'model_class_name'	=> 'Model_Homeslide',
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
				'calculated'	=> true,
			]),
			new AVO_Field([
				'name'			=> 'video_url',
				'type'			=> AVO_Field::TYPE_STRING,
				'width'			=> 400,
				'title'			=> 'URL to video .mp4 file',
				'sortable'		=> false,
			]),
			new AVO_Field([
				'name'			=> 'link_type',
				'type'			=> AVO_Field::TYPE_STRING,
				'title'			=> 'Link type',
				'sortable'		=> false,
				'hidden'		=> true,
			]),
			new AVO_Field([
				'name'			=> 'public_link_type',
				'type'			=> AVO_Field::TYPE_STRING,
				'title'			=> 'Link type',
				'sortable'		=> false,
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
				'name'			=> 'url',
				'type'			=> AVO_Field::TYPE_STRING,
				'title'			=> 'Link URL',
				'sortable'		=> false,
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
		$slide = Model_Homeslide::factory(null, $this->fields->id->value());
		$this->fields->warning->value('');
		switch ($this->fields->link_type->value()) {
			case Model_Homeslide::LINK_TYPE_PROJECT:
				$this->fields->public_link_type->value('Internal project');
				$project_id = $this->fields->project_id->value;
				$project = Model_Project::factory(null, $project_id);
				if ($project->loaded()) {
					$this->fields->preview->value($project->grid_preview_link());
					$this->fields->heading->value($project->heading);
					$this->fields->subheading->value($project->name);
					if (!$project->is_online) {
						$this->fields->warning->value('Linked project is offline!');
					}
				}
				break;
			case Model_Homeslide::LINK_TYPE_EXTERNAL:
				$this->fields->preview->value($slide->grid_preview_link());
				$this->fields->public_link_type->value('External');
				$this->fields->heading->value($slide->heading);
				$this->fields->subheading->value($slide->subheading);
				break;
			default:
				$this->fields->preview->value($slide->grid_preview_link());
				$this->fields->public_link_type->value('None');
				$this->fields->heading->value($slide->heading);
				$this->fields->subheading->value($slide->subheading);
				break;
		}
	}
}

















