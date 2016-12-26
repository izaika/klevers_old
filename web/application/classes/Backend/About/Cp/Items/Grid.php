<?php

class Backend_About_Cp_Items_Grid extends AVO_Data_Grid {

	public function __construct()
	{
		parent::__construct();

		$this->clear_cache 	= true;

		$this->datasource = new AVO_Data_Source_DB([
			'count_query'		=> 'SELECT COUNT(*) FROM cp_items',
			'select_query'		=> 'SELECT * FROM cp_items ORDER BY ord',
			'find_query'		=> 'SELECT * FROM cp_items WHERE id = :id',
			'delete_query'		=> 'DELETE FROM cp_items WHERE id = :id',

			'update_query'		=>
				'UPDATE cp_items
					SET
						heading		= :heading,
						short_text	= :short_text,
						num			= :num

					WHERE id = :id',

			'insert_query'	=>
				'INSERT INTO cp_items (
					ord,
					heading,
					short_text,
					num
				)
				VALUES (
					(SELECT * FROM (SELECT IFNULL(MAX(ord) + 1, 0) FROM cp_items) assets_ord),
					:heading,
					:short_text,
					:num
				)',

			'custom_errors' => [
				'/Duplicate entry \'.+?\' for key \'value\'/' => ['value', __('duplicate value')],
			],

			'move_parameters'	=> [
				'table'			=> 'cp_items',
				'where'			=> 'id IS NOT NULL',
				'order_by'		=> 'ord'
			],

			'model_class_name'	=> 'Model_Cp_Item'
		]);

		$edit_form = new Backend_About_Cp_Items_Form;
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
				'name'			=> 'num',
				'type'			=> AVO_Field::TYPE_STRING,
				'title'			=> 'Number',
				'sortable'		=> false,
			]),
			new AVO_Field([
				'name'			=> 'heading',
				'type'			=> AVO_Field::TYPE_STRING,
				'title'			=> 'Heading',
				'sortable'		=> false,
			]),
			new AVO_Field([
				'name'			=> 'short_text',
				'type'			=> AVO_Field::TYPE_STRING,
				'title'			=> 'Short text',
				'sortable'		=> false,
				'encoded'		=> true,
				'function'		=> function ($val) {
					return nl2br(Text::limit_chars(strip_tags(preg_replace("=<br */?>=i", "\n", $val))));
				},
			]),
		]);
	}


	public function on_delete($ids)
	{
		parent::on_delete($ids);
		foreach ($ids as $id) {
			$cp = new Model_Cp_Item($id);
			Appsearch::delete_document(AppSearch::open_index(AppSearch::INDEX_GENERAL), $cp);
		}
	}
}
