<?php defined('SYSPATH') OR die('No direct script access.');

class AVO_Geo {


	const GEO_LOCATOR_SERVICE = 'http://freegeoip.net/json/';

	private static $cache_id_prefix = 'AVO_Geo_';	// prefix
	private static $cache_lifetime = 1800;			// 30 min


	public static function country_by_ip($ip, $use_cache = true)
	{

        if (!is_string($ip) || strlen($ip) < 1 || $ip == '127.0.0.1' || $ip == 'localhost' || $ip == '::1') $ip = '85.252.49.20';


        $cache_instance = false;
        if ($use_cache) {
	        try {
	        	$cache_instance = Cache::instance();
	        }
	        catch (Cache_Exception $e) {}
        }

        if ($use_cache) {
	        $cached_id = static::$cache_id_prefix.$ip;
	        $cc = (is_a($cache_instance, 'Cache') ? Cache::instance()->get($cached_id) : Kohana::cache($cached_id));
        } else {
        	$cc = false;
        }
        if (!$cc) {
	        $request = new Request(self::GEO_LOCATOR_SERVICE.urlencode($ip));
	        $request_client = $request->client();
	        if (is_a($request_client, 'Request_Client_Curl')) {
		        $request_client->options(array(
		        	CURLOPT_TIMEOUT	=> 3,
		        ));
	        }

	        try {
		        $response = $request->execute();
		        $result = @json_decode($response->body());
				$cc = @$result->country_code;
	        } catch (Exception $e) {
	        	$cc = '-unknown-';
	        }

	        if ($use_cache) {
				if (is_a($cache_instance, 'Cache')) {
					$cache_instance->set($cached_id, $cc, static::$cache_lifetime);
				} else {
					Kohana::cache($cached_id, $cc);
				}
	        }
        }
		return $cc;
	}

}
