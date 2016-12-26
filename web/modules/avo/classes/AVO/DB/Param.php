<?php defined('SYSPATH') OR die('No direct script access.');

class AVO_DB_Param {

	const FIELD = 0;
	const PARAMETER = 1;
	const FILTER_VALUE = 1;

	/**
	 * parameter type
	 * @var integer
	 */
	public $type;
	/**
	 * parameter value
	 * @var mixed
	 */
	public $value;


	function __construct($type, $value)
	{
		$this->type = $type;
		$this->value = $value;
	}

	public static function factory($type, $sql)
	{
		return new self($type, $value);
	}

}
