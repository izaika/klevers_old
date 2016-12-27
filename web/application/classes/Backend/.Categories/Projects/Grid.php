<?php

class Backend_Categories_Projects_Grid extends AVO_Data_Grid {

	public function __construct()
	{
		parent::__construct();

		$this->clear_cache = true;
		$this->allow_move	= false;
		$this->allow_delete	= false;
		$this->allow_insert	= false;
		$this->allow_update	= false;

		$this->datasource = new AVO_Data_Source_DB([
			'count_query'		=> 'SELECT COUNT(*) FROM categories_projects cp JOIN projects p ON (cp.project_id = p.id) WHERE category_id = :category_id',
			'select_query'		=> 'SELECT cp.*, p.heading AS project_heading, p.name AS project_name, p.is_online AS project_is_online FROM categories_projects cp JOIN projects p ON (cp.project_id = p.id) WHERE category_id = :category_id ORDER BY p.ord',
			'find_query'		=> 'SELECT * FROM categories_projects WHERE id = :id',

			'update_query'		=>
				'UPDATE categories_projects
					SET
						is_featured	= :is_featured

					WHERE id = :id',

			'custom_errors' => [
				'/Duplicate entry \'.+?\' for key \'value\'/' => ['value', __('duplicate value')],
			],

			'on_calc_parameter'	=> [$this, 'on_calc_data_source_parameter'],

			'model_class_name'	=> 'Model_Category_Project',
		]);

		$this->height = 340;

		$this->fields = new AVO_Controls_List([
			AVO_Field::std_drag_field(),
			new AVO_Field([
				'name'			=> 'no',
				'type'			=> AVO_Field::TYPE_INT,
				'width'			=> 20,
				'title'			=> '#',
				'calculated'	=> true,
				'function'		=> 'ds_abspos',
				'sortable'		=> false,
			]),
			new AVO_Field([
				'name'			=> 'id',
				'type'			=> AVO_Field::TYPE_INT,
				'key'			=> true,
				'title'			=> 'ID',
				'sortable'		=> false,
				'hidden'		=> true,
				'width'			=> 20
			]),
			new AVO_Field([
				'name'			=> 'project_id',
				'type'			=> AVO_Field::TYPE_INT,
				'title'			=> 'Project ID',
				'sortable'		=> false,
				'hidden'		=> true,
			]),
			new AVO_Field([
				'name'			=> 'project_is_online',
				'type'			=> AVO_Field::TYPE_BOOL,
				'title'			=> 'Is online?',
				'sortable'		=> false,
			]),
			new AVO_Field([
				'name'			=> 'preview',
				'type'			=> AVO_Field::TYPE_STRING,
				'encoded'		=> true,
				'width'			=> 400,
				'title'			=> 'Preview',
				'calculated'	=> true,
			]),
			new AVO_Field([
				'name'			=> 'project_heading',
				'type'			=> AVO_Field::TYPE_STRING,
				'title'			=> 'Project heading',
				'sortable'		=> false,
			]),
			new AVO_Field([
				'name'			=> 'project_name',
				'type'			=> AVO_Field::TYPE_STRING,
				'title'			=> 'Project name',
				'sortable'		=> false,
			]),
			new AVO_Field([
				'name'			=> 'is_featured',
				'type'			=> AVO_Field::TYPE_BOOL,
				'title'			=> 'Is featured?',
				'sortable'		=> false,
				'class_extension'	=> '{
					onChange: function (e) {
						var grid = this.parent();
						var cb = $(e.currentTarget);
						var is_checked = cb.is(":checked") ? 1 : 0;
						var id = cb.closest("tr").data("id");
						
						grid.update("update_featured", {id: id, is_featured: is_checked});
					}
				}',
			]),
		]);

		$this->parameters = new AVO_Controls_List([
			new AVO_Field([
				'name'			=> 'category_id',
				'type'			=> AVO_Field::TYPE_INT,
			]),
		]);
	}

	public function action_update_featured($action_state)
	{
		$request = Request::current();
		$cp = new Model_Category_Project($request->post("id"));
		if ($cp->loaded()) {
			$cp->is_featured = $request->post("is_featured");
			$cp->save();
		}
		$action_state->processed = true;
		$action_state->message = 'featured state is updated';
		$action_state->status = 2;
	}


	public function on_calc()
	{
		$project_id = $this->fields->project_id->value();
		$project = Model_Project::factory(null, $project_id);
		if ($project->loaded()) {
			$this->fields->preview->value($project->grid_preview_link());
		} else {
			$this->fields->preview->value('');
		}
	}
}
































