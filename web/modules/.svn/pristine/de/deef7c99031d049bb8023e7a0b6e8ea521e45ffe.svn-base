<?php defined('SYSPATH') OR die('No direct script access.');

class AVO_Validator_SQL_Date extends AVO_Abstract_Parametrized_Class {

	public $message;
	public $is_message_encoded = FALSE;

	public function __construct(array $properties = array())
	{
		parent::__construct($properties);
		if ( ! isset($properties['message'])) $this->message = __('invalid SQL date');
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
		if (preg_match('/^(\d{4})-(\d{1,2})-(\d{1,2})$/', $value, $matches))
		{
			if (checkdate($matches[2], $matches[3], $matches[1]))
			{
				return sprintf('%4d-%02d-%02d', $matches[1], $matches[2], $matches[3]);
			}
		}
		return FALSE;
	}
}