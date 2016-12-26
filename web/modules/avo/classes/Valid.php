<?php

class Valid extends Kohana_Valid {

	/**
	 * Checks if a field is not empty HTML.
	 *
	 * @deprecated
	 * @return  boolean
	 */
	public static function not_empty_html($value)
	{
		$stripped_value = preg_replace('/\s+/u', '', html_entity_decode(strip_tags($value), ENT_QUOTES, 'UTF-8'));
		return $stripped_value != '';
	}

	
	/**
	 * Checks if the string contains a valid youtube URL
	 * 
	 * @param string $value
	 * @return boolean
	 */
	public static function youtube_url($value)
	{
		$regexp = '/^(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))((\w|-){11})(?:\S+)?$/';
		return self::regex($value, $regexp);
	}

	
	/**
	 * Checks if the string contains a valid vimeo URL
	 * 
	 * @param string $value
	 * @return boolean
	 */
	public static function vimeo_url($value)
	{
		$regexp = '/^(?:https?:\/\/)?(?:www\.)?(vimeo\.com\/)((channels\/[A-z]+\/)|(groups\/[A-z]+\/videos\/))?([0-9]+)/';
		return self::regex($value, $regexp);
	}

	
	/**
	 * Checks if the string contains a valid vimeo or youtube URL
	 * 
	 * @param string $value
	 * @return boolean
	 */
	public static function video_url($value)
	{
		return self::youtube_url($value) || self::vimeo_url($value);
	}

	
	/**
	 * Checks if the value is not empty if a related image is uploaded
	 * 
	 * @param string $value
	 * @return boolean
	 */
	public static function not_empty_if_img_uploaded($value, Model_Generic_Image $model)
	{
		return (!$model->{$model::$uid_field_name} || Valid::not_empty($value));
	}
}

