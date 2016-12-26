<?php defined('SYSPATH') or die('No direct script access.');

class AVO_Validator_Email extends AVO_Abstract_Parametrized_Class {

	public $message;
	public $allow_multiply_addresses = false;
	public $is_message_encoded = false;

	public function __construct(array $properties = array()) {
		parent::__construct($properties);
		if (!isset($properties['message'])) $this->message = __('invalid email');
	}

	public function validate(AVO_Field $field, AVO_Controls_List $controls = null) {
		$val = $field->value();
		if ($val === null) return true;
		if ($this->allow_multiply_addresses) {
			$result = self::is_multiply_valid($val);
			if ($result) $field->value($val);
			return $result;
		} else {
			return self::is_valid($val);
		}
	}

	public static function is_multiply_valid(&$str) {
		$emails = preg_split('/[ ,;:]+/', $str);
		$result = array();
		foreach ($emails as $email) {
			if (self::is_valid($email)) {
				$result[] = $email;
			} else {
				return false;
			}
		}
		$str = implode(',', $result);
		return true;
	}

	public static function is_valid($str) {
		if (!filter_var($str, FILTER_VALIDATE_EMAIL)) {
			return false;
		}

		// use not so strict Kohana validator for now
		return Valid::email($str);

		/*
		// Validate the domain exists with a DNS check
		// if the checks cannot be made (soft fail over to true)
		list ($user, $domain) = explode('@', $str);
		if (function_exists('checkdnsrr')) {
			if (!checkdnsrr($domain, 'MX')) {	// Linux: PHP 4.3.0 and higher & Windows: PHP 5.3.0 and higher
				return false;
			}
		} elseif (function_exists('getmxrr')) {
			if (!getmxrr($domain, $mxhosts)) {
				return false;
			}
		}
		return true;
		*/
	}
}

