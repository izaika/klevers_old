<?php defined('SYSPATH') OR die('No direct access allowed.');

class Model_Variable extends Model {

	protected $_reload_on_wakeup = FALSE;

	/**
	 * Returns a variable value by its name
	 *
	 * @param string $name
	 * @return mixed
	 */
	public static function value_by_name($name, $cached = FALSE, $expression = NULL)
	{
		$query = DB::query(Database::SELECT,
			'SELECT kind, :char_val AS char_val, :text_val AS text_val, :int_val AS int_val, :datetime_val AS datetime_val
			FROM variables
			WHERE str_id = :str_id'
		)->param(':str_id', $name);

		if ($expression)
		{
			$query->param(':char_val', DB::expr($expression)->param(':value', DB::expr('char_val')))
				->param(':text_val', DB::expr($expression)->param(':value', DB::expr('text_val')))
				->param(':int_val', DB::expr($expression)->param(':value', DB::expr('int_val')))
				->param(':datetime_val', DB::expr($expression)->param(':value', DB::expr('datetime_val')));
		}
		else
		{
			$query->param(':char_val', DB::expr('char_val'))
				->param(':text_val', DB::expr('text_val'))
				->param(':int_val', DB::expr('int_val'))
				->param(':datetime_val', DB::expr('datetime_val'));
		}

		if ($cached) $query->cached(is_numeric($cached) ? $cached : NULL);
		$result = $query->execute();
		$kind = $result->get('kind');
		if (!$kind) return NULL;
		return $result->get($kind . '_val');
	}


	/**
	 * Saves a variable value by its name
	 *
	 * @param string $name
	 */
	public static function save_value_by_name($name, $value)
	{
		if (Database::instance() instanceof  Database_MsSQL)
		{
			$kind = DB::query(Database::SELECT, 'SELECT kind FROM variables WHERE str_id = :str_id')->param(':str_id', $name)->execute()->get(0);
			switch ($kind) {
				case 'char':
					$query = DB::query(Database::UPDATE, 'UPDATE variables SET char_val = :value WHERE str_id = :str_id');
					break;
				case 'text':
					$query = DB::query(Database::UPDATE, 'UPDATE variables SET text_val = :value WHERE str_id = :str_id');
					break;
				case 'int':
					$query = DB::query(Database::UPDATE, 'UPDATE variables SET int_val = :value WHERE str_id = :str_id');
					break;
				case 'datetime':
					$query = DB::query(Database::UPDATE, 'UPDATE variables SET datetime_val = :value WHERE str_id = :str_id');
					break;
				default:
					// we ignore fail here
					// throw new Kohana_Exception(':cl, :fu: variable ":n" kind is not char, text, int or datetime. Or not found at all.', array(':cl' => __CLASS__, ':fu' => __FUNCTION__, ':n' => $name));
					break;
			}
			$query->param(':str_id', $name)->param(':value', $value)->execute();
		}
		else
		{
			$query = DB::query(Database::UPDATE,
				"UPDATE variables
				SET
					char_val = CASE kind WHEN 'char' THEN :value ELSE char_val END,
					text_val = CASE kind WHEN 'text' THEN :value ELSE text_val END,
					int_val = CASE kind WHEN 'int' THEN :value ELSE int_val END,
					datetime_val = CASE kind WHEN 'datetime' THEN :value ELSE datetime_val END
				WHERE str_id = :str_id"
			)->param(':str_id', $name)->param(':value', $value)->execute();
		}
	}

	
	public static function inc($name, $incrementation = 1)
	{
		self::save_value_by_name($name, DB::expr('int_val + :value')->param(':value', $incrementation));
	}
	

	/**
	 * Creates a datasource for managing a series of variables
	 *
	 * @param string $name - multiply variable names are allowed
	 */
	public static function get_datasource($name)
	{
		$find_query = 'SELECT 1 AS id';
		$update_from = $find_from = 'FROM ';
		$update_where = $find_where = 'WHERE ';
		$update_query = 'UPDATE ';
		$update_set = 'SET ';
		$is_mssql = (Database::instance() instanceof  Database_MsSQL);
		foreach (func_get_args() as $i => $name)
		{
			$table_alias = "v_$name";

			if ($is_mssql)
			{
				$find_query .= ", (CASE $table_alias.kind WHEN 'char' THEN CAST($table_alias.char_val AS NTEXT)
					WHEN 'text' THEN CAST($table_alias.text_val AS NTEXT)
					WHEN 'int' THEN CAST(CAST($table_alias.int_val AS NVARCHAR) AS NTEXT)
					WHEN 'datetime' THEN CAST(CAST($table_alias.datetime_val AS NVARCHAR) AS NTEXT)
					ELSE NULL END) AS $name ";
			}
			else
			{
				$find_query .= ", (CASE $table_alias.kind WHEN 'char' THEN $table_alias.char_val
					WHEN 'text' THEN $table_alias.text_val
					WHEN 'int' THEN $table_alias.int_val
					WHEN 'datetime' THEN $table_alias.datetime_val
					ELSE NULL END) AS $name ";
			}
			if ($i) $update_set .= ', ';
			$update_set .= "$table_alias.char_val = IF($table_alias.kind = 'char', :$name, $table_alias.char_val),
				$table_alias.text_val = IF($table_alias.kind = 'text', :$name, $table_alias.text_val),
				$table_alias.int_val = IF($table_alias.kind = 'int', :$name, $table_alias.int_val),
				$table_alias.datetime_val = IF($table_alias.kind = 'datetime', :$name, $table_alias.datetime_val) ";
			if ($i)
			{
				$part = "JOIN variables $table_alias ON $table_alias.str_id = '$name' ";
				$find_from .= $part;
				$update_query .= $part;
			}
			else
			{
				$part = "variables $table_alias ";
				$find_from .= $part;
				$update_query .= $part;

				$part = "$table_alias.str_id = '$name' ";
				$find_where .= $part;
				$update_where .= $part;
			}
		}

		return new AVO_Data_Source_DB(array(
			'find_query'	=> $find_query . $find_from . $find_where,
			'update_query'	=> $update_query . $update_set . $update_where,
		));

	}

	
}
