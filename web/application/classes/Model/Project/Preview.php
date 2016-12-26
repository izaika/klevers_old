<?php

class Model_Project_Preview extends Model_Project
{
	protected $_table_name				= 'projects';
	public static $STORAGE_PATH			= 'assets/projects_previews/';

	public static $title_field_name 	= 'preview_title';
	public static $ext_field_name 		= 'preview_ext';
	public static $uid_field_name 		= 'preview_uid';
	public static $width_field_name 	= 'preview_width';
	public static $height_field_name	= 'preview_height';

	const FORM_PREVIEW_NAME = 'form_preview';
	const FORM_PREVIEW_W = 400;
	const FORM_PREVIEW_H = 300;

	const GRID_PREVIEW_NAME = 'grid_preview';
	const GRID_PREVIEW_W = 200;

	const NORMAL_NAME = 'normal';
	const NORMAL_W = 2400;

	const FULLSCREEN_NAME = 'fs';
	const FULLSCREEN_W = 2800;

	const HOMEPAGE_PREVIEW_NAME	= 'hp';
	const HOMEPAGE_PREVIEW_W	= 850;

	const RELATED_PREVIEW_NAME	= 'rp';
	const RELATED_PREVIEW_W		= 1320;
	const RELATED_PREVIEW_H		= 786;

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
		self::FULLSCREEN_NAME => [
			'width'		=> self::FULLSCREEN_W,
			'mode'		=> self::RESIZE_MODE_MATCH_WIDTH,
			'quality'	=> 60,
		],
		self::HOMEPAGE_PREVIEW_NAME => [
			'width'		=> self::HOMEPAGE_PREVIEW_W,
			'mode'		=> self::RESIZE_MODE_MATCH_WIDTH,
			'quality'	=> 60,
		],
		self::RELATED_PREVIEW_NAME => [
			'width'		=> self::RELATED_PREVIEW_W,
			'height'	=> self::RELATED_PREVIEW_H,
			'mode'		=> self::RESIZE_MODE_MATCH_OUTSIDE_CROP,
			'quality'	=> 60,
		],
	];
}
