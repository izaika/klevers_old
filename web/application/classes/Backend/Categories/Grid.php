<?php

class Backend_Categories_Grid extends AVO_Data_Grid {

	public function __construct()
	{
		parent::__construct();

		$this->clear_cache 	= true;

		$this->datasource = new AVO_Data_Source_DB([
			'count_query'		=> 'SELECT COUNT(*) FROM categories',
			'select_query'		=> 'SELECT * FROM categories ORDER BY ord',
			'find_query'		=> 'SELECT * FROM categories WHERE id = :id',
			'delete_query'		=> 'DELETE FROM categories WHERE id = :id',

			'update_query'		=>
				'UPDATE categories
					SET
						heading				= :heading,
						description			= :description,
						animation_property	= :animation_property,
						pdf_title 			= :pdf_title
					WHERE id = :id',

			'insert_query'	=>
				'INSERT INTO categories (
					ord,
					heading,
					description,
					animation_property,
					pdf_title
				)
				VALUES (
					(SELECT * FROM (SELECT IFNULL(MIN(ord) - 1, 0) FROM categories) assets_ord),
					:heading,
					:description,
					:animation_property,
					:pdf_title
				)',

			'custom_errors' => [
				'/Duplicate entry \'.+?\' for key \'value\'/' => ['value', __('duplicate value')],
			],

			'move_parameters'	=> [
				'table'			=> 'categories',
				'where'			=> 'id IS NOT NULL',
				'order_by'		=> 'ord'
			],

			'model_class_name'	=> 'Model_Category',
		]);

		$edit_form = new Backend_Categories_Form;
		$edit_form->datasource = $this->datasource;
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
				'name'			=> 'icon',
				'type'			=> AVO_Field::TYPE_STRING,
				'title'			=> 'SVG Icon preview',
				'width'			=> 150,
				'sortable'		=> false,
				'encoded'		=> true,
				'calculated'	=> true,
			]),
			new AVO_Field([
				'name'			=> 'animation_property',
				'type'			=> AVO_Field::TYPE_STRING,
				'hidden'		=> true,
				'sortable'		=> false,
			]),
			new AVO_Field([
				'name'			=> 'public_animation_property',
				'type'			=> AVO_Field::TYPE_STRING,
				'title'			=> 'SVG color animation property',
				'sortable'		=> false,
				'calculated'	=> true,
			]),
			new AVO_Field([
				'name'			=> 'heading',
				'type'			=> AVO_Field::TYPE_STRING,
				'title'			=> 'Heading',
				'sortable'		=> false,
			]),
			new AVO_Field([
				'name'			=> 'description',
				'type'			=> AVO_Field::TYPE_STRING,
				'title'			=> 'Short description',
				'sortable'		=> false,
				'encoded'		=> true,
				'function'		=> function ($val) {
					return nl2br(Text::limit_chars(strip_tags(preg_replace("=<br */?>=i", "\n", $val))));
				},
			]),
		]);
	}


	public function on_calc()
	{
		$model = $this->fields->model();
		$animate_stroke = $model->animation_property == $model::ANIMATE_STROKE;
		$animation_class = $animate_stroke ? ' animate_stroke' : ' animate_fill';
		$this->fields->icon->value($model->icon_uid ? '<div class="cat_icon'.$animation_class.'">'.file_get_contents($model->file_storage()).'</div>' : "");

		$this->fields->public_animation_property->value($animate_stroke ? 'Stroke' : 'Fill');
		// $this->fields->icon->value(HTML::image($model->file_url()));
	}
}
































