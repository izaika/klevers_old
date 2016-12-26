<?php

class Backend_Articles_Grid extends AVO_Data_Grid {

	public function __construct()
	{
		parent::__construct();

		$this->clear_cache 	= true;
		$this->allow_move	= false;

		$this->datasource = new AVO_Data_Source_DB([
			'count_query'		=> 'SELECT COUNT(*) FROM articles WHERE is_new = 0',
			'select_query'		=> 'SELECT * FROM articles WHERE is_new = 0 ORDER BY public_date DESC, id DESC',
			'find_query'		=> 'SELECT * FROM articles WHERE id = :id',
			'delete_query'		=> 'DELETE FROM articles WHERE id = :id',

			'update_query'		=>
				'UPDATE articles
					SET
						is_new		= 0,
						heading		= :heading,
						body_text	= :body_text,
						public_date	= :public_date

					WHERE id = :id',

			'insert_query'	=>
				'INSERT INTO articles (ord)
				VALUES ((SELECT * FROM (SELECT IFNULL(MIN(ord) - 1, 0) FROM articles) assets_ord))',

			'custom_errors' => [
				'/Duplicate entry \'.+?\' for key \'value\'/' => ['value', __('duplicate value')],
			],

			'move_parameters'	=> [
				'table'			=> 'articles',
				'where'			=> 'is_new = 0',
				'order_by'		=> 'ord'
			],

			'model_class_name'	=> 'Model_Article',
		]);

		$edit_form = new Backend_Articles_Form;
		$edit_form->datasource = $this->datasource;
		$this->forms = [
			'edit_form'	=> $edit_form
		];

		$this->height = 340;

		$this->fields = new AVO_Controls_List([
			// AVO_Field::std_drag_field(),
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
				'name'			=> 'public_date',
				'type'			=> AVO_Field::TYPE_STRING,
				'title'			=> 'Date',
				'sortable'		=> false,
			]),
			new AVO_Field([
				'name'			=> 'heading',
				'type'			=> AVO_Field::TYPE_STRING,
				'title'			=> 'Heading',
				'sortable'		=> false,
			]),
			new AVO_Field([
				'name'			=> 'body_text',
				'type'			=> AVO_Field::TYPE_STRING,
				'title'			=> 'Text',
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
			$article = Model_Article::factory(null, $id);
			Appsearch::delete_document(AppSearch::open_index(AppSearch::INDEX_GENERAL), $article);
		}
	}
}
