<?php defined('SYSPATH') OR die('No direct access allowed.');

/**
 * Checks the integrity of the assets
 *
 */
class Task_Assets_Integrity_Check extends Minion_Task {

	protected function _execute(array $params)
	{
		$avo_config = Kohana::$config->load('avo');
		
		foreach ($avo_config->get('orphan_models') as $model) {
			$has_storage = method_exists($model, 'storage');
			$has_img_storage = method_exists($model, 'img_storage');
			$has_file_storage = method_exists($model, 'file_storage');
			 
			if (!$has_storage && !$has_img_storage && !$has_file_storage) {
				Minion_CLI::write("WARNING: Model $model has no storage, img_storage or file_storage methods defined");
				continue;
			}
			
			foreach ($model::factory()->find_all() as $item) {
				if ($has_storage) {
					$path = $item->storage();
					if ($path && $item->{$model::$uid_field_name}) {
						if (!is_dir($path) && !is_file($path)) {
			 				Minion_CLI::write("storage asset not found: {$model}[{$item->id}] @$path");
						}
					}
				}
				if ($has_file_storage) {
					$path = $item->file_storage();
					if ($path) {
						// $item->{$model::$file_uid_field_name} is not checked
						if (!is_dir($path) && !is_file($path)) {
			 				Minion_CLI::write("file storage asset not found: {$model}[{$item->id}] @$path");
						}
					}
				}
				if ($has_img_storage) {
					$path = $item->img_storage();
					if ($path && $item->{$model::$img_ext_field_name}) {
						if (!is_dir($path) && !is_file($path)) {
			 				Minion_CLI::write("image storage asset not found: {$model}[{$item->id}] @$path");
						}
					}
				}
				
			}
		}
	}

}
