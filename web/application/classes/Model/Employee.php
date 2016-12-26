<?php

class Model_Employee extends Model_Generic_Image
{
	protected $_sorting = array('ord' => 'ASC');

	public static $STORAGE_PATH = 'assets/employees/';

	const FORM_PREVIEW_NAME		= 'form_preview';
	const FORM_PREVIEW_W 		= 240;
	const FORM_PREVIEW_H 		= 315;

	const GRID_PREVIEW_NAME 	= 'grid_preview';
	const GRID_PREVIEW_W 		= 200;
	const GRID_PREVIEW_H 		= 262;

	const NORMAL_NAME 			= 'normal';
	const NORMAL_W 				= 720;
	const NORMAL_H 				= 945;

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
	];


	public function get_index_data($type)
	{
		switch ($type) {
			case Appsearch::INDEX_GENERAL:
				return [
					['name'	=> 'person_id', 	'type' => 'unIndexed',	'value' => $this->id 						],
					['name'	=> 'name',			'type' => 'text',		'value' => $this->name,		'boost' => 1	],
					['name'	=> 'info',			'type' => 'unStored',	'value' => $this->info,		'boost' => 0.9	],
					['name'	=> 'url',			'type' => 'unIndexed',	'value' => $this->get_url()					],
					['name'	=> 'is_online',		'type' => 'unIndexed',	'value' => 1								],
				];

			default:
				return [];
		}
	}

	public function get_url($use_site_url = false)
	{
		if ($use_site_url) {
			return URL::site('/om-oss#employee_'.$this->id);
		} else {
			return '/om-oss#employee_'.$this->id;
		}
	}
}
