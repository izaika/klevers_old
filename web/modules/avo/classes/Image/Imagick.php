<?php

class Image_Imagick extends Kohana_Image_Imagick {

	protected function _do_grayscale() {
// 		return $this->im->setImageColorSpace(Imagick::COLORSPACE_GRAY);
		return $this->im->modulateImage(100, 0, 100);
	}


	protected function _get_internal_image_resource() {
		return $this->im;
	}


	protected function _do_normalize_orientation()
	{
		$this->is_transformation_needed = true;
		switch ($this->im->getImageOrientation())
		{
			case Imagick::ORIENTATION_TOPRIGHT:
				$this->flip(Image::HORIZONTAL);
				break;
			case Imagick::ORIENTATION_BOTTOMRIGHT:
				$this->rotate(180);
				break;
			case Imagick::ORIENTATION_BOTTOMLEFT:
				$this->flip(Image::VERTICAL);
				break;
			case Imagick::ORIENTATION_LEFTTOP:
				$this->flip(Image::VERTICAL);
				$this->rotate(90);
				break;
			case Imagick::ORIENTATION_RIGHTTOP:
				$this->rotate(90);
				break;
			case Imagick::ORIENTATION_RIGHTBOTTOM:
				$this->flip(Image::HORIZONTAL);
				$this->rotate(90);
				break;
			case Imagick::ORIENTATION_LEFTBOTTOM:
				$this->rotate(-90);
				break;
			default:
				// Imagick::ORIENTATION_UNDEFINED
				// Imagick::ORIENTATION_TOPLEFT
				$this->is_transformation_needed = false;
		};
		$this->im->setImageOrientation(Imagick::ORIENTATION_TOPLEFT);
	}

}
