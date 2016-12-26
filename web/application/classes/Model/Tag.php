<?php

class Model_Tag extends ORM {
	protected $_reload_on_wakeup = false;

	protected $_has_many = [
	    'projects' => [
	        'model'   => 'Project_Tag',
	        'through' => 'projects_tags',
	    ],
	];
}
