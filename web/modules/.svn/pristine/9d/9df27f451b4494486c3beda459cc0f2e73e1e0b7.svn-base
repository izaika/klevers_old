<?php defined('SYSPATH') or die('No direct script access.');

class URL extends Kohana_URL {

	/**
	 * checks if the specified url is external (has protocol part)
	 *
	 */
	public static function is_external($url) {
		return ($url != '' && preg_match('#^(http|https|ftp)\://#i', $url));
	}


	public static function append_url_params($url, $params) {
		$result = $url;
		if (count($params)) {
			if (!Text::contains($url, '?')) {
				$result .= '?';
			}
			if (!Text::ends_with($result, '?') && !Text::ends_with($result, '&')) {
				$result .= '&';
			}
			$i = 0;
			foreach ($params as $key => $val) {
				if ($val !== null) {
					if ($i++) $result .= '&';
					$result .= rawurlencode($key);
					if ($val !== '') {
						$result .= '=' . rawurlencode($val);
					}
				}
			}
		}
		return $result;
	}

	/**
	 * Fetches an absolute site URL based on a URI segment, with external full and relative url support.
	 *
	 *     echo URL::absolute_url('foo/bar');
	 *     echo URL::absolute_url('://extern.al/foo/bar');
	 *     echo URL::absolute_url('mailto:aaaa@nnnn.com');
	 *     echo URL::absolute_url('tel:123456789123456');
	 *
	 * @param   string  $uri        URI to convert
	 * @param   mixed   $protocol   protocol to pass to URL::base() or URL::site()
	 * @param   boolean $index      include the index page
	 * @return  string
	 */
	public static function absolute_url($uri, $protocol = NULL, $index = TRUE) {
		if ($uri == '')
		{
			// Only use the base URL
			$uri = URL::base($protocol, $index);
		}
		else
		{
			$uri = (
				(strpos($uri, '://') !== FALSE || strpos($uri, '//') === 0 || preg_match('/^\w+:.*$/', $uri))
					? $uri
					: (
						($uri[0] !== '#')
							? $uri
							: URL::site($uri, $protocol, $index)
					)
			);
		}

		return $uri;
	}


	/**
	 * fixes the url by adding the protocol specification if missing
	 *
	 * @param $url
	 */
	public static function add_proto($url, $proto = 'http') {
		if ($url != '' && !preg_match('#^https?\://#i', $url)) {
			return $proto . '://' . $url;
		} else {
			return $url;
		}
	}

	public static function google_address($address, $city = null, $zip = null, $country = null) {
		if ($city === null && $zip === null && $country === null) {
			return rawurlencode($address);
		} else {
			return rawurlencode((($address != '') ? ($address . ', ' . $zip . ' ') : '') . $city . ', ' . $country, false);
		}
	}


	public static function google_maps($address, $city = null, $zip = null, $country = null) {
		return 'http://maps.google.com/maps?q=' . self::google_address($address, $city, $zip, $country);
	}


	public static function google_maps_direction($from_address, $from_city, $from_zip, $from_country, $to_address, $to_city = null, $to_zip = null, $to_country = null) {
		return 'http://maps.google.com/maps?saddr=' . self::google_address($from_address, $from_city, $from_zip, $from_country) .
			'&daddr=' . self::google_address($to_address, $to_city, $to_zip, $to_country);
	}

}