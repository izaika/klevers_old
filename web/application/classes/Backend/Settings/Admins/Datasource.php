<?php defined('SYSPATH') OR die('No direct script access.');

class Backend_Settings_Admins_Datasource extends AVO_Data_Source_DB {

	public function __construct(array $array = array())
	{
		parent::__construct($array);

		$this->count_query = 'SELECT COUNT(*) FROM administrators';
		$this->select_query	= 'SELECT * FROM administrators';
		$this->find_query = 'SELECT * FROM administrators WHERE id = :id';
		$this->delete_query	= 'DELETE FROM administrators WHERE id = :id';
		$this->update_query	=
			'UPDATE administrators
			SET
				login = :login,
				full_name = :full_name,
				email = :email,
				modified = CURRENT_TIMESTAMP,
				modify_count = modify_count + 1
			WHERE
				id = :id';
		$this->insert_query	=
			'INSERT INTO administrators (login, password, full_name, email, created)
			VALUES (:login, "", :full_name, :email, CURRENT_TIMESTAMP)';
		$this->custom_errors = array(
			'/^Duplicate entry \'.+?\' for key \'login\'/' => array('login', __('duplicate value')),
			'/^Duplicate entry \'.+?\' for key \'email\'/' => array('email', __('duplicate value')),
		);
		$this->model_class_name = 'Model_Administrator';
	}

}
