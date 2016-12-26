<?php

class Backend_Projects_Items_Grid extends AVO_Data_Grid {

	public function __construct()
	{
		parent::__construct();

		$this->clear_cache = true;

		$this->datasource = new AVO_Data_Source_DB();

		$edit_form = new Backend_Projects_Items_Form;
		$edit_form->datasource = $this->datasource = new Backend_Projects_Items_Datasource([
			'on_calc_parameter'	=> [$this, 'on_calc_data_source_parameter'],
		]);
		$this->forms = [
			'edit_form'	=> $edit_form
		];

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
				'name'			=> 'is_online',
				'type'			=> AVO_Field::TYPE_BOOL,
				'title'			=> 'Is online?',
				'sortable'		=> false,
			]),
			new AVO_Field([
				'name'			=> 'preview',
				'type'			=> AVO_Field::TYPE_STRING,
				'encoded'		=> true,
				'width'			=> Model_Project::GRID_PREVIEW_W,
				'title'			=> 'Image',
				'calculated'	=> true,
			]),
			new AVO_Field([
				'name'			=> 't_preview',
				'type'			=> AVO_Field::TYPE_STRING,
				'encoded'		=> true,
				'width'			=> Model_Project_Preview::GRID_PREVIEW_W,
				'title'			=> 'Additional Teaser Image',
				'calculated'	=> true,
			]),
			new AVO_Field([
				'name'			=> 'use_video',
				'type'			=> AVO_Field::TYPE_BOOL,
				'width'			=> 400,
				'title'			=> 'Use video?',
				'sortable'		=> false,
			]),
			new AVO_Field([
				'name'			=> 'video_url',
				'type'			=> AVO_Field::TYPE_STRING,
				'width'			=> 400,
				'title'			=> 'URL to video .mp4 file (seamless video)',
				'sortable'		=> false,
			]),
			new AVO_Field([
				'name'			=> 'embedded_video_link',
				'type'			=> AVO_Field::TYPE_STRING,
				'width'			=> 400,
				'title'			=> 'Vimeo/Youtube link (embedded video)',
				'sortable'		=> false,
			]),
			new AVO_Field([
				'name'			=> 'heading',
				'type'			=> AVO_Field::TYPE_STRING,
				'title'			=> 'Heading',
				'sortable'		=> false,
			]),
			new AVO_Field([
				'name'			=> 'name',
				'type'			=> AVO_Field::TYPE_STRING,
				'title'			=> 'Name',
				'sortable'		=> false,
			]),
			new AVO_Field([
				'name'			=> 'location',
				'type'			=> AVO_Field::TYPE_STRING,
				'title'			=> 'Location',
				'sortable'		=> false,
			]),
			new AVO_Field([
				'name'			=> 'address',
				'type'			=> AVO_Field::TYPE_STRING,
				'title'			=> 'Address',
				'sortable'		=> false,
			]),
			new AVO_Field([
				'name'			=> 'preview_btn',
				'type'			=> AVO_Field::TYPE_STRING,
				'title'			=> 'Preview',
				'sortable'		=> false,
				'encoded'		=> true,
				'calculated'	=> true,
			]),
		]);
		$this->parameters = new AVO_Controls_List([
			new AVO_Field([
				'name'			=> 'dummy_id',
				'type'			=> AVO_Field::TYPE_INT,
			]),
			new AVO_Field([
				'name'			=> 'online_filter',
				'type'			=> AVO_Field::TYPE_INT,
			]),
		]);
	}


	public function on_calc()
	{
		$model 		= $this->fields->model();
		$t_model	= new Model_Project_Preview($model->id);
		$this->fields->preview->value($model->grid_preview_link());
		$this->fields->t_preview->value($t_model->grid_preview_link());

		$this->fields->preview_btn->value(HTML::anchor($model->get_url(), 'Preview', [
			'target'	=> '_blank',
			'class'		=> 'btn btn-xs '.($model->is_online ? 'btn-success' : 'btn-warning')
		]));
	}


	public function on_delete($ids)
	{
		parent::on_delete($ids);
		foreach ($ids as $id) {
			$project = Model_Project::factory(null, $id);
			Appsearch::delete_document(AppSearch::open_index(AppSearch::INDEX_RELATED), $project);
			Appsearch::delete_document(AppSearch::open_index(AppSearch::INDEX_GENERAL), $project);
		}
	}
}
