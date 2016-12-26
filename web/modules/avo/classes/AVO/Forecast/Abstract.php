<?php defined('SYSPATH') or die('No direct script access.');

abstract class AVO_Forecast_Abstract {

	public static $WS_BASE_URL = '';

	public static function parse_forecast($xml_string) {
		// abstract
	}

	/**
	 * Creates a structure for the current forecast
	 *
	 * @return array data structure
	 */
	public static function get_forecast($city_code) {
		$db = Database::instance();

		// get saved weather information
		$row = $db->query(Database::SELECT,
			'SELECT weather_serial, (next_weather_update IS NULL OR CURRENT_TIMESTAMP >= next_weather_update) AS perform_update ' .
			'FROM settings'
		)->current();

		$serial = $row['weather_serial'];
		$perform_update = $row['perform_update'];

		// it is time to update the forecast
		if ($perform_update) {
			self::update_forecast($city_code);
			$serial = $db->query('SELECT weather_serial FROM settings')->get('weather_serial');
		}
		// unserialize the stored forecast
		return unserialize($serial);
	}


	/**
	 * Updates the current stored forecast
	 *
	 */
	private static function update_forecast($city_code) {
		$db = Database::instance();

		// try to aquire the lock
		// if not available - another process is updating the forecast
		$lock = lock::aquire('forecast_update', false);
		if (!$lock) return;

		// call the webservice
		$new_data = self::call_webservice($city_code);
		if ($new_data !== false) {
			// parse the short forecast data
			$data = self::parse_forecast($new_data);
			if ($data !== null) {
				// save the data and set next update to run in 1 hour
				$db->query('
					UPDATE settings
					SET
						next_weather_update = datetime("now", "+1 hour"),
						weather_serial = ?
				', serialize($data));
			} else {
				Kohana::log('error', 'Failed to parse the weather forecast XML: ' . $new_data);
				// Set the update time in 10 minutes
				$db->query('
					UPDATE settings
					SET
						next_weather_update = datetime("now", "+5 minutes")
				');
			}
		} else {
			// failed to call the webservice. Set the update time in 5 minutes
			$db->query('
				UPDATE settings
				SET
					next_weather_update = datetime("now", "+5 minutes")
			');
		}
		// finally release the lock
		lock::release($lock);
	}

	/**
	 * Calls the web service
	 *
	 * @return boolean false if failed
	 * @return array data structure if succeed
	 */
	private static function call_webservice($city_code) {
		global $app;

		set_time_limit(60);
		$ch = curl_init(self::WS_URL + $city_code);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_NOBODY, false);
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		$xml = curl_exec($ch);
		$info = curl_getinfo($ch);
		curl_close($ch);
		if ($xml === false) return false;
		return $xml;
	}
}
