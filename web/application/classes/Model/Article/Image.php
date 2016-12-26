<?php

class Model_Article_Image extends Model_Generic_Image
{
	public static $STORAGE_PATH = 'assets/blog_images/';

	protected $_belongs_to = [
	    'article' => [
	        'model'       => 'Article',
	        'foreign_key' => 'article_id',
	    ],
	];

	const FORM_PREVIEW_NAME	= 'form_preview';
	const FORM_PREVIEW_W 	= 400;
	const FORM_PREVIEW_H 	= 300;

	const GRID_PREVIEW_NAME = 'grid_preview';
	const GRID_PREVIEW_W 	= 200;

	const NORMAL_NAME 		= 'normal';
	const NORMAL_W 			= 852;

	const FULLSCREEN_NAME 	= 'fs';
	const FULLSCREEN_W 		= 2800;

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
	];
}
