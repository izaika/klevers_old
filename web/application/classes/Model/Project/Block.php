<?php

class Model_Project_Block extends Model_Generic_Image
{
	const SIZE_HALF_WIDTH	= 0;
	const SIZE_FULL_WIDTH	= 1;

	const SIDE_LEFT			= 0;
	const SIDE_RIGHT		= 1;

	const TYPE_TEXT			= 0;
	const TYPE_QUOTE		= 1;
	const TYPE_IMAGE		= 2;
	const TYPE_CREDITS 		= 3;
	const TYPE_VIDEO		= 4;

	protected $_sorting = array('ord' => 'ASC');

	protected $_belongs_to = [
	    'project' => [
	        'model'       => 'Project',
	        'foreign_key' => 'project_id',
	    ],
	];

	public static $STORAGE_PATH = 'assets/project_blocks/';

	const FORM_PREVIEW_NAME		= 'form_preview';
	const FORM_PREVIEW_W 		= 400;
	const FORM_PREVIEW_H 		= 300;

	const GRID_PREVIEW_NAME 	= 'grid_preview';
	const GRID_PREVIEW_W 		= 200;

	const WIDE_NAME 			= 'wide';
	const WIDE_W 				= 2400;

	const NARROW_NAME			= 'narrow';
	const NARROW_W 				= 1200;

	const FULLSCREEN_NAME 		= 'fs';
	const FULLSCREEN_W 			= 2800;

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
		self::WIDE_NAME => [
			'width'		=> self::WIDE_W,
			'mode'		=> self::RESIZE_MODE_MATCH_WIDTH,
			'quality'	=> 60,
		],
		self::NARROW_NAME => [
			'width'		=> self::NARROW_W,
			'mode'		=> self::RESIZE_MODE_MATCH_WIDTH,
			'quality'	=> 60,
		],
		self::FULLSCREEN_NAME => [
			'width'		=> self::FULLSCREEN_W,
			'mode'		=> self::RESIZE_MODE_MATCH_WIDTH,
			'quality'	=> 60,
		],
	];
}
