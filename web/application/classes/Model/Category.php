<?php


class Model_Category extends ORM
{
	public $_sorting = array('ord' => 'ASC');

	protected $_has_many = [
	    // 'projects' => [
	    //     'model'   => 'Category_Project',
	    //     'through' => 'categories_projects',
	    //     'far_key'	=> 'project_id',
	    //     'foreign_key'	=> 'category_id',
	    // ],
	    'categories' => [
	        'model'   		=> 'Category',
	        'foreign_key'	=> 'category_id',
	    ],
	];

	protected $_belongs_to = [
	    'category' => [
	        'model'   		=> 'Category',
	        'foreign_key'	=> 'category_id',
	    ],
	];

	public function get_url($use_url_site = false) {
		if ($use_url_site) {
			return URL::site('/товары/'.$this->url_title);
		} else {
			return '/товары/'.$this->url_title;
		}
	}
}
