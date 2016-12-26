<?php defined('SYSPATH') or die('No direct script access.');

class AVO_Validator_Password_Match extends AVO_Abstract_Parametrized_Class {

	public $message;
	public $match_field;
	public $is_message_encoded = false;

	public function __construct(array $properties = array()) {
		parent::__construct($properties);
		if (!isset($properties['message'])) $this->message = __('passwords mismatch');
	}

	public function validate(AVO_Field $field, AVO_Controls_List $controls) {
		if ($this->match_field === null) return false;
		return self::is_valid($field->value(), $controls->{$this->match_field}->value());
	}

	public static function is_valid($value1, $value2) {
		return ($value1 === $value2);
	}
}
