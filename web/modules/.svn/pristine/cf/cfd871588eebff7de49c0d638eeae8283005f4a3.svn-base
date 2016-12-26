<?php defined('SYSPATH') OR die('No direct script access.');

class AVO_Googlemap_Point {

    protected $_lat;
    protected $_lng;

    public function __construct($latitude, $longitude)
    {
        $this->_lat = $latitude;
        $this->_lng = $longitude;
    }

    public function getLatitude()
    {
        return $this->_lat;
    }

    public function getLongitude()
    {
        return $this->_lng;
    }

    public static function Create($str)
    {
        list ($longitude, $latitude, $elevation) = explode(',', $str, 4);
        return new self($latitude, $longitude);
    }
}
