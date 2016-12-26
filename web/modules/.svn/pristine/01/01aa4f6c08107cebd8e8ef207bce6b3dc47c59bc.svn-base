<?php defined('SYSPATH') or die('No direct script access.');

class AVO_Googlemap_Directions {

	public static $url = 'http://maps.google.com/maps/nav';

    const G_GEO_SUCCESS = 200;

    protected $_apiKey;

    public function __construct($key) {
        $this->_apiKey = $key;
    }

    public function routeInfo(AVO_Googlemap_Placemark $PlacemarkA, AVO_Googlemap_Placemark $PlacemarkB) {
		$retval = false;

		$from_address = $PlacemarkA->getCustom();
		if ($from_address == '') $from_address = $PlacemarkA->getAddress();
		$to_address = $PlacemarkB->getCustom();
		if ($to_address == '') $to_address = $PlacemarkB->getAddress();
		$query = 'from: ' . $from_address . ' to: ' . $to_address;

        $url = sprintf("%s?q=%s&output=json&key=%s&oe=utf-8", self::$url, urlencode($query), $this->_apiKey);

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = @curl_exec($ch);
        curl_close($ch);

        $result = json_decode($response, false);

        $status = (int) $result->Status->code;

        switch ($status) {
            case self::G_GEO_SUCCESS:
				$duration_seconds = $result->Directions->Duration->seconds;
				$duration_html = $result->Directions->Duration->html;
				$distance_meters = $result->Directions->Distance->meters;
				$distance_html = $result->Directions->Distance->html;

				$retval = Array(
					'Duration' => array('seconds' => $duration_seconds, 'html' => $duration_html),
					'Distance' => array('meters' => $distance_meters, 'html' => $distance_html)
				);
        }
        return $retval;
    }
}
