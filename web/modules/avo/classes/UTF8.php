<?php defined('SYSPATH') or die('No direct script access.');

class UTF8 extends Kohana_UTF8 {

	/**
	 * Finds position of first case-insensitive occurrence of a UTF-8 string. This is a
	 * UTF8-aware version of [strpos](http://php.net/strpos).
	 *
	 *     $position = UTF8::stripos($str, $search);
	 *
	 * @author  Alex Ostapov <ostapov@gmail.com>
	 * @param   string   haystack
	 * @param   string   needle
	 * @param   integer  offset from which character in haystack to start searching
	 * @return  integer  position of needle
	 * @return  boolean  FALSE if the needle is not found
	 * @uses    UTF8::$server_utf8
	 */
	public static function stripos($haystack, $needle, $offset = 0) {
		if ($offset) $haystack = self::substr($haystack, $offset);
		$found = self::stristr($haystack, $needle);
		if ($found) {
			return $offset + self::strlen($haystack) - self::strlen($found);
		} else {
			return FALSE;
		}
	}


	/**
	 * Returns a string or an array with all occurrences of search in subject
	 * (ignoring case) and replaced with the given replace value. This is a
	 * UTF8-aware version of [str_ireplace](http://php.net/str_ireplace).
	 *
	 * [!!] This function is very slow compared to the native version. Avoid
	 * using it when possible.
	 *
	 * @author  Alex Ostapov ostapov@gmail.com
	 * @param   string|array  text to replace
	 * @param   string|array  replacement text
	 * @param   string|array  subject text
	 * @param   integer       number of matched and replaced needles will be returned via this parameter which is passed by reference
	 * @return  string        if the input was a string
	 * @return  array         if the input was an array
	 */
	public static function str_ireplace($search, $replace, $str, & $count = NULL)
	{
		if (UTF8::is_ascii($search) AND UTF8::is_ascii($replace) AND UTF8::is_ascii($str))
			return str_ireplace($search, $replace, $str, $count);

		if (is_array($str))
		{
			foreach ($str as $key => $val)
			{
				$str[$key] = UTF8::str_ireplace($search, $replace, $val, $count);
			}
			return $str;
		}

		if (is_array($search))
		{
			$keys = array_keys($search);

			foreach ($keys as $k)
			{
				if (is_array($replace))
				{
					if (array_key_exists($k, $replace))
					{
						$str = UTF8::str_ireplace($search[$k], $replace[$k], $str, $count);
					}
					else
					{
						$str = UTF8::str_ireplace($search[$k], '', $str, $count);
					}
				}
				else
				{
					$str = UTF8::str_ireplace($search[$k], $replace, $str, $count);
				}
			}
			return $str;
		}

		$search = UTF8::strtolower($search);
		$str_lower = UTF8::strtolower($str);

		$total_matched_strlen = 0;
		$i = 0;

		while (preg_match('/(.*?)'.preg_quote($search, '/').'/s', $str_lower, $matches))
		{
			$matched_strlen = strlen($matches[0]);
			$str_lower = substr($str_lower, $matched_strlen);

			$offset = $total_matched_strlen + strlen($matches[1]) + ($i * (strlen($replace)));
			$str = substr_replace($str, $replace, $offset, strlen($search));

			$total_matched_strlen += $matched_strlen - strlen($search);
			$i++;
		}

		$count += $i;
		return $str;
	}


	/**
	 * Performs UTF-8 aware strtr
	 * @param string $str
	 * @param string|array $from
	 * @param array $to
	 * @return string
	 */
	public static function strtr($str, $from, $to = NULL)
	{
		$keys = array();
		$values = array();
		if (! is_array($from)) {
			preg_match_all('/./u', $from, $keys);
			preg_match_all('/./u', $to, $values);
			$mapping = array_combine($keys[0], $values[0]);
		} else
			$mapping = $from;
		return strtr($str, $mapping);
	}

}
