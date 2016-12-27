<?php

class Model_Homeslide extends Model_Generic_Image
{
	public static $STORAGE_PATH = 'assets/homeslides/';

	const FORM_PREVIEW_NAME = 'form_preview';
	const FORM_PREVIEW_W = 400;
	const FORM_PREVIEW_H = 300;

	const GRID_PREVIEW_NAME = 'grid_preview';
	const GRID_PREVIEW_W = 200;

	const NORMAL_NAME = 'normal';
	const NORMAL_W = 2880;
	const NORMAL_H = 1800;

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
			'height'	=> self::NORMAL_H,
			'mode'		=> self::RESIZE_MODE_MATCH_OUTSIDE_CROP,
			'quality'	=> 60,
		],
	];
}
