<?php defined('SYSPATH') OR die('No direct access allowed.');

/**
 * Genric image model
 * saved to variables
 * @author alex ostapov
 *
 * @property int id
 */

class Model_Generic_Variables_Cropable_Image extends Model_Generic_Cropable_Image {

	protected $_cached = FALSE;

	/**
	 * Updates or Creates the record depending on loaded()
	 *
	 * @chainable
	 * @param  Validation $validation Validation object
	 * @return ORM
	 */
	public function save(Validation $validation = NULL)
	{
		if ($this->loaded())
		{
			Model_Variable::save_value_by_name(static::$alt_field_name, $this->{static::$alt_field_name});
			Model_Variable::save_value_by_name(static::$title_field_name, $this->{static::$title_field_name});
			Model_Variable::save_value_by_name(static::$ext_field_name, $this->{static::$ext_field_name});
			Model_Variable::save_value_by_name(static::$uid_field_name, $this->{static::$uid_field_name});
			Model_Variable::save_value_by_name(static::$width_field_name, $this->{static::$width_field_name});
			Model_Variable::save_value_by_name(static::$height_field_name, $this->{static::$height_field_name});
			Model_Variable::save_value_by_name(static::$crop_data_field_name, $this->{static::$crop_data_field_name});
		}

		return $this;
	}


	/**
	 * Enables the query to be cached for a specified amount of time.
	 *
	 * @param   integer  number of seconds to cache
	 * @return  $this
	 * @uses    Kohana::$cache_life
	 */
	public function cached($lifetime = NULL)
	{
		$this->_cached = $lifetime ? $lifetime : TRUE;

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

		$this->_loaded = true;
		$this->id = 1;
		$this->{static::$alt_field_name} = Model_Variable::value_by_name(static::$alt_field_name, $this->_cached);
		$this->{static::$title_field_name} = Model_Variable::value_by_name(static::$title_field_name, $this->_cached);
		$this->{static::$ext_field_name} = Model_Variable::value_by_name(static::$ext_field_name, $this->_cached);
		$this->{static::$uid_field_name} = Model_Variable::value_by_name(static::$uid_field_name, $this->_cached);
		$this->{static::$width_field_name} = Model_Variable::value_by_name(static::$width_field_name, $this->_cached);
		$this->{static::$height_field_name} = Model_Variable::value_by_name(static::$height_field_name, $this->_cached);
		$this->{static::$crop_data_field_name} = Model_Variable::value_by_name(static::$crop_data_field_name, $this->_cached);

		return $this;
	}


	/**
	 * Proxy method to Database list_columns.
	 *
	 * @return array
	 */
	public function list_columns()
	{
		return array(
			'id' => array(
				'type'	=> 'int'
			),
			static::$alt_field_name => array(
				'type'	=> 'string'
			),
			static::$title_field_name => array(
				'type'	=> 'string'
			),
			static::$ext_field_name => array(
				'type'	=> 'string'
			),
			static::$uid_field_name => array(
				'type'	=> 'string'
			),
			static::$width_field_name => array(
				'type'	=> 'int'
			),
			static::$height_field_name => array(
				'type'	=> 'int'
			),
			static::$crop_data_field_name => array(
				'type'	=> 'string'
			),
		);
	}

}
