<?php

class Model_Homeproject  extends ORM
{
	public $_sorting = array('ord' => 'ASC');

	protected $_belongs_to = [
	    'project' => [
	        'model'       => 'Project',
	        'foreign_key' => 'project_id',
	    ],
	];
}
