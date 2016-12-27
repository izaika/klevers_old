<?php

class Backend_Categories_Subcategories_Grid extends AVO_Data_Grid {

	public function __construct()
	{
		parent::__construct();

		$this->clear_cache = true;

		$this->datasource = new AVO_Data_Source_DB([
			'count_query'		=> 'SELECT COUNT(*) FROM categories WHERE is_new = 0 AND category_id = :category_id',
			'select_query'		=> 'SELECT * FROM categories WHERE is_new = 0 AND category_id = :category_id ORDER BY ord',
			'find_query'		=> 'SELECT * FROM categories WHERE id = :id',
			'delete_query'		=> 'DELETE FROM categories WHERE id = :id',

			'update_query'		=>
				'UPDATE categories
					SET
						heading		= :heading,
						description	= :description,
						url_title	= :url_title

					WHERE id = :id',

			'insert_query'	=>
				'INSERT INTO categories (
					ord,
					is_new,
					category_id,
					heading,
					description,
					url_title
				)
				VALUES (
					(SELECT * FROM (SELECT IFNULL(MAX(ord) + 1, 0) FROM categories WHERE category_id = :category_id) assets_ord),
					0,
					:category_id,
					:heading,
					:description,
					:url_title
				)',

			'custom_errors' => [
				'/Duplicate entry \'.+?\' for key \'value\'/' => ['value', __('duplicate value')],
			],

			'move_parameters'	=> [
				'table'			=> 'categories',
				'where'			=> 'is_new = 0 AND category_id = :category_id',
				'order_by'		=> 'ord'
			],

			'on_calc_parameter'	=> [$this, 'on_calc_data_source_parameter'],

			'model_class_name'	=> 'Model_Category',
		]);

		$edit_form = new Backend_Categories_Subcategories_Form;
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
				'name'			=> 'heading',
				'type'			=> AVO_Field::TYPE_STRING,
				'title'			=> 'Heading',
				'sortable'		=> false,
			]),
			new AVO_Field([
				'name'			=> 'description',
				'type'			=> AVO_Field::TYPE_STRING,
				'title'			=> 'Description',
				'sortable'		=> false,
				'encoded'		=> true,
				'function'		=> function ($val) {
					return nl2br(Text::limit_chars(strip_tags(preg_replace("=<br */?>=i", "\n", $val))));
				},
			]),
			new AVO_Field([
				'name'			=> 'url_title',
				'type'			=> AVO_Field::TYPE_STRING,
				'title'			=> 'URL title',
				'sortable'		=> false,
			]),
		]);

		$this->parameters = new AVO_Controls_List([
			new AVO_Field([
				'name'			=> 'category_id',
				'type'			=> AVO_Field::TYPE_INT,
			]),
		]);
	}
}
