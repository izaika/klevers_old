<?php

/**
 * Class for use in ORM validation filters
 *
 */
class Filter
{

	/**
	 * leaves only digits in the string
	 *
	 * @param mixed $value
	 */
	public static function leave_digits($value)
	{
		return preg_replace('/[^0-9.]+/', '', $value);;
	}

	/**
	 * converts a value into SQL int
	 *
	 * @param mixed $value
	 */
	public static function sql_bool($value)
	{
		return Filter::boolint($value);
	}


	/**
	 * converts a value into SQL int
	 *
	 * @param mixed $value
	 */
	public static function sql_int($value)
	{
		return Text::null_if_empty(@intval($value));
	}


	/**
	 * Converts value into SQL varchar/text
	 *
	 * @param mixed $value
	 */
	public static function sql_text($value, $max_length = 128)
	{
		return Text::null_if_empty( Filter::limit(UTF8::trim(@strval($value)), $max_length) );
	}


	/**
	 * Converts html value into SQL varchar/text
	 *
	 * @param mixed $value
	 */
	public static function sql_html_text($value, $max_length = 65535)
	{
		return Text::null_if_empty_html( Filter::limit(UTF8::trim(@strval($value)), $max_length) );
	}


	/**
	 * Normalizes local url to relative
	 *
	 * @param mixed $value
	 */
	public static function local_url($value)
	{
		$site_base_url = URL::base(true);
		if (Text::starts_with($value, $site_base_url)) {
			return '/' . UTF8::substr($value, UTF8::strlen($site_base_url));
		}

		$site_base_url = URL::base();
		if (Text::starts_with($value, $site_base_url)) {
			return '/' . UTF8::substr($value, UTF8::strlen($site_base_url));
		}

		return $value;
	}



	/**
	 * Treats a value as boolean and returns 0 or 1
	 * @param mixed $value
	 */
	public static function boolint($value)
	{
		return (int) (bool) $value;
	}



	/**
	 * filters out all chars not allowed in UIDs
	 * only digits, latin letters _ and - are allowed
	 *
	 * @param string $value
	 */
	public static function uid($value)
	{
		return preg_replace('/[^a-z\d\-_]/i', '', $value);
	}

	/**
	 * Transform empty value to NULL
	 * @param mixed $value
	 * @return Ambigous <NULL, mixed>
	 */
	public static function null_if_empty($value)
	{
		return (empty($value) ? NULL : $value);
	}


	/**
	 * Limit string by length, cutting end
	 * @param mixed $value
	 * @return Ambigous <NULL, mixed>
	 */
	public static function limit($value, $len)
	{
		return Text::limit_chars($value, $len, '', false);
	}


	public static function compact_newlines($value)
	{
		$value = preg_replace('/(\n\r){3,}/', "\n\r", $value);
		$value = preg_replace('/(\r\n){3,}/', "\r\n", $value);
		$value = preg_replace('/\n{3,}/', "\n\n", $value);
		$value = preg_replace('/\r{3,}/', "\r\r", $value);
		return $value;
	}


	/**
	 * removes the non-valid characters for using as SEO description
	 *
	 * @param string $value
	 * @return string
	 */
	public static function seo_description($value)
	{
		return Text::compress_spaces(UTF8::str_ireplace(array('"', '\'', '<', '>'), ' ', html_entity_decode(strip_tags($value))));
	}


	/**
	 * filters out tags other than div, br, i, b and span(class="wysiwyg-color-highlight")
	 *
	 * @param string $value
	 */
	public static function basic_html($value)
	{
		// purify the html
		$config = HTMLPurifier_Config::createDefault();
		$config->set('Cache.SerializerPath', APPPATH.'cache');

		$purifier = new HTMLPurifier($config);
		$formatted_value = $purifier->purify($value);

		// since here we are working with a well-formed html so we can safely use regexp to do fixes

		// compress allowed tags
		$formatted_value = preg_replace('/<(br|b|strong|i|em|div|p) .*?>/i', '<$1>', $formatted_value);

		// convert p > div, strong > b, em > i
		$formatted_value = UTF8::str_ireplace(
			array('<p>', '</p>', '<strong>', '</strong>', '<em>', '</em>'),
			array('<div>', '</div>', '<b>', '</b>', '<i>', '</i>'),
			$formatted_value
		);

		// ' > " in span tags
		$count = 0;
		do
		{
			$formatted_value = preg_replace('/<span ([^>]*)\'([^>]*)>/i', '<span $1"$2>', $formatted_value, -1, $count);

		}
		while ($count);

		// keep only the class attribute in spans
		$formatted_value = preg_replace('/<span [^>]*(\bclass="[^"]*")[^>]*>/', '<span $1>', $formatted_value);

		// allow span only with class="wysiwyg-color-highlight"
		$formatted_value = preg_replace('/<span class="[^"]*?(\bwysiwyg-color-highlight\b)[^"]*?">/i', '<span class="wysiwyg-color-highlight">', $formatted_value);
		$formatted_value = preg_replace('/<span (?!class="wysiwyg-color-highlight)[^>]*>/i', '<span>', $formatted_value);

		// remove all tags except div br i b span
		$formatted_value = strip_tags($formatted_value, '<div><br><i><b><span>');

		return $formatted_value;
	}

}