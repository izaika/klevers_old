<?php defined('SYSPATH') OR die('No direct script access.');

class Date extends Kohana_Date {

	protected static $_last_date = NULL;
	protected static $_last_date_day = NULL;
	protected static $_last_date_month = NULL;
	protected static $_last_date_year = NULL;


	protected static function _extract_parts($date)
	{
		if (static::$_last_date === $date) return;
		static::$_last_date = $date;

		// timestamp ?
		if (is_int($date))
		{
			static::$_last_date_year = (int) date('Y', $date);
			static::$_last_date_month = (int) date('n', $date);
			static::$_last_date_day = (int) date('j', $date);
		}
		else
		{
			// sql date/timestamp
			$date_obj = new DateTime($date);
			static::$_last_date_year = (int) $date_obj->format('Y');
			static::$_last_date_month = (int) $date_obj->format('n');
			static::$_last_date_day = (int) $date_obj->format('j');
		}
	}


	public static function extract_year($date)
	{
		static::_extract_parts($date);
		return static::$_last_date_year;
	}


	public static function extract_month($date)
	{
		static::_extract_parts($date);
		return static::$_last_date_month;
	}


	public static function extract_day($date)
	{
		static::_extract_parts($date);
		return static::$_last_date_day;
	}

}
