<?php

/**
 * Optimizes the search index
 *
 */
class Task_Index_Optimize extends Minion_Task
{
	protected function _execute(array $params)
	{
		// run the optimization only if there were any changes since the last optimization

		$index_related = Appsearch::open_index(Appsearch::INDEX_RELATED);
		$index_general = Appsearch::open_index(Appsearch::INDEX_GENERAL);
		$index_related->optimize();
		$index_general->optimize();
	}

}
