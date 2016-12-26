<?php defined('SYSPATH') or die('No direct script access.');

abstract class AVO_Abstract_Parametrized_Class {

	public function __construct(array $array = array()) {
		foreach ($array as $field_name => $value) {
			$this->__set($field_name, $value);
		}
	}


	private function _report_undefined_property($name) {
		throw new Kohana_Exception('Using of undefined property :name', array(':name' => $name));
	}


	/**
	 * Retrieve a value and return $default if there is no element set.
	 *
	 * @param string $name
	 * @param mixed $default
	 * @return mixed
	 */
	public function get($name, $default = null) {
		if (property_exists($this, $name)) return $this->$name;
		$prop_name = '__' . $name;
		if (property_exists($this, $prop_name)) return $this->$prop_name;
		$this->_report_undefined_property($name);
		return $default;
	}


	/**
	 * Magic function so that $obj->value will work.
	 *
	 * @param string $name
	 * @return mixed
	 */
	public function __get($name) {
		return $this->get($name);
	}


	/**
	 * @param  string $name
	 * @param  mixed  $value
	 * @throws Zend_Config_Exception
	 * @return void
	 */
	public function __set($name, $value) {
		if (property_exists($this, $name)) {
			$this->$name = $value;
		} else {
			$prop_name = '__' . $name;
			if (property_exists($this, $prop_name)) {
				$this->$prop_name = $value;
			} else {
				$this->_report_undefined_property($name);
			}
		}
    }


	/**
	 * Support isset() overloading on PHP 5.1
	 *
	 * @param string $name
	 * @return boolean
	 */
	public function __isset($name) {
		if (property_exists($this, $name)) return isset($this->$name);
		$prop_name = '__' . $name;
		if (property_exists($this, $prop_name)) return isset($this->$prop_name);
		$this->_report_undefined_property($name);
		return false;
	}


    /**
     * Support unset() overloading on PHP 5.1
     *
     * @param  string $name
     * @throws Zend_Config_Exception
     * @return void
     */
	public function __unset($name) {
		if (property_exists($this, $name)) {
			unset($this->$name);
		} else {
			$prop_name = '__' . $name;
			if (property_exists($this, $prop_name)) {
				unset($this->$prop_name);
			} else {
				$this->_report_undefined_property($name);
			}
		}
	}
}