<?php defined('SYSPATH') or die('No direct script access.');
/**
 * HTML extended helper class.
 *
 * @package		AVO
 * @category	Helpers
 * @author		Alex Ostapov
 * @author		Sergey Solyanik
 */

class HTML extends Kohana_HTML {

	/**
	 * Creates a style sheet link element. Honors protocol relative URL.
	 *
	 *     echo HTML::style('media/css/screen.css');
	 *
	 * @param   string   file name
	 * @param   array    default attributes
	 * @param   mixed    protocol to pass to URL::base()
	 * @param   boolean  include the index page
	 * @return  string
	 * @uses    URL::base
	 * @uses    HTML::attributes
	 */
	public static function style($file, array $attributes = NULL, $protocol = NULL, $index = FALSE)
	{
		if (strpos($file, '://') === FALSE)
		{
			// skip processing of protocol relative URL, i.e. //maps.google.com/code.js
			if (strpos($file, '//') !== 0)
			{
				// Add the base URL
				$file = URL::site($file, $protocol, $index);
			}
		}

		// Set the stylesheet link
		$attributes['href'] = $file;

		// Set the stylesheet rel
		$attributes['rel'] = empty($attributes['rel']) ? 'stylesheet' : $attributes['rel'];

		// Set the stylesheet type
		$attributes['type'] = 'text/css';

		return '<link' . HTML::attributes($attributes) . ' />';
	}


	/**
	 * Creates a script link. Honors protocol relative URL.
	 *
	 *     echo HTML::script('media/js/jquery.min.js');
	 *
	 * @param   string  $file       file name
	 * @param   array   $attributes default attributes
	 * @param   mixed   $protocol   protocol to pass to URL::base()
	 * @param   boolean $index      include the index page
	 * @return  string
	 * @uses    URL::base
	 * @uses    HTML::attributes
	 */
	public static function script($file, array $attributes = NULL, $protocol = NULL, $index = FALSE)
	{
		if (strpos($file, '://') === FALSE)
		{
			// skip processing of protocol relative URL, i.e. //maps.google.com/code.js
			if (strpos($file, '//') !== 0)
			{
				// Add the base URL
				$file = URL::site($file, $protocol, $index);
			}
		}

		// Set the script link
		$attributes['src'] = $file;

		// Set the script type
		$attributes['type'] = 'text/javascript';

		return '<script'.HTML::attributes($attributes).'></script>';
	}


	/**
	 * Create HTML link anchors. Note that the title is not escaped, to allow
	 * HTML elements within links (images, etc).
	 * Honors protocol relative URL.
	 *
	 *     echo HTML::anchor('/user/profile', 'My Profile');
	 *
	 * @param   string  $uri        URL or URI string
	 * @param   string  $title      link text
	 * @param   array   $attributes HTML anchor attributes
	 * @param   mixed   $protocol   protocol to pass to URL::base()
	 * @param   boolean $index      include the index page
	 * @return  string
	 * @uses    URL::base
	 * @uses    URL::site
	 * @uses    HTML::attributes
	 */
	public static function anchor($uri, $title = NULL, array $attributes = NULL, $protocol = NULL, $index = TRUE)
	{
		if ($title === NULL)
		{
			// Use the URI as the title
			$title = $uri;
		}

		if ($uri === '')
		{
			// Only use the base URL
			$uri = URL::base($protocol, $index);
		}
		else
		{
			if (strpos($uri, '://') !== FALSE OR strpos($uri, '//') === 0)
			{
				if (HTML::$windowed_urls === TRUE AND empty($attributes['target']))
				{
					// Make the link open in a new window
					$attributes['target'] = '_blank';
				}
			}
			elseif ($uri[0] !== '#')
			{
				if (strpos($uri, '//') !== 0)
				{
					// Make the URI absolute for non-id anchors
					$uri = URL::site($uri, $protocol, $index);
				}
			}
		}

		// Add the sanitized link to the attributes
		$attributes['href'] = $uri;

		return '<a'.HTML::attributes($attributes).'>'.$title.'</a>';
	}


	/**
	 * Creates a image link. Honors protocol relative URL.
	 *
	 *     echo HTML::image('media/img/logo.png', array('alt' => 'My Company'));
	 *
	 * @param   string  $file       file name
	 * @param   array   $attributes default attributes
	 * @param   mixed   $protocol   protocol to pass to URL::base()
	 * @param   boolean $index      include the index page
	 * @return  string
	 * @uses    URL::base
	 * @uses    HTML::attributes
	 */
	public static function image($file, array $attributes = NULL, $protocol = NULL, $index = FALSE)
	{
		if (strpos($file, '://') === FALSE && !Text::starts_with($file, 'data:'))
		{
			// skip processing of protocol relative URL, i.e. //maps.google.com/code.js
			if (strpos($file, '//') !== 0)
			{
				// Add the base URL
				$file = URL::site($file, $protocol, $index);
			}
		}

		// Add the image link
		$attributes['src'] = $file;

		return '<img'.HTML::attributes($attributes).' />';
	}


	/**
	 * Returns encoded text with one of the keywords highlighted by wrapping into <span class="$class"></span>
	 *
	 * @param string $text
	 * @param array|string $keywords
	 * @param string $class
	 */
	public static function highlight($text, $keywords, $class = 'highlight') {
		if (!is_array($keywords)) $keywords = array($keywords);

		// longer keywords go first. If any other keyword is a part of the bigger keyword it is ignored
		usort($keywords, function ($a, $b) {
			return UTF8::strlen($b) - UTF8::strlen($a);
		});


		// spit the text by keywords
		$parts = array($text);
		$matches = array(false);

		foreach ($keywords as $kw) {
			$kw_len = UTF8::strlen($kw);
			$new_parts = array();
			$new_matches = array();
			foreach ($parts as $i => $part) {
				if ($matches[$i]) {
					$new_parts[] = $part;
					$new_matches[] = true;
					continue;
				}
				$pos = 0;
				do {
					$found = UTF8::stripos($part, $kw, $pos);
					if ($found !== FALSE) {
						$new_parts[] = UTF8::substr($part, $pos, $found - $pos); // the part before the keyword
						$new_matches[] = false;
						$new_parts[] = UTF8::substr($part, $found, $kw_len); // the keyword
						$new_matches[] = true;
						$pos = $found + $kw_len;
					} else {
						$new_parts[] = UTF8::substr($part, $pos); // the rest
						$new_matches[] = false;
					}
				} while ($found !== FALSE);
			}
			$parts = $new_parts;
			$matches = $new_matches;
		}

		// join the text back surrounding the keywords with the highlighting span
		$result = '';
		foreach ($parts as $i => $part) {
			if ($matches[$i]) {
				$result .= '<span class="' . $class . '">' . HTML::chars($part) . '</span>';
			} else {
				$result .= HTML::chars($part);
			}
		}
		return $result;
	}


	/**
	 * Returns a html encoded translated string
	 *
	 * @uses    I18n::get
	 * @param   string  text to translate
	 * @param   array   values to replace in the translated text
	 * @param   string  source language
	 * @return  string
	 */
	public static function __($string, array $values = NULL, $lang = 'en-us')
	{
		return self::chars(__($string, $values, $lang));
	}


	/**
	 * Returns a html encoded translated string where parameters are passed as HTML encoded strings
	 *
	 * @uses    I18n::get
	 * @param   string  text to translate
	 * @param   array   values to replace in the translated text
	 * @param   string  source language
	 * @return  string
	 */
	public static function ___($string, array $values = NULL, $lang = 'en-us')
	{
		$string = self::chars(__($string, NULL, $lang));
		return $values ? strtr($string, $values) : $string;
	}


	/**
	 * Creates a video.
	 *
	 *     echo HTML::video('media/video/logo.mp4', array('poster' => 'media/img/logo_poster.png'));
	 *
	 * @param   string   file name
	 * @param   array    default attributes
	 * @param   mixed    protocol to pass to URL::base()
	 * @param   boolean  include the index page
	 * @return  string
	 * @uses    URL::base
	 * @uses    HTML::attributes
	 */
	public static function video($file, array $attributes = NULL, $protocol = NULL, $index = FALSE)
	{
		if (strpos($file, '://') === FALSE)
		{
			// Add the base URL
			$file = URL::base($protocol, $index).$file;
		}

		if (isset($attributes['poster']) && strpos($attributes['poster'], '://') === FALSE)
		{
			// Add the base URL
			$attributes['poster'] = URL::base($protocol, $index).$attributes['poster'];
		}

		// Add the video link
		$attributes['src'] = $file;

		return '<video'.HTML::attributes($attributes).'>'.HTML::anchor($file, $file).'</video>';
	}


	/**
	 * Creates a Skype (skype:) anchor. Note that the title is not escaped,
	 * to allow HTML elements within links (images, etc).
	 *
	 *     echo HTML::skype($address);
	 *
	 * @param   string  Skype address (username) to send to
	 * @param   string  link text
	 * @param   array   HTML anchor attributes
	 * @return  string
	 * @uses    HTML::attributes
	 */
	public static function skype($skype, $title = NULL, array $attributes = NULL)
	{
		if ($title === NULL)
		{
			// Use the Skype address as the title
			$title = $skype;
		}

		return '<a href="&#115;&#107;&#121;&#112;&#101;&#058;'.$skype.'"'.HTML::attributes($attributes).'>'.$title.'</a>';
	}


	/**
	 * Creates a phone (tel:) anchor. Note that the title is not escaped,
	 * to allow HTML elements within links (images, etc).
	 *
	 *     echo HTML::tel($address);
	 *
	 * @param   string  Telephone number to send to
	 * @param   string  link text
	 * @param   array   HTML anchor attributes
	 * @return  string
	 * @uses    HTML::attributes
	 */
	public static function tel($tel, $title = NULL, array $attributes = NULL)
	{
		if ($title === NULL)
		{
			// Use the telephone number as the title
			$title = $tel;
		}

		$tel = preg_replace('/\D/', '', $tel);
		return '<a href="&#116;&#101;&#108;&#058;'.$tel.'"'.HTML::attributes($attributes).'>'.$title.'</a>';
	}


	/**
	 * Creates a javascript (javascript:) anchor. Note that the title is not escaped,
	 * to allow HTML elements within links (images, etc).
	 *
	 *     echo HTML::javascript($address);
	 *
	 * @param   string  javascript code
	 * @param   string  link text
	 * @param   array   HTML anchor attributes
	 * @return  string
	 * @uses    HTML::attributes
	 */
	public static function javascript($code, $title = NULL, array $attributes = NULL)
	{
		if ($title === NULL)
		{
			$title = $code;
		}

		return '<a href="javascript:'.$code.'"'.HTML::attributes($attributes).'>'.$title.'</a>';
	}

}
