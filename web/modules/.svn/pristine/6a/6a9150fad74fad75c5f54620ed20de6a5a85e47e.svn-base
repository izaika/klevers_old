<?php defined('SYSPATH') OR die('No direct script access.');

class AVO_Controls_List extends ArrayObject {

	private $_controls_hash;

	private $_model;

	public $parent;

	/**
	 * Object constructor
	 * items passed as an array. If an item is of the AVO_Controls_List the array is flatterened
	 *
	 * @param mixed $array
	 */
	public function __construct($array)
	{
		$normalized = array();
		foreach ($array as $item)
		{
			if ($item instanceof self)
			{
				foreach ($item as $subitem)
				{
					$normalized[] = $subitem;
				}
			}
			else
			{
				$normalized[] = $item;
			}
		}

		parent::__construct($normalized);
	}


	public function __clone()
	{
		foreach ($this as &$field)
		{
			$field = clone $field;
		}
		$this->_controls_hash = NULL;
	}


	public function init_with($owner)
	{
		$this->parent = $owner;
		foreach ($this as $field)
		{
			if ($field instanceof AVO_Field)
			{
				$field->init_with($this);
			}
		}
	}


	/**
	 * Multiply parameters for adding is supported
	 * @see ArrayObject::append()
	 */
	public function append($value)
	{
		foreach (func_get_args() as $value)
		{
			if ($value instanceof self)
			{
				foreach ($value as $subitem)
				{
					$this->append($subitem);
				}
			}
			else
			{
				parent::append($value);
			}
		}
	}


	public function model($value = NULL) {
		// is a setter mode call?
		if (func_num_args())
		{
			$this->_model = $value;
		}
		return $this->_model;
	}


	public function render()
	{
		$result = '[';
		$i = 0;
		foreach ($this as $field)
		{
			if (! $field instanceof AVO_Field OR ! $field->server_side_only)
			{
				if ($i++) $result .= ',';
				$result .= $field->render();
			}
		}
		return $result . ']';
	}


	/**
	 * finds a key field in the controls list
	 * @return AVO_Field
	 */
	public function get_key_field()
	{
		$id_ctl = null;
		foreach ($this as $control)
		{
			if ($control instanceof AVO_Field)
			{
				if ($control->key) return $control;
				if ($control->name == 'id')
				{
					$id_ctl = $control;
				}
			}
		}
		return $id_ctl;
	}

	/**
	 * Magic function so that $obj->value will work.
	 *
	 * @param string $name
	 * @return mixed
	 */
	public function __get($name)
	{
		if ($this->_controls_hash === null)
		{
			$this->_controls_hash = array();
			foreach ($this as $control)
			{
				$this->_controls_hash[$control->name] = $control;
			}
		}
		if (isset($this->_controls_hash[$name])) return $this->_controls_hash[$name];

		return NULL;
	}


	/**
	 * Performs validation of the fields values against the corresponding validators
	 *
	 * @return bool
	 */
	public function validate($parameters = NULL)
	{
		$validation = array();
		foreach ($this as $field) {
			if ($field instanceof AVO_Field) {
				// for lookup field check if the value is from the valid options
				if ($field->type == AVO_Field::TYPE_LOOKUP && $field->value() !== null) {
					$ctl_list = new AVO_Controls_List(array(
						new AVO_Field(array(
							'name'			=> $field->lookup_key_field_name,
							'type'			=> $field->lookup_type,
							'key'			=> true,
							'value'			=> $field->value()
						))
					));
					$field->setup_lookup_datasource();
					if (!$field->lookup_datasource->find($ctl_list, $parameters)) {
						$validation[] = array($field->name, __('Validation: invalid_value'), false);
						continue;
					}
				}
				if ($field->is_validator_enabled) {
					if (is_array($field->validator)) {
						foreach ($field->validator as $validator) {
							if (!$validator->validate($field, $this)) {
								if (property_exists($validator, 'hide_field_name') AND $validator->hide_field_name) {
									$validation[] = array(null, $validator->message, $validator->is_message_encoded);
								} else {
									$validation[] = array($field->name, $validator->message, $validator->is_message_encoded);
								}
								break;
							}
						}
					} elseif ($field->validator !== null && $field->validator != '') {
						$validator = $field->validator;
						if (!$validator->validate($field, $this)) {
							if (property_exists($validator, 'hide_field_name') AND $validator->hide_field_name) {
								$validation[] = array(null, $validator->message, $validator->is_message_encoded);
							} else {
								$validation[] = array($field->name, $validator->message, $validator->is_message_encoded);
							}
						}
					}
				}
			}
		}

		return $validation;
	}

}