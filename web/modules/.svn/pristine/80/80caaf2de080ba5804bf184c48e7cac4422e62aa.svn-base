<?php defined('SYSPATH') OR die('No direct access allowed.');

/**
 * Compiles the LESS stylesheets
 *
 */
class Task_Less_Compile extends Minion_Task {

	protected $_options = array(
		'formatted' => false,
	);

	protected function _execute(array $params)
	{
		$formatted = $params['formatted'] ? (bool) $params['formatted'] : false;

		$project_path = dirname(dirname(APPPATH));

		$lessc = 'lessc';
		$cssdir = DOCROOT.'css';

		$files = explode("\n", shell_exec('find '.escapeshellarg($cssdir).' -name \'*.less\''));
		// remove the last empty line
		array_pop($files);

		if ($formatted) {
			$options = '';
		} else {
			$options = ' --clean-css="--s1 --advanced --compatibility=ie8"';
		}

		foreach ($files as $less_file)
		{
			$css_file = preg_replace('/.less$/', '.css', $less_file);

			Minion_CLI::write(shell_exec(escapeshellcmd($lessc).' '.escapeshellarg($less_file).' '.escapeshellarg($css_file).$options));
		}
	}
}
