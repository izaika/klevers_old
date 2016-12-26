<?php defined('SYSPATH') or die('No direct script access.');

class AVO_Validator_Time extends AVO_Abstract_Parametrized_Class {

	public $message;
	public $is_message_encoded = false;

	public function __construct(array $properties = array()) {
		parent::__construct($properties);
		if (!isset($properties['message'])) $this->message = __('invalid time');
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
		if (preg_match('/^(\d{1,2})\:(\d{2})\:(\d{2})$/', $value, $matches)) {
			$_hh = (int) $matches[1];
			$_mm = (int) $matches[2];
			$_ss = (int) $matches[3];
			if ($_hh >= 0 && $_hh <= 23 && $_mm >= 0 && $_mm <= 59 && $_ss >= 0 && $_ss <= 59) {
				return sprintf('%02d:%02d:%02d', $_hh, $_mm, $_ss);
			}
		}
		return false;
	}
}