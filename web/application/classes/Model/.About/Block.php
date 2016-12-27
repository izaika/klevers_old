<?php

class Model_About_Block extends Model_Generic_Image
{
	const TYPE_IMAGE_AND_TEXT	= 0;
	const TYPE_IMAGE			= 1;
	const TYPE_TEXT				= 2;

	protected $_sorting = array('ord' => 'ASC');

	public static $STORAGE_PATH = 'assets/about_blocks/';

	const FORM_PREVIEW_NAME		= 'form_preview';
	const FORM_PREVIEW_W 		= 400;
	const FORM_PREVIEW_H 		= 254;

	const GRID_PREVIEW_NAME 	= 'grid_preview';
	const GRID_PREVIEW_W 		= 200;
	const GRID_PREVIEW_H 		= 127;

	const NORMAL_NAME 			= 'normal';
	const NORMAL_W 				= 1500;
	const NORMAL_H 				= 952;

	const FULLSCREEN_NAME 		= 'fs';
	const FULLSCREEN_W 			= 2800;

	public static $SIZES = [
		self::FORM_PREVIEW_NAME => [
			'width'		=> self::FORM_PREVIEW_W,
			'height'	=> self::FORM_PREVIEW_H,
			'mode'		=> self::RESIZE_MODE_MATCH_OUTSIDE_CROP,
			'quality'	=> 60,
		],
		self::GRID_PREVIEW_NAME => [
			'width'		=> self::GRID_PREVIEW_W,
			'height'	=> self::GRID_PREVIEW_H,
			'mode'		=> self::RESIZE_MODE_MATCH_OUTSIDE_CROP,
			'quality'	=> 60,
		],
		self::NORMAL_NAME => [
			'width'		=> self::NORMAL_W,
			'height'	=> self::NORMAL_H,
			'mode'		=> self::RESIZE_MODE_MATCH_OUTSIDE_CROP,
			'quality'	=> 60,
		],
		self::FULLSCREEN_NAME => [
			'width'		=> self::FULLSCREEN_W,
			'mode'		=> self::RESIZE_MODE_MATCH_WIDTH,
			'quality'	=> 60,
		],
	];


	public function get_index_data($type)
	{
		switch ($type) {
			case Appsearch::INDEX_GENERAL:
				return [
					['name'	=> 'block_id',	 	'type' => 'unIndexed',	'value' => $this->id 							],
					['name'	=> 'name',			'type' => 'text',		'value' => $this->heading,		'boost' => 1	],
					['name'	=> 'info',			'type' => 'unStored',	'value' => $this->body_text,	'boost' => 0.9	],
					['name'	=> 'url',			'type' => 'unIndexed',	'value' => $this->get_url()						],
					['name'	=> 'is_online',		'type' => 'unIndexed',	'value' => 1									],
				];

			default:
				return [];
		}
	}

	public function get_url($use_site_url = false)
	{
		if ($use_site_url) {
			return URL::site('/om-oss#block_'.$this->id);
		} else {
			return '/om-oss#block_'.$this->id;
		}
	}
}
