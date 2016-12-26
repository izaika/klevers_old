<?php defined('SYSPATH') or die('No direct script access.');

class AVO_Validator_Date_Time extends AVO_Abstract_Parametrized_Class {

	public $message;
	public $is_message_encoded = false;

	public function __construct(array $properties = array()) {
		parent::__construct($properties);
		if (!isset($properties['message'])) $this->message = __('invalid date/time');
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
		if (preg_match('/^(\d{1,2})[\/\.](\d{1,2})[\/\.](\d{4})(?: (\d{1,2})\:(\d{1,2})(?:\:(\d{1,2}))?)?$/', $value, $matches)) {
			$h = isset($matches[4]) ? $matches[4] : 0;
			$m = isset($matches[5]) ? $matches[5] : 0;
			$s = isset($matches[6]) ? $matches[6] : 0;
			if (checkdate($matches[2], $matches[1], $matches[3]) && $h >= 0 && $h <= 23 && $m >= 0 && $m <= 59 && $s >= 0 && $s <= 59) {
				return sprintf('%02d.%02d.%4d %02d:%02d:%02d', $matches[1], $matches[2], $matches[3], $h, $m, $s);
			}
		}
		return false;
	}
}
