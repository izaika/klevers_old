<?php defined('SYSPATH') OR die('No direct script access.');

class AVO_Validator_Positive extends AVO_Abstract_Parametrized_Class {

	public $message;
	public $is_message_encoded = FALSE;


	public function __construct(array $properties = array())
	{
		parent::__construct($properties);
		if ( ! isset($properties['message'])) $this->message = __('value must be positive');
	}


	public function validate(AVO_Field $field, AVO_Controls_List $controls = NULL)
	{
		$val = $field->value();
		if ($val === NULL) return TRUE;
		return self::is_valid($val);
	}


	public static function is_valid($value) {
		return ($value > 0);
	}

}
