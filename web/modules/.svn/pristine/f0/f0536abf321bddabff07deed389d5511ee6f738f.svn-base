<?php defined('SYSPATH') OR die('No direct script access.');

class AVO_Validator_Custom extends AVO_Abstract_Parametrized_Class {

	public $message;
	public $is_message_encoded = false;
	public $on_validate;

	public function __construct(array $properties = array())
	{
		parent::__construct($properties);
	}

	public function validate(AVO_Field $field, AVO_Controls_List $controls = null)
	{
		return call_user_func($this->on_validate, $field, $controls);
	}

}
