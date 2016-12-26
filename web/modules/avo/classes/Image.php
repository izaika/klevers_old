<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Image extended class.
 *
 * @package		AVO
 * @category	Helpers
 * @author		Alex Ostapov
 */

abstract class Image extends Kohana_Image {

	public $is_transformation_needed;

	public function get_ext()
	{
		return image_type_to_extension($this->type, FALSE);
	}


	/**
	 * Convert image into a grayscale
	 *
	 *     $image->grayscale();
	 *
	 * @return  $this
	 * @uses    Image::_do_grayscale
	 */
	public function grayscale()
	{

		$this->_do_grayscale();

		return $this;
	}


	/**
	 * Apply image alpha mask
	 *
	 *     $image->alphamask();
	 *
	 * @return  $this
	 * @uses    Image::_do_alphamask
	 */
	public function alphamask(Image $mask)
	{

		$this->_do_alphamask($mask);

		return $this;
	}


	public function normalize_orientation()
	{
		$this->_do_normalize_orientation();
		return $this;
	}


	/**
	 * return internal image resource according to the image driver
	 */
	 public function get_internal_image_resource() {
		return $this->_get_internal_image_resource();
	}

}
