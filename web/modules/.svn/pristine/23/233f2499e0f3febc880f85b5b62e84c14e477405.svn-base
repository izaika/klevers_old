<?php defined('SYSPATH') or die('No direct script access.');

class AVO_Validator_Range extends AVO_Abstract_Parametrized_Class {

	public $message;
	public $is_message_encoded = FALSE;
	public $min;
	public $max;

	public function __construct(array $properties = array()) {
		parent::__construct($properties);
		if (!isset($properties['message'])) $this->message = __('value must be in range (:min to :max)', array(':min' => $this->min, ':max' => $this->max));
	}

	public function validate(AVO_Field $field, AVO_Controls_List $controls = NULL) {
		$val = $field->value();
		// Allow NULL value here since we have a special validator for not allowing NULL
		if ($val === NULL) return TRUE;
		return self::is_valid($val, $this->min, $this->max);
	}

	public static function is_valid($value, $min, $max) {
		return ($value >= $min && $value <= $max);
	}
}
