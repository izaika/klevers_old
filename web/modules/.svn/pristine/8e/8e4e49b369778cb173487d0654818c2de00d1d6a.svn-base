<?php

/**
 * Saves the database to the dump
 *
 */
class Task_Db_Save extends Minion_Task
{

	protected function _execute(array $params)
	{
		$project_path = dirname(dirname(APPPATH));
		$db_name = $project_name = basename($project_path);
		$home_path = trim(`cd && pwd`);
		$save_path = dirname(dirname(APPPATH)) . DIRECTORY_SEPARATOR . 'db' . DIRECTORY_SEPARATOR;

		if (is_file("{$save_path}dump.sql")) {
			rename("{$save_path}dump.sql", "{$save_path}dump.bak");
		}

		Minion_CLI::write('saving the database…');
		Minion_CLI::write(shell_exec('mysqldump -u root -K -r ' . escapeshellarg($save_path.'dump.sql') . ' --skip-extended-insert --single-transaction ' . escapeshellarg($db_name)));
	}

}
