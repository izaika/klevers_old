<?php defined('SYSPATH') OR die('No direct access allowed.');

/**
 * Creates an on-update/insert trigger for the table
 *
 * Available options:
 * - table - a name of the table to attache the triggers to. Must be provided
 *
 */
class Task_Db_Create_Trigger extends Minion_Task {

	protected $_options = array(
		'table' => NULL,
	);


	public function build_validation(Validation $validation)
	{
		return parent::build_validation($validation)
			->rule('table', 'not_empty'); // Require this param
	}


	protected function _execute(array $params)
	{
		$table = $params['table'];

		if (!Database::instance()->list_tables($table))
		{
			Minion_CLI::write('table is not found');
			return;
		}

		DB::query(Database::UPDATE,
			"CREATE TRIGGER `{$table}_BeforeInsert`
				BEFORE INSERT
				ON `{$table}`
					FOR EACH ROW
						SET NEW.`created` = IFNULL(NEW.`created`, NOW())"
		)->execute();

		DB::query(Database::UPDATE,
			"CREATE TRIGGER `{$table}_BeforeUpdate`
				BEFORE UPDATE
				ON `{$table}`
					FOR EACH ROW
						SET NEW.`modify_count` = OLD.`modify_count` + 1"
		)->execute();
	}

}
