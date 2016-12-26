<?php defined('SYSPATH') OR die('No direct script access.');

class AVO_Validator_Phonenumber extends AVO_Abstract_Parametrized_Class {

	public $message;
	public $is_message_encoded = FALSE;


	public function __construct(array $properties = array())
	{
		parent::__construct($properties);
		if ( ! isset($properties['message'])) $this->message = __('invalid phone number');
	}


	public function validate(AVO_Field $field, AVO_Controls_List $controls = NULL)
	{
		$val = $field->value();
		if ($val === NULL) return TRUE;
		$result = self::is_valid($val);
		if ($result !== FALSE)
		{
			$field->value($result);
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	public static function is_valid($value)
	{
		// match according Regular Expressions Cookbook and E.123
		if (preg_match('/^\+((?:[0-9][\s-]?){6,14}[0-9])$/', $value, $matches)) {
			// remove \s and -
			return sprintf('+%s', preg_replace('/[\s-]/', '', $matches[1]));
		}
		return FALSE;
	}
}