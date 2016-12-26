<?php

class Image_GD extends Kohana_Image_GD {

	protected function _do_grayscale() {
		if (empty(Image_GD::$_available_functions[Image_GD::IMAGEFILTER]))
		{
			throw new Kohana_Exception('This method requires :function, which is only available in the bundled version of GD',
				array(':function' => 'imagefilter'));
		}

		// Loads image if not yet loaded
		$this->_load_image();

		// Apply the filter
		imagefilter($this->_image, IMG_FILTER_GRAYSCALE);
	}


	/**
	 * Return imagecolorat() for $this->_image
	 * $this->_image MUST be loaded!
	 * @param integer $index
	 * @return int the index of the color.
	 */
	protected function _imagecolorat($x, $y) {
		return imagecolorat($this->_image, $x, $y);
	}


	/**
	 * Applies Aplha-channel mask to the image.
	 * Resulted pixels opacity determined by opacity value of pixel from $mask image
	 * So, any transparent area on the mask will be transparent on result.
	 * RGB values are taken from source unaltered, only Alpha channel is replaced with ones from $mask.
	 * @param Image $mask
	 */
	protected function _do_alphamask(Image $mask) {
		// Loads images if not yet loaded
		$this->_load_image();
		$mask->_load_image();

		// Get sizes and set up new picture
		$xSize = $this->width;
		$ySize = $this->height;

		$newPicture = $this->_create($xSize, $ySize);
		imagefill( $newPicture, 0, 0, imagecolorallocatealpha( $newPicture, 0, 0, 0, 127 ) );

		// Resize mask if necessary
		if( $xSize != $mask->width || $ySize != $mask->height ) {
			$mask->_do_resize($xSize, $ySize);
		}

		// Perform pixel-based alpha map application
		for( $x = 0; $x < $xSize; $x++ ) {
			for( $y = 0; $y < $ySize; $y++ ) {
				$alpha_rgba = $mask->_imagecolorat($x, $y);
				$alpha = ($alpha_rgba & 0x7F000000) >> 24;
				$this_rgb = $this->_imagecolorat($x, $y);
				imagesetpixel( $newPicture, $x, $y, imagecolorallocatealpha( $newPicture, ($this_rgb >> 16) & 0xFF, ($this_rgb >> 8) & 0xFF, $this_rgb & 0xFF, $alpha ) );
			}
		}

		// Copy back to original picture
		imagedestroy( $this->_image );
		$this->_image = $newPicture;

	}


	protected function _get_internal_image_resource() {
		return $this->_image;
	}


	protected function _do_normalize_orientation()
	{
		if (function_exists('exif_read_data'))
		{
			// adjust the original image orientation
			$exif = @exif_read_data($this->file, 'IFD0');
			$this->is_transformation_needed = true;
			switch (@$exif['Orientation'])
			{
				case 2: // horizontal flip
					$this->flip(Image::HORIZONTAL);
					break;
				case 3: // 180 rotate left
					$this->rotate(180);
					break;
				case 4: // vertical flip
					$this->flip(Image::VERTICAL);
					break;
				case 5: // vertical flip + 90 rotate right
					$this->flip(Image::VERTICAL);
					$this->rotate(90);
					break;
				case 6: // 90 rotate right
					$this->rotate(90);
					break;
				case 7: // horizontal flip + 90 rotate right
					$this->flip(Image::HORIZONTAL);
					$this->rotate(90);
					break;
				case 8: // 90 rotate left
					$this->rotate(-90);
					break;
				default:
					$this->is_transformation_needed = false;
			};
		// nothing more to do, since GD strips EXIF
		}
		return TRUE;
	}

}
