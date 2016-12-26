<?php

class Backend_Projects_Items_Blocks_Grid extends AVO_Data_Grid {

	public function __construct()
	{
		parent::__construct();

		$this->clear_cache = true;

		$this->datasource = new AVO_Data_Source_DB([
			'count_query'		=> 'SELECT COUNT(*) FROM project_blocks WHERE project_id = :project_id',
			'select_query'		=> 'SELECT * FROM project_blocks WHERE project_id = :project_id ORDER BY ord',
			'find_query'		=> 'SELECT * FROM project_blocks WHERE id = :id',
			'delete_query'		=> 'DELETE FROM project_blocks WHERE id = :id',

			'update_query'		=>
				'UPDATE project_blocks
					SET
						type				= :type,
						size 				= :size,
						side 				= :side,
						use_in_pdf 			= :use_in_pdf,
						body_text			= :body_text,
						video_url			= :video_url,
						embedded_video_link	= :embedded_video_link

					WHERE id = :id',

			'insert_query'	=>
				'INSERT INTO project_blocks (
					ord,
					project_id,
					type,
					size,
					side,
					use_in_pdf,
					body_text,
					video_url,
					embedded_video_link
				)
				VALUES (
					(SELECT * FROM (SELECT IFNULL(MAX(ord) + 1, 0) FROM project_blocks WHERE project_id = :project_id) assets_ord),
					:project_id,
					:type,
					:size,
					:side,
					:use_in_pdf,
					:body_text,
					:video_url,
					:embedded_video_link
				)',

			'custom_errors' => [
				'/Duplicate entry \'.+?\' for key \'value\'/' => ['value', __('duplicate value')],
			],

			'move_parameters'	=> [
				'table'			=> 'project_blocks',
				'where'			=> 'project_id = :project_id',
				'order_by'		=> 'ord'
			],

			'on_calc_parameter'	=> [$this, 'on_calc_data_source_parameter'],

			'model_class_name'	=> 'Model_Project_Block',
		]);

		$edit_form = new Backend_Projects_Items_Blocks_Form;
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
				'name'			=> 'size',
				'type'			=> AVO_Field::TYPE_INT,
				'title'			=> 'Size',
				'sortable'		=> false,
				'hidden'		=> true,
			]),
			new AVO_Field([
				'name'			=> 'public_size',
				'type'			=> AVO_Field::TYPE_STRING,
				'title'			=> 'Size',
				'sortable'		=> false,
				'calculated'	=> true,
			]),
			new AVO_Field([
				'name'			=> 'side',
				'type'			=> AVO_Field::TYPE_INT,
				'title'			=> 'Side',
				'sortable'		=> false,
				'hidden'		=> true,
			]),
			new AVO_Field([
				'name'			=> 'public_side',
				'type'			=> AVO_Field::TYPE_STRING,
				'title'			=> 'Side',
				'sortable'		=> false,
				'calculated'	=> true,
			]),
			new AVO_Field([
				'name'			=> 'type',
				'type'			=> AVO_Field::TYPE_INT,
				'title'			=> 'Type',
				'sortable'		=> false,
				'hidden'		=> true,
			]),
			new AVO_Field([
				'name'			=> 'public_type',
				'type'			=> AVO_Field::TYPE_STRING,
				'title'			=> 'Type',
				'sortable'		=> false,
				'calculated'	=> true,
			]),
			new AVO_Field([
				'name'			=> 'use_in_pdf',
				'type'			=> AVO_Field::TYPE_BOOL,
				'title'			=> 'Use in PDF?',
				'sortable'		=> false,
				'hidden'		=> true,
			]),
			new AVO_Field([
				'name'			=> 'public_use_in_pdf',
				'type'			=> AVO_Field::TYPE_STRING,
				'title'			=> 'Use in PDF?',
				'sortable'		=> false,
				'calculated'	=> true,
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
				'name'			=> 'warning',
				'type'			=> AVO_Field::TYPE_STRING,
				'title'			=> 'Warning field',
				'sortable'		=> false,
				'encoded'		=> true,
				'calculated'	=> true,
				'html_class'	=> 'warning_field',
				'width'			=> 500
			]),
		]);

		$this->parameters = new AVO_Controls_List([
			new AVO_Field([
				'name'			=> 'project_id',
				'type'			=> AVO_Field::TYPE_INT,
			]),
		]);
	}

	public function on_calc()
	{
		$model = $this->fields->model();
		$use_in_pdf = '';
		switch ($this->fields->type->value()) {
			case Model_Project_Block::TYPE_QUOTE:
				$this->fields->public_type->value('Quote');
				$this->fields->preview->value(nl2br(Text::limit_chars(strip_tags(preg_replace("=<br */?>=i", "\n", $model->body_text)))));
				break;
			case Model_Project_Block::TYPE_CREDITS:
				$this->fields->public_type->value('Credits');
				$this->fields->preview->value(nl2br(Text::limit_chars(strip_tags(preg_replace("=<br */?>=i", "\n", $model->body_text)))));
				$use_in_pdf = $model->use_in_pdf ? 'Yes' : 'No';
				break;
			case Model_Project_Block::TYPE_IMAGE:
				$this->fields->public_type->value('Image');
				$this->fields->preview->value($model->grid_preview_link());
				break;
			case Model_Project_Block::TYPE_VIDEO:
				$this->fields->public_type->value('Video');
				$this->fields->preview->value($model->grid_preview_link());
				break;
			default: // Model_Project_Block::TYPE_TEXT
				$this->fields->public_type->value('Text');
				$this->fields->preview->value(nl2br(Text::limit_chars(strip_tags(preg_replace("=<br */?>=i", "\n", $model->body_text)))));
				$use_in_pdf = $model->use_in_pdf ? 'Yes' : 'No';
				break;
		}
		$this->fields->public_use_in_pdf->value($use_in_pdf);
		if ($this->fields->size->value() == Model_Project_Block::SIZE_FULL_WIDTH) {
			$this->fields->public_size->value('Full width');
			$this->fields->public_side->value('');
		} else {
			$this->fields->public_size->value('Half width');
			if ($this->fields->side->value() == Model_Project_Block::SIDE_RIGHT) {
				$this->fields->public_side->value('Right');
			} else {
				$this->fields->public_side->value('Left');
			}
		}
		$id = $this->fields->id->value();
		$warning = '';
		if ($model->size == $model::SIZE_HALF_WIDTH && $model->side == $model::SIDE_RIGHT) {
			$first_block = Model_Project_Block::factory()->where('project_id', '=', $this->parameters->project_id->value())->find();
			if ($first_block->loaded()) {
				if ($first_block->id == $id) {
					$warning = 'Position warning: Right side block can\'t be first or go after full width block.<br>';
				}
				$previous_block = Model_Project_Block::factory()
					->where('project_id', '=', $this->parameters->project_id->value())
					->and_where('ord', '<=', $model->ord)
					->and_where('id', '<>', $id)
					->order_by('ord', 'DESC')
					->order_by('id', 'DESC')
					->find();
				if ($previous_block->loaded() && $previous_block->size == $previous_block::SIZE_FULL_WIDTH) {
					$warning = 'Position warning: Right side block can\'t be first or go after full width block.<br>';
				}
			}
		}
		switch($this->fields->type->value()) {
			case $model::TYPE_IMAGE:
				if (!$model->uid) {
					$warning .= 'Content warning: No image.<br>';
				}
				break;
			case $model::TYPE_VIDEO:
				if (!$model->uid) {
					$warning .= 'Content warning: No image.<br>';
				}
				if (!$model->video_url) {
					$warning .= 'Content warning: No seamless video URL.<br>';
				}
				if (!$model->embedded_video_link) {
					$warning .= 'Content warning: No embedded video link.<br>';
				}
				break;
			default:
				// case $model::TYPE_TEXT:
				// case $model::TYPE_QUOTE:
				// case $model::TYPE_CREDITS:
				if (!$model->body_text) {
					$warning .= 'Content warning: No body text.<br>';
				}
				break;
		}
		$this->fields->warning->value($warning);

	}
}
