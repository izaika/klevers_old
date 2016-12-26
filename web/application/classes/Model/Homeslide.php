<?php

class Model_Homeslide extends Model_Generic_Image
{
	const LINK_TYPE_NONE		= 0;
	const LINK_TYPE_PROJECT		= 1;
	const LINK_TYPE_EXTERNAL	= 2;

	public static $STORAGE_PATH = 'assets/homeslides/';

	protected $_belongs_to = [
	    'project' => [
	        'model'       => 'Project',
	        'foreign_key' => 'project_id',
	    ],
	];

	const FORM_PREVIEW_NAME = 'form_preview';
	const FORM_PREVIEW_W = 400;
	const FORM_PREVIEW_H = 300;

	const GRID_PREVIEW_NAME = 'grid_preview';
	const GRID_PREVIEW_W = 200;

	const NORMAL_NAME = 'normal';
	const NORMAL_W = 2800;

	public static $SIZES = [
		self::FORM_PREVIEW_NAME => [
			'width'		=> self::FORM_PREVIEW_W,
			'mode'		=> self::RESIZE_MODE_MATCH_WIDTH,
			'quality'	=> 60,
		],
		self::GRID_PREVIEW_NAME => [
			'width'		=> self::GRID_PREVIEW_W,
			'mode'		=> self::RESIZE_MODE_MATCH_WIDTH,
			'quality'	=> 60,
		],
		self::NORMAL_NAME => [
			'width'		=> self::NORMAL_W,
			'mode'		=> self::RESIZE_MODE_MATCH_WIDTH,
			'quality'	=> 60,
		],
	];
}
