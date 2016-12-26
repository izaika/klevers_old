<?php defined('SYSPATH') OR die('No direct script access.');

abstract class ORM extends Kohana_ORM {

	/**
	 * Default values for fields
	 *
	 * @var array
	 */
	protected $_default_values;

	/**
	 * Is the validation endabled
	 *
	 * @var boolean
	 */
	protected $_is_validation_enabled = TRUE;


	public function __construct($id = NULL)
	{
		parent::__construct($id);

		if ( ! $this->loaded() AND $this->_default_values)
		{
			foreach ($this->_default_values as $field => $value)
			{
				$this->{$field} = $value;
			}
		}
	}

	protected function _validation()
	{
		// Build the validation object with its rules
		$this->_validation = Validation::factory($this->_object)
			->bind(':model', $this)
			->bind(':original_values', $this->_original_values)
			->bind(':changed', $this->_changed);

		if ($this->_is_validation_enabled)
		{
			foreach ($this->rules() as $field => $rules)
			{
				$this->_validation->rules($field, $rules);
			}

		}

		// Use column names by default for labels
		$columns = array_keys($this->_table_columns);

		// Merge user-defined labels
		$labels = array_merge(array_combine($columns, $columns), $this->labels());
		
		foreach ($labels as $field => $label)
		{
			$this->_validation->label($field, $label);
		}
	}


	/**
	 * disables the model validation on check / save
	 *
	 */
	public function enable_validation()
	{
		$this->_is_validation_enabled = TRUE;
	}


	/**
	 * enables the model validation on check / save
	 *
	 */
	public function disable_validation()
	{
		$this->_is_validation_enabled = FALSE;
	}


	/**
	 * Allows serialization of only the object data and state, to prevent
	 * "stale" objects being unserialized, which also requires less memory.
	 *
	 * @return string
	 */
	public function serialize()
	{
		// Store only information about the object
		foreach (array('_primary_key_value', '_object', '_changed', '_loaded', '_saved', '_sorting', '_original_values') as $var)
		{
			$data[$var] = $this->{$var};
		}

		$data['_related'] = array();
		foreach($this->_related as $alias => $related_object)
		{
			if ($related_object->loaded() AND ! $related_object->_reload_on_wakeup)
			{
				$data['_related'][$alias] = $related_object;
			}
		}

		return serialize($data);
	}


	/**
	 * Creates and returns a new model.
	 *
	 * @chainable
	 * @param   string  $model  Model name
	 * @param   mixed   $id     Parameter for find()
	 * @return  ORM
	 */
	public static function factory($model = NULL, $id = NULL)
	{
		if ( ! $model)
		{
			$class_name = get_called_class();
			return new $class_name($id);
		}
		else
		{
			return Kohana_ORM::factory($model, $id);
		}
	}


	/**
	 * resets the column to the original value making it unchanged
	 *
	 * @param string $column
	 */
	public function reset_column($column)
	{
		if (array_key_exists($column, $this->_object))
		{
			// See if the data really changed
			if ($this->changed($column))
			{
				$this->_object[$column] = $this->_original_values[$column];
			}
		}
		elseif ( ! isset($this->_belongs_to[$column]))
		{
			throw new Kohana_Exception('The :property: property does not exist in the :class: class',
				array(':property:' => $column, ':class:' => get_class($this)));
		}

		return $this;
	}



	/**
	 * Checks if a column exists in the model instance
	 *
	 * @param   string  $name  Column name
	 * @return  bool
	 */
	public function has_column($name)
	{
		return array_key_exists($name, $this->_object);
	}


	/**
	 * Tests if id is valid
	 *
	 * @param integer $id ID to check
	 * @return boolean
	 */
	public static function is_valid_id($id)
	{
   		return static::factory(NULL, $id)->loaded();
	}


	/**
	 * Tests if id is valid
	 *
	 * @param integer $id ID to check
	 * @return boolean
	 */
	public function valid_id($id)
	{
		return static::is_valid_id($id);
	}


	/**
	 * Tests if id is valid
	 * @param integer $id ID to check
	 * @return boolean
	 */
	public function valid_id_or_null($id)
	{
		return ($id === NULL) ? TRUE : $this->valid_id($id);
	}


	/**
	 * Fills the ORM fields with the data from another ORM object
	 *
	 * @param ORM $obj
	 * @return ORM
	 */
	public static function clone_from(ORM $obj)
	{
		$clone = static::factory();
		$clone->unserialize($obj->serialize());

		return $clone;
	}

}
