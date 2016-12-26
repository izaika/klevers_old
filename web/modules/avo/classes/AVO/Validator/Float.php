<?php defined('SYSPATH') or die('No direct script access.');

class AVO_Validator_Float extends AVO_Abstract_Parametrized_Class {

	public $message;
	public $is_message_encoded = FALSE;

	public function __construct(array $properties = array()) {
		parent::__construct($properties);
		if (!isset($properties['message'])) $this->message = __('value must be a float');
	}

	public function validate(AVO_Field $field, AVO_Controls_List $controls = NULL) {
		$val = $field->value();
		// Allow NULL value here since we have a special validator for not allowing NULL
		if ($val === NULL) return TRUE;
		return self::is_valid($val);
	}

	public static function is_valid($value) {
		// Special treat for filter_var(), since we may encounter value of 0,
		// which is valid float, and we needt to return TRUE
		return (filter_var($value, FILTER_VALIDATE_FLOAT) !== FALSE);
	}
}
