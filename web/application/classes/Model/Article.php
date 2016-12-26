<?php

class Model_Article extends ORM
{
	public $_sorting = array('ord' => 'ASC');

	protected $_has_many = [
		'images' => [
	        'model' 		=> 'Article_Image',
	        'foreign_key'	=> 'article_id',
	    ],
		'tags' => [
	        'model'   => 'Tag',
	        'through' => 'articles_tags',
	    ],
	];


	public function get_index_data($type)
	{
		switch ($type) {
			case Appsearch::INDEX_GENERAL:
				$result_arr = [
					['name'	=> 'article_id', 	'type' => 'unIndexed',	'value' => $this->id 							],
					['name'	=> 'name',			'type' => 'text',		'value' => $this->heading,		'boost' => 0.6	],
					['name'	=> 'ingress',		'type' => 'text',		'value' => $this->body_text,	'boost' => 0.5	],
					['name'	=> 'url',			'type' => 'unIndexed',	'value' => $this->get_url()						],
					['name'	=> 'is_online',		'type' => 'unIndexed',	'value' => 1									],
				];

				foreach ($this->tags->cached()->find_all() as $i => $t) {
					$result_arr[] = ['name' => "tag_$i", 'type' => 'keyword', 'value' => $t->title, 'boost' => 1];
				}
				return $result_arr;

			default:
				return [];
		}
	}

	public function get_url($use_site_url = false)
	{
		if ($use_site_url) {
			return URL::site('/blogg#article_'.$this->id);
		} else {
			return '/blogg#article_'.$this->id;
		}
	}
}
