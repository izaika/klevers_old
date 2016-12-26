<?php defined('SYSPATH') or die('No direct script access.');

class AVO_Forecast_Yahoo extends AVO_Forecast_Abstract {

	const WS_URL = 'http://weather.yahooapis.com/forecastrss?u=c&w=';

	public static function parse_forecast($xml_string) {
		try {
			$xml = new SimpleXMLElement($xml_string);
			$current_weather = $xml->channel->item->children('yweather', true)->condition->attributes();
			$temp_c = (int) $current_weather->temp;
			$temp_f = round($temp_c * 9 / 5 + 32);
			$condition_code = (int) $current_weather->code;
			return array(
				'temp_f'	=> $temp_f,
				'temp_c'	=> $temp_c,
				'icon'		=> 'http://l.yimg.com/a/i/us/we/52/' . $condition_code . '.gif'
			);
		} catch (Exception $e) {
			return false;
		}
	}
}
