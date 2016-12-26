<?php

class Model_Project extends Model_Generic_Image
{
	public static $STORAGE_PATH = 'assets/projects/';

	protected $_has_many = [
		'blocks' => [
	        'model'   => 'Project_Block',
	        'foreign_key' => 'project_id',
	    ],
	    'tags' => [
	        'model'   => 'Tag',
	        'through' => 'projects_tags',
	    ],
	    'categories' => [
	        'model'   => 'Category',
	        'through' => 'categories_projects',
	        'far_key'	=> 'category_id',
	        'foreign_key'	=> 'project_id',
	    ],
	];

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

	public function get_index_data($type)
	{
		switch ($type) {
			case Appsearch::INDEX_RELATED:
				$tags = '';
				$categories = '';
				foreach ($this->tags->cached()->find_all() as $i => $t) {
					$tags .= $i ? ' '.$t->title : $t->title;
				}
				foreach ($this->categories->cached()->find_all() as $i => $c) {
					$categories .= $i ? ','.$c->id : $c->id;;
				}
				return [
					['name'	=> 'project_id', 	'type' => 'unIndexed',	'value' => $this->id],
					['name'	=> 'name',			'type' => 'unIndexed',	'value' => $this->name],
					['name'	=> 'heading',		'type' => 'unIndexed',	'value' => $this->heading],
					['name'	=> 'tags',			'type' => 'text',		'value' => $tags],
					['name'	=> 'categories',	'type' => 'unIndexed',	'value' => $categories],
					['name'	=> 'url',			'type' => 'unIndexed',	'value' => $this->get_url()],
					['name'	=> 'img_src',		'type' => 'unIndexed',	'value' => $this->url(self::RELATED_PREVIEW_NAME)],
					['name'	=> 'img_title',		'type' => 'unIndexed',	'value' => $this->title],
					['name'	=> 'is_online',		'type' => 'unIndexed',	'value' => $this->is_online],
				];
			case Appsearch::INDEX_GENERAL:
				$texts = '';
				foreach ($this->blocks->where('type', 'IN', [Model_Project_Block::TYPE_TEXT, Model_Project_Block::TYPE_QUOTE, Model_Project_Block::TYPE_CREDITS])->cached()->find_all() as $b) {
					$texts .= ' '.$b->body_text;
				}
				$result_arr = [
					['name'	=> 'project_id', 	'type' => 'unIndexed',	'value' => $this->id 						],
					['name'	=> 'name',			'type' => 'text',		'value' => $this->name,		'boost' => 0.5	],
					['name'	=> 'heading',		'type' => 'text',		'value' => $this->heading,	'boost' => 0.4	],
					['name'	=> 'ingress',		'type' => 'text',		'value' => $this->ingress,	'boost' => 0.3	],
					['name'	=> 'texts',			'type' => 'text',		'value' => $texts,			'boost' => 0.2	],
					['name'	=> 'location',		'type' => 'text',		'value' => $this->location,	'boost' => 0.1	],
					['name'	=> 'url',			'type' => 'unIndexed',	'value' => $this->get_url()					],
					['name'	=> 'is_online',		'type' => 'unIndexed',	'value' => $this->is_online					],
				];

				foreach ($this->tags->cached()->find_all() as $i => $t) {
					$result_arr[] = ['name' => "tag_$i", 'type' => 'keyword', 'value' => $t->title, 'boost' => 1];
				}
				return $result_arr;

			default:
				return [];
		}
	}


	/* URL for PDF */
	function url4pdf()
	{
		return self::$STORAGE_PATH.$this->id.'/'.$this->uid.'/'.self::NORMAL_NAME.'.'.$this->ext;
	}


	public function get_url($use_site_url = false)
	{
		if ($use_site_url) {
			return URL::site('/prosjekter/'.$this->url_title);
		} else {
			return '/prosjekter/'.$this->url_title;
		}
	}
}
