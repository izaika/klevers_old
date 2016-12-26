<?php defined('SYSPATH') or die('No direct script access.');

class AVO_Validator_Phone_No_Mobile extends AVO_Abstract_Parametrized_Class {

	public $message;
	public $is_message_encoded = false;

	public function __construct(array $properties = array()) {
		parent::__construct($properties);
		if (!isset($properties['message'])) $this->message = __('invalid mobile phone number');
	}

	public function validate(AVO_Field $field, AVO_Controls_List $controls = null) {
		$val = $field->value();
		if ($val === null) return true;
		$result = self::is_valid($val);
		if ($result !== false) {
			$field->value($result);
			return true;
		} else {
			return false;
		}
	}

	public static function is_valid($value) {
		// match according Regular Expressions Cookbook and http://en.wikipedia.org/wiki/Telephone_numbers_in_Norway
		if (preg_match('/^([49][0-9]{7})$/', $value, $matches)) {
			return sprintf('%s', $matches[1]);
		}
		return false;
	}
}