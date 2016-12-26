<?php defined('SYSPATH') OR die('No direct access allowed.');

/**
 * Clears the Kohana file cache
 *
 */
class Task_Cache_Clear extends Minion_Task {

	protected function _execute(array $params)
	{
		File::clear_cache();
	}

}
