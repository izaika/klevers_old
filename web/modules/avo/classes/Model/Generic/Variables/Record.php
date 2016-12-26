<?php

/**
 * Base class for building the datasets basing on the records from variables
 *
 */
class Model_Generic_Variables_Record extends ORM
{

	protected $_cached = false;

	protected $_fields_map = [];


	public function update(Validation $validation = NULL)
	{
		if (!$this->_loaded) throw new Kohana_Exception('Cannot update :model model because it is not loaded.', array(':model' => $this->_object_name));

		// Run validation if the model isn't valid or we have additional validation rules.
		if (!$this->_valid || $validation) $this->check($validation);

		// Nothing to update
		if (empty($this->_changed)) return $this;

		foreach ($this->_changed as $column) {
			if ($column == $this->primary_key()) continue;
			Model_Variable::save_value_by_name($this->_fields_map[$column], $this->_object[$column]);
		}

		// Object has been saved
		$this->_saved = TRUE;

		// All changes have been saved
		$this->_changed = array();
		$this->_original_values = $this->_object;

		return $this;
	}


	/**
	 * Enables the query to be cached for a specified amount of time.
	 *
	 * @param   integer  number of seconds to cache
	 * @return  $this
	 * @uses    Kohana::$cache_life
	 */
	public function cached($lifetime = null)
	{
		$this->_cached = $lifetime ? $lifetime : true;

		return $this;
	}


	/**
	 * Finds and loads a single database row into the object.
	 *
	 * @chainable
	 * @return ORM
	 */
	public function find()
	{
		if ($this->_loaded) throw new Kohana_Exception('Method find() cannot be called on loaded objects');


		$values = ['id' => 1];
		foreach ($this->_fields_map as $field => $variable) {
			$values[$field] = Model_Variable::value_by_name($variable, $this->_cached);
		}
		$this->reset();
		$this->_load_values($values);

		return $this;
	}


	/**
	 * a helper method to get the record
	 *
	 * @return ORM
	 */
	static public function find_record($cached = true)
	{
		if ($cached) {
			return static::factory()->cached()->find();
		} else {
			return static::factory()->find();
		}
	}


	/**
	 * Proxy method to Database list_columns.
	 *
	 * @return array
	 */
	public function list_columns()
	{
		$columns = array(
			'id' => array(
				'type'	=> 'int'
			),
		);

		foreach ($this->_fields_map as $field => $variable) {
			$columns[$field] = array(
				'type'	=> 'string',
			);
		}

		return $columns;
	}
}

