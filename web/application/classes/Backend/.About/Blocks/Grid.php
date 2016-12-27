<?php

class Backend_About_Blocks_Grid extends AVO_Data_Grid {

	public function __construct()
	{
		parent::__construct();

		$this->clear_cache 	= true;

		$this->datasource = new AVO_Data_Source_DB([
			'count_query'		=> 'SELECT COUNT(*) FROM about_blocks',
			'select_query'		=> 'SELECT * FROM about_blocks ORDER BY ord',
			'find_query'		=> 'SELECT * FROM about_blocks WHERE id = :id',
			'delete_query'		=> 'DELETE FROM about_blocks WHERE id = :id',

			'update_query'		=>
				'UPDATE about_blocks
					SET
						heading		= :heading,
						body_text	= :body_text,
						type		= :type,
						video_url	= :video_url

					WHERE id = :id',

			'insert_query'	=>
				'INSERT INTO about_blocks (
					ord,
					heading,
					body_text,
					type,
					video_url
				)
				VALUES (
					(SELECT * FROM (SELECT IFNULL(MIN(ord) - 1, 0) FROM about_blocks) assets_ord),
					:heading,
					:body_text,
					:type,
					:video_url
				)',

			'custom_errors' => [
				'/Duplicate entry \'.+?\' for key \'value\'/' => ['value', __('duplicate value')],
			],

			'move_parameters'	=> [
				'table'			=> 'about_blocks',
				'where'			=> 'id IS NOT NULL',
				'order_by'		=> 'ord'
			],

			'model_class_name'	=> 'Model_About_Block',
		]);

		$edit_form = new Backend_About_Blocks_Form;
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
				'name'			=> 'type',
				'type'			=> AVO_Field::TYPE_STRING,
				'title'			=> 'Type',
				'hidden'		=> true,
				'sortable'		=> false,
			]),
			new AVO_Field([
				'name'			=> 'public_type',
				'type'			=> AVO_Field::TYPE_STRING,
				'title'			=> 'Type',
				'sortable'		=> false,
				'calculated'	=> true
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
				'name'			=> 'video_url',
				'type'			=> AVO_Field::TYPE_STRING,
				'width'			=> 400,
				'title'			=> 'URL to video .mp4 file',
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


	public function on_calc()
	{
		$model = $this->fields->model();
		$this->fields->preview->value($model->grid_preview_link());

		switch ($this->fields->type->value()) {
			case Model_About_Block::TYPE_IMAGE:
				$this->fields->public_type->value('Only image/video');
				break;
			case Model_About_Block::TYPE_TEXT:
				$this->fields->public_type->value('Only text');
				break;

			default: // Model_About_Block::TYPE_IMAGE_AND_TEXT
				$this->fields->public_type->value('Image/video with text');
				break;
		}
	}


	public function on_delete($ids)
	{
		parent::on_delete($ids);
		foreach ($ids as $id) {
			$block = Model_About_Block::factory(null, $id);
			Appsearch::delete_document(AppSearch::open_index(AppSearch::INDEX_GENERAL), $block);
		}
	}
}
