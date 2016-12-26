<?php

/**
 * Restores the database from the dump
 *
 */
class Task_Db_Restore extends Minion_Task
{

	protected function _execute(array $params)
	{
		$project_path = dirname(dirname(APPPATH));
		$db_name = $project_name = basename($project_path);
		$home_path = trim(`cd && pwd`);
		$db_path = dirname(dirname(APPPATH)) . DIRECTORY_SEPARATOR . 'db' . DIRECTORY_SEPARATOR;

		if (!is_file("{$db_path}dump.sql") || !is_file("{$db_path}createdb.sql")) {
			Minion_CLI::write('Dump or the database creating dump are not found');
			return;
		}

		Minion_CLI::write('creating the database…');
		if(!Kohana::$is_windows) {
			Minion_CLI::write(shell_exec('cat ' . escapeshellarg("$db_path/createdb.sql") . ' |mysql -u root -h localhost'));
		} else {
			Minion_CLI::write(shell_exec('type ' . escapeshellarg("$db_path/createdb.sql") . ' |mysql -u root -h localhost'));
		}
		Minion_CLI::write('restoring the database…');
		if (!Kohana::$is_windows) {
			$total_bytes = filesize($db_path . '/dump.sql');

			// open the process for reading
			$descriptorspec = array(
				0 => array("pipe", "r"),
				1 => array("pipe", "w"),
				2 => array("pipe", "w")
			);
			$command = 'LANG=C sed \'s/DEFINER=`[^`]*`@`[^`]*`/DEFINER=CURRENT_USER/g\' ' . escapeshellarg($db_path . '/dump.sql');
			$process_read = proc_open($command, $descriptorspec, $read_pipes);


			// open the process for writing
			$descriptorspec = array(
				0 => array("pipe", "r"),
				1 => array("pipe", "w"),
				2 => array("pipe", "w")
			);
			$command = 'mysql -u root -h localhost ' . escapeshellarg($db_name);
			$process_write = proc_open($command, $descriptorspec, $write_pipes);


			$complete = 0;
			$start = time();
			while ($s = fgets($read_pipes[1], 32768)) {
				fwrite($write_pipes[0], $s);
				$complete += strlen($s);
				$progress = min(1, $complete / $total_bytes) * 100;
				$spent = time() - $start;
				$seconds_remaining = ($progress > 0) ? ($spent / $progress * 100 - $spent) : 0;
				Minion_CLI::write_replace(sprintf("Restoring: %0.2d%% remaining time: %d seconds", $progress, $seconds_remaining));
			}
			fclose($read_pipes[1]);
			fclose($write_pipes[0]);
			Minion_CLI::write("");
			Minion_CLI::write("Restored in: " . (time() - $start) . ' seconds');

		} else {
			Minion_CLI::write(shell_exec('mysql -u root -h localhost ' . escapeshellarg($db_name).' < '. escapeshellarg($db_path . '/dump.sql')));
		}
	}

}
