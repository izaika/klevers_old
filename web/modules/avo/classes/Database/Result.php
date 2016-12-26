<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Database result wrapper
 *
 * @package    AVO/Database
 * @category   Query/Result
 * @author     Alex Ostapov
 * @copyright  (c) 2001-2011 Alex Ostapov
 */
abstract class Database_Result extends Kohana_Database_Result {

	/**
	 * Return the named/numbered column from the current row
	 *
	 *     // Get the "id" value
	 *     $id = $result->get('id');
	 *
	 *     // Get the 2nd column value
	 *     $id = $result->get(1);
	 *
	 * @param   mixed   column to get
	 * @param   mixed   default value if the column does not exist
	 * @return  mixed
	 */
	public function get($name, $default = NULL)	{
		if (is_string($name)) return parent::get($name, $default);

		// handle the case when the $name is integer
		$row = $this->current();
		if (!$row) return $default;

		if ($this->_as_object) {
			$vars = get_object_vars($row);
			$i = 0;
			foreach ($vars as $field_name) {
				if ($i++ == $name) return $row->$field_name;
			}
		} else {
			$i = 0;
			foreach ($row as $field_name => $value) {
				if ($i++ == $name) return $value;
			}
		}

		return $default;
	}

} // End Database_Result
