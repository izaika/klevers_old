<?php

class Backend_Articles_Images_Grid extends AVO_Data_Grid {

	public function __construct()
	{
		parent::__construct();

		$this->clear_cache = true;

		$this->datasource = new AVO_Data_Source_DB([
			'count_query'		=> 'SELECT COUNT(*) FROM article_images WHERE article_id = :article_id',
			'select_query'		=> 'SELECT * FROM article_images WHERE article_id = :article_id ORDER BY ord',
			'find_query'		=> 'SELECT * FROM article_images WHERE id = :id',
			'delete_query'		=> 'DELETE FROM article_images WHERE id = :id',

			'update_query'		=>
				'UPDATE article_images
					SET
						id					= :id,
						use_video			= :use_video,
						video_url			= :video_url,
						embedded_video_link	= :embedded_video_link

					WHERE id = :id',

			'insert_query'	=>
				'INSERT INTO article_images (
					ord,
					article_id,
					use_video,
					video_url,
					embedded_video_link
				)
				VALUES (
					(SELECT * FROM (SELECT IFNULL(MAX(ord) + 1, 0) FROM article_images WHERE article_id = :article_id) assets_ord),
					:article_id,
					:use_video,
					:video_url,
					:embedded_video_link
				)',

			'custom_errors' => [
				'/Duplicate entry \'.+?\' for key \'value\'/' => ['value', __('duplicate value')],
			],

			'move_parameters'	=> [
				'table'			=> 'article_images',
				'where'			=> 'article_id = :article_id',
				'order_by'		=> 'ord'
			],

			'on_calc_parameter'	=> [$this, 'on_calc_data_source_parameter'],

			'model_class_name'	=> 'Model_Article_Image',
		]);

		$edit_form = new Backend_Articles_Images_Form;
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
				'width'			=> 400,
				'title'			=> 'Preview',
				'calculated'	=> true,
			]),
			new AVO_Field([
				'name'			=> 'use_video',
				'type'			=> AVO_Field::TYPE_BOOL,
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
		]);

		$this->parameters = new AVO_Controls_List([
			new AVO_Field([
				'name'			=> 'article_id',
				'type'			=> AVO_Field::TYPE_INT,
			]),
		]);
	}

	public function on_calc()
	{
		$model = $this->fields->model();
		$this->fields->preview->value($model->grid_preview_link());
	}
}
