<?php defined('SYSPATH') or die('No direct script access.');

class AVO_Googlemap_Geocoder {

    public static $url = 'https://maps.googleapis.com/maps/api/geocode/';

    const STATUS_OK = "OK";
    const STATUS_ZERO_RESULTS = "ZERO_RESULTS";
    const STATUS_OVER_QUERY_LIMIT = "OVER_QUERY_LIMIT";
    const STATUS_REQUEST_DENIED = "REQUEST_DENIED";
    const STATUS_INVALID_REQUEST = "INVALID_REQUEST";

    protected $_api_key;

    public function __construct($key = NULL)
    {
        $this->_api_key = $key;
    }

    public function perform_request($search, $output = 'json')
    {
        $request = new Request(self::$url.$output);
        $request->query('address', $search);
        $request->query('sensor', 'false');
        $response = $request->execute();
       	return ($response->status() == 200) ? $response->body() : NULL;
    }


    public function coordinates_by_address($address)
    {
        $response = $this->perform_request($address);
        if ($response)
        {
        	$json = json_decode($response);
        	if ($json->status == self::STATUS_OK)
        	{
	        	$location = $json->results[0]->geometry->location;
	        	return $location;
        	}
        	elseif ($json->status == self::STATUS_ZERO_RESULTS)
        	{
        		return NULL;
        	}
        }
        return FALSE; // retry may resolve the output
    }


}
