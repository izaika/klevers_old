<?php defined('SYSPATH') OR die('No direct script access.');

class Request extends Kohana_Request {

	public $query_parameters = array();

	/**
	 * Creates a new request object for the given URI. New requests should be
	 * created using the [Request::instance] or [Request::factory] methods.
	 *
	 *     $request = Request::factory($uri);
	 *
	 * If $cache parameter is set, the response for the request will attempt to
	 * be retrieved from the cache.
	 *
	 * @param   string  $uri              URI of the request
	 * @param   array   $client_params    An array of params to pass to the request client
	 * @param   bool    $allow_external   Allow external requests? (deprecated in 3.3)
	 * @param   array   $injected_routes  An array of routes to use, for testing
	 * @return  void|Request
	 * @throws  Request_Exception
	 * @uses    Route::all
	 * @uses    Route::matches
	 */
	public static function factory($uri = TRUE, $client_params = array(), $allow_external = TRUE, $injected_routes = array())
	{
		// If this is the initial request
		if ( ! Request::$initial)
		{
			$protocol = HTTP::$protocol;
	
			if (isset($_SERVER['REQUEST_METHOD']))
			{
				// Use the server request method
				$method = $_SERVER['REQUEST_METHOD'];
			}
			else
			{
				// Default to GET requests
				$method = HTTP_Request::GET;
			}
	
			if (( ! empty($_SERVER['HTTPS']) AND filter_var($_SERVER['HTTPS'], FILTER_VALIDATE_BOOLEAN))
			OR (isset($_SERVER['HTTP_X_FORWARDED_PROTO'])
				AND $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https')
				AND in_array($_SERVER['REMOTE_ADDR'], Request::$trusted_proxies))
			{
				// This request is secure
				$secure = TRUE;
			}
	
			if (isset($_SERVER['HTTP_REFERER']))
			{
				// There is a referrer for this request
				$referrer = $_SERVER['HTTP_REFERER'];
			}
	
			if (isset($_SERVER['HTTP_USER_AGENT']))
			{
				// Browser type
				Request::$user_agent = $_SERVER['HTTP_USER_AGENT'];
			}
	
			if (isset($_SERVER['HTTP_X_REQUESTED_WITH']))
			{
				// Typically used to denote AJAX requests
				$requested_with = $_SERVER['HTTP_X_REQUESTED_WITH'];
			}
	
			if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])
			AND isset($_SERVER['REMOTE_ADDR'])
			AND in_array($_SERVER['REMOTE_ADDR'], Request::$trusted_proxies))
			{
				// Use the forwarded IP address, typically set when the
				// client is using a proxy server.
				// Format: "X-Forwarded-For: client1, proxy1, proxy2"
				$client_ips = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
	
				Request::$client_ip = array_shift($client_ips);
	
				unset($client_ips);
			}
			elseif (isset($_SERVER['HTTP_CLIENT_IP'])
				AND isset($_SERVER['REMOTE_ADDR'])
				AND in_array($_SERVER['REMOTE_ADDR'], Request::$trusted_proxies))
			{
				// Use the forwarded IP address, typically set when the
				// client is using a proxy server.
				$client_ips = explode(',', $_SERVER['HTTP_CLIENT_IP']);
	
				Request::$client_ip = array_shift($client_ips);
	
				unset($client_ips);
			}
			elseif (isset($_SERVER['REMOTE_ADDR']))
			{
				// The remote IP address
				Request::$client_ip = $_SERVER['REMOTE_ADDR'];
			}
	
			if ($method !== HTTP_Request::GET && $method !== HTTP_Request::PUT)
			{
				// Ensure the raw body is saved for future use
				$body = file_get_contents('php://input');
			}
	
			if ($uri === TRUE)
			{
				// Attempt to guess the proper URI
				$uri = Request::detect_uri();
			}
	
			$cookies = array();
	
			if (($cookie_keys = array_keys($_COOKIE)))
			{
				foreach ($cookie_keys as $key)
				{
					$cookies[$key] = Cookie::get($key);
				}
			}
	
			// Create the instance singleton
			Request::$initial = $request = new Request($uri, $client_params, $allow_external, $injected_routes);
	
			// Store global GET and POST data in the initial request only
			$request->protocol($protocol)
			->query($_GET)
			->post($_POST);
	
			if (isset($secure))
			{
				// Set the request security
				$request->secure($secure);
			}
	
			if (isset($method))
			{
				// Set the request method
				$request->method($method);
			}
	
			if (isset($referrer))
			{
				// Set the referrer
				$request->referrer($referrer);
			}
	
			if (isset($requested_with))
			{
				// Apply the requested with variable
				$request->requested_with($requested_with);
			}
	
			if (isset($body))
			{
				// Set the request body (probably a PUT type)
				$request->body($body);
			}
	
			if (isset($cookies))
			{
				$request->cookie($cookies);
			}
		}
		else
		{
			$request = new Request($uri, $client_params, $allow_external, $injected_routes);
		}
	
		return $request;
	}
	
	
	/**
	 * Checks if the request is initiated by the GET method
	 *
	 * @return  boolean
	 */
	public function is_get()
	{
		return $this->_method == Request::GET;
	}


	/**
	 * Checks if the request is initiated by the POST method
	 *
	 * @return  boolean
	 */
	public function is_post()
	{
		return $this->_method == Request::POST;
	}



	/**
	 * Checks if the request is initiated by the PUT method
	 *
	 * @return  boolean
	 */
	public function is_put()
	{
		return $this->_method == Request::PUT;
	}


	/**
	 * Returns whether this is an ajax request (as used by JS frameworks)
	 *
	 * @return  boolean
	 */
	public function is_ajax()
	{
		return parent::is_ajax() OR $this->is_avo_ajax();
	}


	/**
	 * Returns whether this is an ajax request from the AVO framework
	 *
	 * @return  boolean
	 */
	public function is_avo_ajax()
	{
		return $this->is_avo_ajax_controller() OR $this->is_avo_ajax_upload();
	}


	/**
	 * Returns whether this is an ajax request the AVO framework controller
	 *
	 * @return  boolean
	 */
	public function is_avo_ajax_controller()
	{
		return $this->query('__avo_ajax_controller') !== NULL;
	}


	/**
	 * Returns whether this is an ajax file upload request from the AVO framework
	 *
	 * @return  boolean
	 */
	public function is_avo_ajax_upload()
	{
		return $this->query('__avo_ajax_upload') !== NULL;
	}


	/**
	 * Returns whether this is an ajax request for templated content
	 *
	 * @return  boolean
	 */
	public function is_avo_ajax_content()
	{
		return $this->query('__avo_ajax_content') !== NULL;
	}


	/**
	 * performs a HTTP redirect. If called during the AJAX request from the AVO framework a
	 * specially crafted AJAX response is sent instead of the HTTP redirect

	 * @param string $url - target url
	 * @param array $json_params - additional parameters to send back in case of AJAX request
	 */
	public function avo_redirect($url, $json_params = array())
	{
		if ($this->is_ajax())
		{
			if ($url) $json_params['follow'] = URL::site($url);
			$response = Response::factory();
			$response->body(json_encode($json_params));
			echo $response->send_headers()->body();
			exit;
		}
		else
		{
			HTTP::redirect($url);
		}
	}


	/**
	 * Prepares an url for AVO classes messaging
	 *
	 */
	public function get_avo_url()
	{
		return URL::append_url_params(URL::site(Request::detect_uri()), $this->query_parameters);
	}


	/**
	 * Initializes the file upload variable
	 *
	 * @param string $name - variable name
	 */
	public function reqister_upload_variable($name)
	{
		$value = intval($this->query($name));
		if ( ! $value)
		{
			$session = Session::instance();
			$value = $session->get('file_upload_id', 0) + 1;
			$session->set('file_upload_id', $value);
		}
		$this->query_parameters[$name] = $value;
		return $value;
	}


	/**
	 * checks if the request
	 * Enter description here ...
	 */
	public function is_mobile_user_agent()
	{
		static $result;

		if ( ! isset($result))
		{
			if (isset($_SERVER['HTTP_USER_AGENT']))
			{
				if (stripos($_SERVER['HTTP_USER_AGENT'], 'iPod'))
				{
					$result = 'ipod';
				}
				elseif (stripos($_SERVER['HTTP_USER_AGENT'], 'iPhone'))
				{
					$result = 'iphone';
				}
				elseif (stripos($_SERVER['HTTP_USER_AGENT'], 'iPad'))
				{
					$result = 'ipad';
				}
				elseif (stripos($_SERVER['HTTP_USER_AGENT'], 'Android') AND stripos($_SERVER['HTTP_USER_AGENT'], 'mobile'))
				{
					$result = 'android phone';
				}
				elseif (stripos($_SERVER['HTTP_USER_AGENT'], 'Android'))
				{
					$result = 'android tablet';
				}
				elseif (stripos($_SERVER['HTTP_USER_AGENT'], 'webOS'))
				{
					$result = 'webos';
				}
				elseif (stripos($_SERVER['HTTP_USER_AGENT'], 'BlackBerry'))
				{
					$result = 'blackberry phone';
				}
				elseif (stripos($_SERVER['HTTP_USER_AGENT'], 'RIM Tablet'))
				{
					$result = 'rim tablet';
				}
				else
				{
					$result = FALSE;
				}
			}
			else
			{
				$result = FALSE;
			}
		}
		return $result;
	}

}
