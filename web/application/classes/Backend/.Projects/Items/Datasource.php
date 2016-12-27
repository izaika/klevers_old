<?php

class Backend_Projects_Items_Datasource extends AVO_Data_Source_DB {

	public function __construct(array $array = [])
	{
		$filter_conditions = '
			AND (
				:online_filter IS NULL
				OR is_online = :online_filter
			)
		';

		$defaults = [
			'count_query'		=> 'SELECT COUNT(*) FROM projects WHERE is_new = 0'.$filter_conditions,
			'select_query'		=> 'SELECT * FROM projects WHERE is_new = 0'.$filter_conditions.' ORDER BY ord',
			'find_query'		=> 'SELECT * FROM projects WHERE id = :id',
			'delete_query'		=> 'DELETE FROM projects WHERE id = :id',

			'update_query'		=>
				'UPDATE projects
					SET
						is_new 				= 0,
						is_online			= :is_online,
						heading				= :heading,
						name				= :name,
						location 			= :location,
						address 			= :address,
						ingress 			= :ingress,
						use_video			= :use_video,
						video_url 			= :video_url,
						embedded_video_link	= :embedded_video_link,
						url_title			= :url_title,
						seo_title			= :seo_title,
						seo_description 	= :seo_description

					WHERE id = :id',

			'insert_query'	=>
				'INSERT INTO projects (ord)
				VALUES ((SELECT * FROM (SELECT IFNULL(MIN(ord) - 1, 0) FROM projects) assets_ord));

				SELECT @project_id := (SELECT LAST_INSERT_ID());

				INSERT INTO project_blocks (
					ord,
					project_id,
					type,
					size,
					side
				)
				VALUES (
					(SELECT * FROM (SELECT IFNULL(MAX(ord) + 1, 0) FROM project_blocks WHERE project_id = @project_id) assets_ord),
					@project_id,
					'.Model_Project_Block::TYPE_CREDITS.',
					'.Model_Project_Block::SIZE_HALF_WIDTH.',
					'.Model_Project_Block::SIDE_LEFT.'
				);

				INSERT INTO project_blocks (
					ord,
					project_id,
					type,
					size,
					side
				)
				VALUES (
					(SELECT * FROM (SELECT IFNULL(MAX(ord) + 1, 0) FROM project_blocks WHERE project_id = @project_id) assets_ord),
					@project_id,
					'.Model_Project_Block::TYPE_TEXT.',
					'.Model_Project_Block::SIZE_HALF_WIDTH.',
					'.Model_Project_Block::SIDE_LEFT.'
				);


				INSERT INTO project_blocks (
					ord,
					project_id,
					type,
					size,
					side
				)
				VALUES (
					(SELECT * FROM (SELECT IFNULL(MAX(ord) + 1, 0) FROM project_blocks WHERE project_id = @project_id) assets_ord),
					@project_id,
					'.Model_Project_Block::TYPE_IMAGE.',
					'.Model_Project_Block::SIZE_HALF_WIDTH.',
					'.Model_Project_Block::SIDE_RIGHT.'
				);

				INSERT INTO project_blocks (
					ord,
					project_id,
					type,
					size,
					side
				)
				VALUES (
					(SELECT * FROM (SELECT IFNULL(MAX(ord) + 1, 0) FROM project_blocks WHERE project_id = @project_id) assets_ord),
					@project_id,
					'.Model_Project_Block::TYPE_QUOTE.',
					'.Model_Project_Block::SIZE_HALF_WIDTH.',
					'.Model_Project_Block::SIDE_RIGHT.'
				);

				INSERT INTO project_blocks (
					ord,
					project_id,
					type,
					size
				)
				VALUES (
					(SELECT * FROM (SELECT IFNULL(MAX(ord) + 1, 0) FROM project_blocks WHERE project_id = @project_id) assets_ord),
					@project_id,
					'.Model_Project_Block::TYPE_IMAGE.',
					'.Model_Project_Block::SIZE_FULL_WIDTH.'
				);

				INSERT INTO project_blocks (
					ord,
					project_id,
					type,
					size
				)
				VALUES (
					(SELECT * FROM (SELECT IFNULL(MAX(ord) + 1, 0) FROM project_blocks WHERE project_id = @project_id) assets_ord),
					@project_id,
					'.Model_Project_Block::TYPE_IMAGE.',
					'.Model_Project_Block::SIZE_FULL_WIDTH.'
				);

				INSERT INTO project_blocks (
					ord,
					project_id,
					type,
					size,
					side
				)
				VALUES (
					(SELECT * FROM (SELECT IFNULL(MAX(ord) + 1, 0) FROM project_blocks WHERE project_id = @project_id) assets_ord),
					@project_id,
					'.Model_Project_Block::TYPE_IMAGE.',
					'.Model_Project_Block::SIZE_HALF_WIDTH.',
					'.Model_Project_Block::SIDE_LEFT.'
				);

				INSERT INTO project_blocks (
					ord,
					project_id,
					type,
					size,
					side
				)
				VALUES (
					(SELECT * FROM (SELECT IFNULL(MAX(ord) + 1, 0) FROM project_blocks WHERE project_id = @project_id) assets_ord),
					@project_id,
					'.Model_Project_Block::TYPE_QUOTE.',
					'.Model_Project_Block::SIZE_HALF_WIDTH.',
					'.Model_Project_Block::SIDE_LEFT.'
				);


				INSERT INTO project_blocks (
					ord,
					project_id,
					type,
					size,
					side,
					use_in_pdf
				)
				VALUES (
					(SELECT * FROM (SELECT IFNULL(MAX(ord) + 1, 0) FROM project_blocks WHERE project_id = @project_id) assets_ord),
					@project_id,
					'.Model_Project_Block::TYPE_CREDITS.',
					'.Model_Project_Block::SIZE_HALF_WIDTH.',
					'.Model_Project_Block::SIDE_LEFT.',
					0
				);

				INSERT INTO project_blocks (
					ord,
					project_id,
					type,
					size,
					side
				)
				VALUES (
					(SELECT * FROM (SELECT IFNULL(MAX(ord) + 1, 0) FROM project_blocks WHERE project_id = @project_id) assets_ord),
					@project_id,
					'.Model_Project_Block::TYPE_IMAGE.',
					'.Model_Project_Block::SIZE_HALF_WIDTH.',
					'.Model_Project_Block::SIDE_RIGHT.'
				);

				INSERT INTO project_blocks (
					ord,
					project_id,
					type,
					size,
					side
				)
				VALUES (
					(SELECT * FROM (SELECT IFNULL(MAX(ord) + 1, 0) FROM project_blocks WHERE project_id = @project_id) assets_ord),
					@project_id,
					'.Model_Project_Block::TYPE_IMAGE.',
					'.Model_Project_Block::SIZE_HALF_WIDTH.',
					'.Model_Project_Block::SIDE_RIGHT.'
				);

				INSERT INTO project_blocks (
					ord,
					project_id,
					type,
					size,
					side
				)
				VALUES (
					(SELECT * FROM (SELECT IFNULL(MAX(ord) + 1, 0) FROM project_blocks WHERE project_id = @project_id) assets_ord),
					@project_id,
					'.Model_Project_Block::TYPE_IMAGE.',
					'.Model_Project_Block::SIZE_HALF_WIDTH.',
					'.Model_Project_Block::SIDE_RIGHT.'
				);
				',

			'custom_errors' => [
				'/Duplicate entry \'.+?\' for key \'value\'/' => ['value', __('duplicate value')],
			],

			'move_parameters'	=> [
				'table'			=> 'projects',
				'where'			=> 'is_new = 0',
				'order_by'		=> 'ord'
			],

			'model_class_name'	=> 'Model_Project',
		];
		parent::__construct(Arr::merge($defaults, $array));
	}

}
