<?php defined('SYSPATH') or die('No direct script access.');

class AVO_Validator_Fail extends AVO_Abstract_Parametrized_Class {

	public $message;
	public $is_message_encoded = false;

	public function __construct(array $properties = array()) {
		parent::__construct($properties);
	}

	public function validate(AVO_Field $field, AVO_Controls_List $controls = null) {
		return false;
	}

	public static function is_valid($value) {
		return false;
	}
}
