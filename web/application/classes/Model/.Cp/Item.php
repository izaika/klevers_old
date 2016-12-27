<?php

class Model_Cp_Item extends ORM
{
	protected $_sorting = array('ord' => 'ASC');

	public function get_index_data($type)
	{
		switch ($type) {
			case Appsearch::INDEX_GENERAL:
				return [
					['name'	=> 'cp_id',		 	'type' => 'unIndexed',	'value' => $this->id 							],
					['name'	=> 'name',			'type' => 'text',		'value' => $this->heading,		'boost' => 1	],
					['name'	=> 'ingress',		'type' => 'unStored',	'value' => $this->short_text,	'boost' => 0.9	],
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
			return URL::site('/om-oss#cp_'.$this->id);
		} else {
			return '/om-oss#cp_'.$this->id;
		}
	}
}
