<?php defined('SYSPATH') or die('No direct script access.');

class AVO_Forecast_Google extends AVO_Forecast_Abstract {

	const WS_URL = 'http://www.google.com/ig/api?weather=';

	public static function parse_forecast($xml_string) {
		try {
			$xml = new SimpleXMLElement($xml_string);
			$cur_conditions = $xml->weather->current_conditions;
			return array(
				'temp_f'	=> (string) $cur_conditions->temp_f->attributes()->data,
				'temp_c'	=> (string) $cur_conditions->temp_c->attributes()->data,
				'icon'		=> 'http://www.google.com' . (string) $cur_conditions->icon->attributes()->data
			);
		} catch (Exception $e) {
			return false;
		}
	}

}
