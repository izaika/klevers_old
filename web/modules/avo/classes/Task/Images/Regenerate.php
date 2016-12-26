<?php

class Task_Images_Regenerate extends Minion_Task
{
	protected $_options = array(
		'model' => NULL,
	);


	protected function _execute(array $params)
	{
		set_time_limit(0);
		$model = $params['model'];
		$model::regenerate_all();
		Minion_CLI::write('finished');
	}
}
