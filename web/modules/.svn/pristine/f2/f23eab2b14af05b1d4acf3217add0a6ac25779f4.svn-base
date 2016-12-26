<?php defined('SYSPATH') OR die('No direct access allowed.');

class Model_Keyword extends Model {

	/**
	 * Save new keywords to the database
	 *
	 * @param string $name
	 * @return mixed
	 */
	public static function save_keywords($str)
	{
		if (Database::instance() instanceof Database_MsSQL) {
			$query = 'IF NOT EXISTS (SELECT * FROM keywords WHERE tag = :tag)
				   INSERT INTO keywords (tag) VALUES (:tag)';
		} else {
			$query = 'REPLACE INTO keywords (tag) VALUES (:tag)';
		}
		
		foreach (explode(',', $str) as $tag) {
			DB::query(Database::INSERT, $query)->param(':tag', $tag)->execute();
		}
	}


	/**
	 * sanitize the keywords list string
	 *
	 * @param string $str
	 * @return string
	 */
	public static function filter_list($str)
	{
		return implode(',', array_unique(array_filter(array_map('UTF8::trim', explode(',', UTF8::strtolower($str))), 'strlen')));
	}

}