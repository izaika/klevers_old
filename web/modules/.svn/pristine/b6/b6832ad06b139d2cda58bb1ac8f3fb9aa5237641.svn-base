<?php

/**
 * Fixes the ownership and permittions for media files and directories
 *
 */
class Task_Garbage_Collect extends Minion_Task
{

	protected function _execute(array $params)
	{
		AVO_Controller::collect_garbage(true);
	}

}
