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
					ord = ord,
				WHERE
					id = :id',

			'insert_query'	=>
				'INSERT INTO homeslides (ord) VALUES ((SELECT * FROM (SELECT IFNULL(MIN(ord), 0) - 1 FROM homeslides) assets_ord))',

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
				'name'			=> 'preview',
				'type'			=> AVO_Field::TYPE_STRING,
				'encoded'		=> true,
				'title'			=> 'Image',
				'calculated'	=> true,
			]),
		]);
	}

	public function on_calc()
	{
		$slide = new Model_Homeslide($this->fields->id->value());
		$this->fields->preview->value($slide->grid_preview_link());
	}
}
