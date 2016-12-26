<?php

/**
 * Text helper class. Provides simple methods for working with text.
 *
 * @package    AVO
 * @category   Helpers
 * @author     Alex Ostapov
 */
class Text extends Kohana_Text
{

	/**
	 * Checks whether a text string contains another string
	 *
	 * @param string $str
	 * @param string $value
	 */
	public static function contains($str, $substr, $case_insensitive = TRUE)
	{
		return (($case_insensitive ? stripos($str, $substr) : UTF8::strpos($str, $substr)) !== false);
	}


	/**
	 * Checks whether a text string starts with another string
	 *
	 * @param string $str
	 * @param string $value
	 */
	public static function starts_with($str, $value)
	{
		return (@substr_compare($str, $value, 0, strlen($value)) === 0 && strlen($str) >= strlen($value));
	}


	/**
	 * Checks whether a text string ends with another string
	 *
	 * @param string $str
	 * @param string $value
	 */
	public static function ends_with($str, $value)
	{
		$len = strlen($value);
		return (@substr_compare($str, $value, -$len, $len) === 0);
	}

	/**
	 * Converts the ANSI date-time string into the SQL datetime representation
	 *
	 * @param string $val
	 * @return null if the original value does not contain a propper string
	 * @return string - SQL representation
	 */
	public static function str2sqldatetime($val)
	{
		if (preg_match('/^(\d{1,2})[\/\.](\d{1,2})[\/\.](\d{4})(?: (\d{1,2})\:(\d{1,2})(?:\:(\d{1,2}))?)?$/', $val, $matches)) {
			$h = isset($matches[4]) ? $matches[4] : 0;
			$m = isset($matches[5]) ? $matches[5] : 0;
			$s = isset($matches[6]) ? $matches[6] : 0;
			return sprintf('%4d-%02d-%02d %02d:%02d:%02d', $matches[3], $matches[2], $matches[1], $h, $m, $s);
		}
		return NULL;
	}


	/**
	* Formats the datetime string returned by the sql server into a readable form
	*
	* @param string $val
	* @return string
	*/
	public static function sqldatetime2str($val, $delimiter = '.', $no_seconds = FALSE) {
		if (preg_match('/^(\d{4})-(\d{1,2})-(\d{1,2}) (\d{2})\:(\d{2})\:(\d{2})$/', $val, $matches)) {
			return sprintf('%02d%s%02d%s%04d %02d:%02d' . ($no_seconds ? '' : ':%02d'),
				$matches[3], $delimiter, $matches[2], $delimiter, $matches[1], $matches[4], $matches[5], $matches[6]);
		}
		return NULL;
	}


	/**
	 * Converts the ANSI date string into the SQL date representation
	 *
	 * @param string $val
	 * @return null if the original value does not contain a propper string
	 * @return string - SQL representation
	 */
	public static function str2sqldate($val)
	{
		if (preg_match('/^(\d{1,2})[\/\.](\d{1,2})[\/\.](\d{4})(?:\s.*)?$/', $val, $matches)) {
			// return sprintf('%4d-%02d-%02d 00:00:00', $matches[3], $matches[2], $matches[1]);
			return sprintf('%4d-%02d-%02d', $matches[3], $matches[2], $matches[1]);
		}
		return NULL;
	}


	/**
	* Formats the date string returned by the sql server into a readable form
	*
	* @param string $val
	* @return string
	*/
	public static function sqldate2str($val, $delimiter = '.')
	{
		if (preg_match('/^(\d{4})-(\d{1,2})-(\d{1,2})(?:\s.*)?/', $val, $matches))
		{
			return sprintf('%02d%s%02d%s%4d', $matches[3], $delimiter, $matches[2], $delimiter, $matches[1]);
		}
		return NULL;
	}


	/**
	 * Converts the money string into the integer representation for saving on the database.
	 * The fractional part is saved as the first two decimal of the integer
	 *
	 * @param string $str
	 * @return int
	 */
	public static function moneystr2int($str) {
		if (preg_match('/^\s*([+-])?(\d*)(?:\.(\d{0,2}))?\s*$/', $str, $matches)) {
			$i_euro = (int) (isset($matches[2])) ? $matches[2] : 0;
			$i_cents = (int) (isset($matches[3])) ? $matches[3] . str_repeat('0', 2 - strlen($matches[3])) : 0;
			$result = ($i_euro * 100 + $i_cents);
			if (isset($matches[1])) {
				$result = ($matches[1] == '-') ? -$result : $result;
			}
			return (is_int($result) ? $result : 0);
		} else {
			return 0;
		}
	}


	/**
	 * Converts the money string into the integer representation for saving on the database.
	 * The fractional part is saved as the first two decimal of the integer
	 * Return NULL if string is empty
	 *
	 * @param string $str
	 * @return NULL|int
	 */
	public static function moneystr2int_null_if_empty($str) {
		if ($str == '') return NULL;
		return static::moneystr2int($str);
	}


	/**
	 * Converts the integer database value into the money string.
	 * The fractional part is saved as the first two decimal of the integer
	 *
	 * @param int $int
	 * @return string
	 */
	public static function int2moneystr($int)
	{
		$i_int = (int) $int;
		if ($int != $i_int) return 'overflow';
		$s_int = sprintf('%+04d', $i_int);
		return sprintf('%s%s.%s', ((substr($s_int, 0, 1) == '-') ? '-' : ''), substr($s_int, 1, strlen($s_int) - 3), substr($s_int, -2, 2));
	}


	/**
	 * Returns a string representation of boolean true/false value
	 *
	 * @param boolean $val
	 * @return string
	 */
	public static function bool2str($val)
	{
		return ((bool) $val) ? 'true' : 'false';
	}


	/**
	 * Forms a valid CDATA block for placing into an XML document
	 *
	 * @param string $str
	 * @return string
	 */
	public static function cdata($str) {
		return '<![CDATA[' . str::fix_cdata($str) . ']]>';
	}

	/**
	 * Prepares a text to be inserted into a CDATA block
	 *
	 * @param string $str
	 * @return string
	 */
	public static function fix_cdata($str)
	{
		return str_replace(']]>', ']]]]><![CDATA[>', $str);
	}


	/**
	 * Returns a string with \, % and _ escaped for use in SQL queries
	 *
	 * @param string $str
	 * @return string
	 */
	public static function escape_sql_glob($str)
	{
		return UTF8::str_ireplace(array('%', '_', '\\'), array('\%', '\_', '\\\\'), $str);
	}


	/**
	 * Replaces all multy-character spaces with a single space
	 *
	 * @param string $str
	 * @return string
	 */
	public static function compress_spaces($str)
	{
		return preg_replace('/\s+/mu', ' ', $str);
	}


	/**
	 *
	 * Substitutes the value with NULL if it is an empty string
	 * @param string $str
	 * @return mixed
	 */
	public static function null_if_empty($str)
	{
		return ($str == '') ? NULL : $str;
	}


	/**
	 *
	 * Substitutes the value with NULL if it is an empty HTML string
	 * @param string $str
	 * @return mixed
	 */
	public static function null_if_empty_html($str)
	{
	    return Valid::not_empty_html($str) ? $str : NULL;
	}


	/**
	 * Finds the common beginning part of two strings
	 * @param string $sample1
	 * @param string $sample2
	 * @return string
	 */
	public static function common_beginning($sample1, $sample2)
	{
		if ($sample1 == $sample2) return $sample1;
		$min_length = min(UTF8::strlen($sample1), UTF8::strlen($sample2));
		for ($i = 0; $i < $min_length; $i++) {
			if (UTF8::substr($sample1, $i, 1) != UTF8::substr($sample2, $i, 1)) break;
		}
		return UTF8::substr($sample1, 0, $i);
	}

}
