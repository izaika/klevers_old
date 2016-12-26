<?php defined('SYSPATH') or die('No direct script access.');

/**
 * This is a subject to change:
 *
 * - 1st item
 * - 2nd item
 *
 * @package    AVO
 * @category   Base
 * @author     Alex Ostapov
 * @copyright  (c) 2000-2011 Alex Ostapov
 */
class AVO {

	public static function setup_auto_base_url() {
		// determine the base url
		$filename = (isset($_SERVER['SCRIPT_FILENAME'])) ? basename($_SERVER['SCRIPT_FILENAME']) : '';

		if (isset($_SERVER['SCRIPT_NAME']) && basename($_SERVER['SCRIPT_NAME']) === $filename) {
			$base_url = $_SERVER['SCRIPT_NAME'];
		} elseif (isset($_SERVER['PHP_SELF']) && basename($_SERVER['PHP_SELF']) === $filename) {
			$base_url = $_SERVER['PHP_SELF'];
		} elseif (isset($_SERVER['ORIG_SCRIPT_NAME']) && basename($_SERVER['ORIG_SCRIPT_NAME']) === $filename) {
			$base_url = $_SERVER['ORIG_SCRIPT_NAME']; // 1and1 shared hosting compatibility
		} else {
			// Backtrack up the script_filename to find the portion matching
			// php_self
			$path    = isset($_SERVER['PHP_SELF']) ? $_SERVER['PHP_SELF'] : '';
			$file    = isset($_SERVER['SCRIPT_FILENAME']) ? $_SERVER['SCRIPT_FILENAME'] : '';
			$segs    = explode('/', trim($file, '/'));
			$segs    = array_reverse($segs);
			$index   = 0;
			$last    = count($segs);
			$base_url = '';
			do {
				$seg     = $segs[$index];
				$base_url = '/' . $seg . $base_url;
				++$index;
			} while (($last > $index) && (false !== ($pos = strpos($path, $base_url))) && (0 != $pos));
		}

		// Does the baseUrl have anything in common with the request_uri?
		if (isset($_SERVER['HTTP_X_REWRITE_URL'])) { // check this first so IIS will catch
			$request_uri = $_SERVER['HTTP_X_REWRITE_URL'];
		} elseif (isset($_SERVER['REQUEST_URI'])) {
			$request_uri = $_SERVER['REQUEST_URI'];
			// Http proxy reqs setup request uri with scheme and host [and port] + the url path, only use url path
			$scheme = isset($_SERVER['HTTPS']) ? 'https' : 'http';
			if (empty($_SERVER['HTTP_HOST'])) {
		        $name   = @$_SERVER['SERVER_NAME'];
		        $port   = @$_SERVER['SERVER_PORT'];
		        if (($scheme == 'http' && $port == 80) || ($scheme == 'https' && $port == 443)) {
		            $host = $name;
		        } else {
		            $host = $name . ':' . $port;
		        }
			} else {
				$host = $_SERVER['HTTP_HOST'];
			}
			$scheme_and_http_host = $scheme . '://' . $host;
			if (strpos($request_uri, $scheme_and_http_host) === 0) {
				$request_uri = substr($request_uri, strlen($scheme_and_http_host));
			}
		} elseif (isset($_SERVER['ORIG_PATH_INFO'])) { // IIS 5.0, PHP as CGI
			$request_uri = $_SERVER['ORIG_PATH_INFO'];
			if (!empty($_SERVER['QUERY_STRING'])) {
				$request_uri .= '?' . $_SERVER['QUERY_STRING'];
			}
		} else {
			$request_uri = '';
		}

		if (0 === strpos($request_uri, $base_url)) {
			// full $base_url matches
		} elseif (0 === strpos($request_uri, dirname($base_url))) {
			// directory portion of $base_url matches
			$base_url = rtrim(dirname($base_url), '/');
		} elseif (!strpos($request_uri, basename($base_url))) {
			// no match whatsoever; set it blank
			$base_url = '';
		}

		// If using mod_rewrite or ISAPI_Rewrite strip the script filename
		// out of baseUrl. $pos !== 0 makes sure it is not matching a value
		// from PATH_INFO or QUERY_STRING
		if ((strlen($request_uri) >= strlen($base_url))
			&& ((false !== ($pos = @strpos($request_uri, $base_url))) && ($pos !== 0)))
		{
			$base_url = substr($request_uri, 0, $pos + strlen($base_url));
		}
		Kohana::$base_url = rtrim($base_url, '/') . '/';
	}
}
