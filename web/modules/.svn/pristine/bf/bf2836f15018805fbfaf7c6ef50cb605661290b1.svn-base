<?php defined('SYSPATH') or die('No direct script access.');

class AVO_Image_Resize {
	private $source_file_name;
	private $source_width;
	private $source_height;

	private $width;
	private $height;

	private $ratio = 1;

	private $x_src_delta = 0;
	private $y_src_delta = 0;

	private $is_jpg = false;
	private $is_gif = false;
	private $is_png = false;

	/**
	 * Resizes image to the specified dimentions
	 *
	 * @param string $source_file_name
	 * @param string $target_file_name
	 * @param integer $width
	 * @param integer $height
	 * @param boolean $force_cover forces image to cover the specified dimentions and crop it if needed
	 *
	 * @return boolean
	 */
	public static function resize_image_exact($source_file_name, $target_file_name, $width, $height, $force_cover = false, $quality = 90) {
		$ir = new self();
		if ($ir->open($source_file_name, array('jpg', 'gif', 'png'))) {
			if ($force_cover) {
				$ir->cover($width, $height);
				$ir->crop($width, $height);
			} else {
				$ir->fit($width, $height);
			}
			$ir->save($target_file_name, $quality);
			return $ir->get_type();
		} else {
			return false;
		}
	}

	/**
	 * Resizes image to fit the specified dimentions
	 *
	 * @param string $source_file_name
	 * @param string $target_file_name
	 * @param integer $width
	 * @param integer $height
	 * @param integer $quality (90 is the default)
	 * @return boolean
	 */
	public static function resize_image_fit($source_file_name, $target_file_name, $width, $height, $quality = 90) {
		$ir = new self();
		if ($ir->open($source_file_name, array('jpg', 'gif', 'png'))) {
			if ($ir->is_higher($height) || $ir->is_wider($width)) {
				$ir->fit($width, $height);
			}
			$ir->save($target_file_name, $quality);
			return $ir->get_type();
		} else {
			return false;
		}
	}

	/**
	 * Resizes image to fit the specified height
	 *
	 * @param string $source_file_name
	 * @param string $target_file_name
	 * @param integer $width
	 * @param integer $height
	 *
	 * @return boolean
	 */
	public static function resize_image_fit_height($source_file_name, $target_file_name, $width, $height, $quality = 90) {
		$ir = new self();
		if ($ir->open($source_file_name, array('jpg', 'gif', 'png')))
		{
			$ir->ratio = $height / $ir->height;
			$ir->height = $height;
			$ir->width *= $ir->ratio;
			$ir->crop($width, $height);
			$ir->save($target_file_name, $quality);
			return $ir->get_type();
		}
		else
		{
			return false;
		}
	}

	/**
	 * Resizes image to fit the specified width
	 *
	 * @param string $source_file_name
	 * @param string $target_file_name
	 * @param integer $width
	 *
	 * @return boolean
	 */
	public static function resize_image_fit_width($source_file_name, $target_file_name, $width, $quality = 90) {
		$ir = new self();
		if ($ir->open($source_file_name, array('jpg', 'gif', 'png'))) {
			if ($ir->width > $width) {
				$ir->ratio = $width / $ir->width;
				$ir->width = $width;
				$ir->height *= $ir->ratio;
			}
			$ir->save($target_file_name, $quality);
			return $ir->get_type();
		} else {
			return false;
		}
	}

	/**
	 * Resizes image to match the specified height
	 *
	 * @param string $source_file_name
	 * @param string $target_file_name
	 * @param integer $height
	 *
	 * @return boolean
	 */
	public static function resize_image_match_height($source_file_name, $target_file_name, $height, $quality = 90) {
		$ir = new self();
		if ($ir->open($source_file_name, array('jpg', 'gif', 'png'))) {
			$ir->ratio = $height / $ir->height;
			$ir->height = $height;
			$ir->width *= $ir->ratio;
			$ir->save($target_file_name, $quality);
			return $ir->get_type();
		} else {
			return false;
		}
	}

	/**
	 * Resizes image to match the specified width
	 *
	 * @param string $source_file_name
	 * @param string $target_file_name
	 * @param integer $width
	 *
	 * @return boolean
	 */
	public static function resize_image_match_width($source_file_name, $target_file_name, $width, $quality = 90) {
		$ir = new self();
		if ($ir->open($source_file_name, array('jpg', 'gif', 'png'))) {
			$ir->ratio = $width / $ir->width;
			$ir->width = $width;
			$ir->height *= $ir->ratio;
			$ir->save($target_file_name, $quality);
			return $ir->get_type();
		} else {
			return false;
		}
	}

	/**
	 * Resizes image to match the specified width and crop height if more than specified
	 *
	 * @param string $source_file_name
	 * @param string $target_file_name
	 * @param integer $width
	 *
	 * @return boolean
	 */
	public static function resize_image_match_width_max_height($source_file_name, $target_file_name, $width, $max_height, $quality = 90) {
		$ir = new self();
		if ($ir->open($source_file_name, array('jpg', 'gif', 'png'))) {
			$ir->ratio = $width / $ir->width;
			$ir->width = $width;
			$ir->height *= $ir->ratio;
			if ($ir->height > $max_height) {
				$ir->crop($width, $max_height);
			}
			$ir->save($target_file_name, $quality);
			return $ir->get_type();
		} else {
			return false;
		}
	}

	/**
	 * Resets all image manipulations to initial state
	 *
	 */
	public function reset() {
		$this->width = $this->source_width;
		$this->height = $this->source_height;

		$this->ratio = 1;

		$this->x_src_delta = 0;
		$this->y_src_delta = 0;
	}

	/**
	 * Opens an image file for further manipulations
	 *
	 * @param string $file_name
	 *
	 * @return boolean
	 */
	public function open($file_name, $allowed_types = array('jpg')) {
		// get original image dimensions
		$img_dim = @getimagesize($file_name);
		if ($img_dim === false) return false; // invalid image file
		switch ($img_dim['mime']) {
			case 'image/jpeg':
				$this->is_jpg = true;
				break;
			case 'image/gif':
				$this->is_gif = true;
				break;
			case 'image/png':
				$this->is_png = true;
				break;
			default:
				return false; // unrecognized image type
		}
		if (($this->is_jpg && in_array('jpg', $allowed_types))
			|| ($this->is_gif && in_array('gif', $allowed_types))
			|| ($this->is_png && in_array('png', $allowed_types))
		) {
			list ($this->source_width, $this->source_height) = $img_dim;
			$this->reset();
			$this->source_file_name = $file_name;
			return true;
		} else {
			return false; // invalid image file
		}
	}

	/**
	 * @return string source image type (jpg/gif/png etc)
	 */
	public function get_type() {
		if ($this->is_jpg) {
			return 'jpg';
		} elseif ($this->is_gif) {
			return 'gif';
		} elseif ($this->is_png) {
			return 'png';
		} else {
			return null;
		}
	}

	/**
	 * Saves all changes to a file
	 * @param string $file_name
	 * @param integer $quality (0 to 100)
	 */
	public function save($file_name, $quality = 90) {
		@unlink($file_name);
		$width = round($this->width);
		$height = round($this->height);
		if ($width == $this->source_width && $height == $this->source_height) {
			@copy($this->source_file_name, $file_name);
		} else {
			if ($this->is_jpg) {
				$source_image = imagecreatefromjpeg($this->source_file_name);
			} elseif ($this->is_gif) {
				$source_image = imagecreatefromgif($this->source_file_name);
			} elseif ($this->is_png) {
				$source_image = imagecreatefrompng($this->source_file_name);
				// preserve alpha channel:
				// Turn off alpha blending and set alpha flag
				imagealphablending($source_image, false);
				imagesavealpha($source_image, true);
			}
			$target_image = imagecreatetruecolor($width, $height);
			// preserve alpha channel:
			// Turn off alpha blending and set alpha flag
			imagealphablending($target_image, false);
			imagesavealpha($target_image, true);
			@imagecopyresampled(
				$target_image, $source_image,
				0, 0,	// dst_x, dst_y
 				round($this->x_src_delta / 2), round($this->y_src_delta / 2),	// src_x, src_y
// 				round($this->x_src_delta / 2), 0,	// src_x, 0 - top align
				round($this->width), round($this->height),	// dst_w, dst_h
				$this->source_width - round($this->x_src_delta), $this->source_height - round($this->y_src_delta)	// src_w, int src_h
			);
			if ($this->is_jpg) {
				imagejpeg($target_image, $file_name, $quality);
			} elseif ($this->is_gif) {
				imagegif($target_image, $file_name);
			} elseif ($this->is_png) {
				imagepng($target_image, $file_name);
			}
		}
		@chmod($target_file_name, 0664);
	}

	/**
	 * returns width of the source image
	 *
	 * @return integer
	 */
	public function get_source_width() {
		return $this->source_width;
	}

	/**
	 * returns height of the source image
	 *
	 * @return integer
	 */
	public function get_source_height() {
		return $this->source_height;
	}

	/**
	 * returns true if image is of the specified dimentions
	 *
	 * @param integer $width
	 * @param integer $height
	 *
	 * @return boolean
	 */
	public function is_exact($width, $height) {
		return ($this->height == $height && $this->width == $width);
	}

	/**
	 * returns true if the image covers the specified dimentions but not equal to them
	 *
	 * @param integer $width
	 * @param integer $height
	 *
	 * @return boolean
	 */
	public function is_larger($width, $height) {
		if ($this->height > $height)
		{
			return ($this->width >= $width);
		}
		elseif ($this->height == $height)
		{
			return ($this->width > $width);
		}
		return false;
	}

	/**
	 * returns true if the image does not cover the specified dimentions
	 *
	 * @param integer $width
	 * @param integer $height
	 *
	 * @return boolean
	 */
	public function is_smaller($width, $height) {
		if ($this->height < $height)
		{
			return ($this->width <= $width);
		}
		elseif ($this->height == $height)
		{
			return ($this->width < $width);
		}
		return false;
	}

	/**
	 * returns true if the image is wider than specified value
	 *
	 * @param integer $width
	 *
	 * @return boolean
	 */
	public function is_wider($width) {
		return ($this->width > $width);
	}

	/**
	 * returns true if the image is higher than specified value
	 *
	 * @param integer $height
	 *
	 * @return boolean
	 */
	public function is_higher($height) {
		return ($this->height > $height);
	}

	/**
	 * returns true if the image is narrower than specified value
	 *
	 * @param integer $width
	 *
	 * @return boolean
	 */
	public function is_narrower($width) {
		return ($this->width > $width);
	}

	/**
	 * returns true if the image is lower than specified value
	 *
	 * @param integer $height
	 *
	 * @return boolean
	 */
	public function is_lower($height) {
		return ($this->height < $height);
	}

	/**
	 * Crops image to fit specified dimentions
	 *
	 * @param integer $width
	 * @param integer $height
	 */
	public function crop($width, $height) {
		if ($this->width > $width) {
			$this->x_src_delta = - ($width - $this->width) / $this->ratio;
			$this->width = $width;
		}
		if ($this->height > $height) {
			$this->y_src_delta = - ($height - $this->height) / $this->ratio;
			$this->height = $height;
		}
	}

	/**
	 * Resizes image to cover specified dimentions
	 *
	 * @param integer $width
	 * @param integer $height
	 */
	public function cover($width, $height) {
		$xratio = $width / $this->width;
		$yratio = $height / $this->height;

		if ($xratio > $yratio) {
			$this->ratio = $xratio;
			$this->width = $width;
			$this->height *= $xratio;
		}
		else
		{
			$this->ratio = $yratio;
			$this->height = $height;
			$this->width *= $yratio;
		}
	}

	/**
	 * Resizes image to fit specified dimentions
	 *
	 * @param integer $width
	 * @param integer $height
	 */
	public function fit($width, $height) {
		$xratio = $width / $this->width;
		$yratio = $height / $this->height;

		if ($xratio < $yratio)
		{
			$this->ratio = $xratio;
			$this->width = $width;
			$this->height *= $xratio;
		}
		else
		{
			$this->ratio = $yratio;
			$this->height = $height;
			$this->width *= $yratio;
		}
	}
}
