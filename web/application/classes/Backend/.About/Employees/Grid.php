<?php

class Backend_About_Employees_Grid extends AVO_Data_Grid {

	public function __construct()
	{
		parent::__construct();

		$this->clear_cache 	= true;

		$this->datasource = new AVO_Data_Source_DB([
			'count_query'		=> 'SELECT COUNT(*) FROM employees',
			'select_query'		=> 'SELECT * FROM employees ORDER BY ord',
			'find_query'		=> 'SELECT * FROM employees WHERE id = :id',
			'delete_query'		=> 'DELETE FROM employees WHERE id = :id',

			'update_query'		=>
				'UPDATE employees
					SET
						name		= :name,
						info		= :info

					WHERE id = :id',

			'insert_query'	=>
				'INSERT INTO employees (
					ord,
					name,
					info
				)
				VALUES (
					(SELECT * FROM (SELECT IFNULL(MIN(ord) - 1, 0) FROM employees) assets_ord),
					:name,
					:info
				)',

			'custom_errors' => [
				'/Duplicate entry \'.+?\' for key \'value\'/' => ['value', __('duplicate value')],
			],

			'move_parameters'	=> [
				'table'			=> 'employees',
				'where'			=> 'id IS NOT NULL',
				'order_by'		=> 'ord'
			],

			'model_class_name'	=> 'Model_Employee',
		]);

		$edit_form = new Backend_About_Employees_Form;
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
				'name'			=> 'preview',
				'type'			=> AVO_Field::TYPE_STRING,
				'encoded'		=> true,
				'width'			=> Model_Project::GRID_PREVIEW_W,
				'title'			=> 'Image',
				'calculated'	=> true,
			]),
			new AVO_Field([
				'name'			=> 'name',
				'type'			=> AVO_Field::TYPE_STRING,
				'title'			=> 'Heading',
				'sortable'		=> false,
			]),
			new AVO_Field([
				'name'			=> 'info',
				'type'			=> AVO_Field::TYPE_STRING,
				'title'			=> 'Info',
				'sortable'		=> false,
				'encoded'		=> true,
			]),
		]);
	}


	public function on_calc()
	{
		$model = $this->fields->model();
		$this->fields->preview->value($model->grid_preview_link());
	}


	public function on_delete($ids)
	{
		parent::on_delete($ids);
		foreach ($ids as $id) {
			$employee = Model_Employee::factory(null, $id);
			Appsearch::delete_document(AppSearch::open_index(AppSearch::INDEX_GENERAL), $employee);
		}
	}
}
