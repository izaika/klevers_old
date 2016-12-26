<?php defined('SYSPATH') OR die('No direct access allowed.');

/**
 * Fixes the ownership and permittions for media files and directories
 *
 */
class Task_Fix_Permissions extends Minion_Task {

	protected function _execute(array $params)
	{
		$owner = (PHP_OS == 'Darwin') ? '_www' : 'www-data';
		$group = (PHP_OS == 'Darwin') ? '_www' : 'www-data';
		$dirs = array(APPPATH.'cache', APPPATH.'logs', APPPATH.'assets', DOCROOT.'assets');

		foreach ($dirs as $dir)
		{
			Minion_CLI::write(shell_exec('sudo chown -R '.escapeshellarg("$owner:$group").' '.escapeshellarg($dir)));
			Minion_CLI::write(shell_exec('sudo chmod -R g+Xrws '.escapeshellarg($dir)));
		}
	}

}
