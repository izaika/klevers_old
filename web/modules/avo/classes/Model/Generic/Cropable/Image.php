<?php defined('SYSPATH') OR die('No direct access allowed.');

class Model_Generic_Cropable_Image extends Model_Generic_Image {

	public static $NORMALIZED_NAME = 'normalized';
	public static $NORMALIZED_W = 4000;
	public static $NORMALIZED_H = 4000;

	/**
	 * all sizes with prepended normalized size set
	 * @var array
	 */
	protected static $_whole_data_set;

	public static $crop_data_field_name = 'crop_data';


	/**
	 * Generates all types of images for all items saved to the database
	 *
	 */
	public static function regenerate_all()
	{
		$images = new static();
		foreach ($images->find_all() as $i)
		{
			static::create_resized_images($i->storage().static::$ORIGINAL_NAME.'.'.$i->{static::$ext_field_name}, $i->storage(), json_decode($i->{static::$crop_data_field_name}, true));
		}
	}


	/**
	 * Return size sets with prepended normalized size set
	 * @return array
	 */
	protected static function _get_whole_dataset() {
		if (!is_array(static::$_whole_data_set)) {
			static::$_whole_data_set = Arr::merge(
				array(
					static::$NORMALIZED_NAME => array(
						'width' => static::$NORMALIZED_W,
						'height' => static::$NORMALIZED_H,
						'mode'	=> 'less_or_match_inside',
					)
				),
				static::$SIZES
			);
		}
		return static::$_whole_data_set;
	}


	public static function create_resized_images($source_path, $destination_base, $crop_data = null)
	{
		try
		{
			$img = Image::factory($source_path);
			$img->normalize_orientation();
		}
		catch (Kohana_Exception $e)
		{
			return FALSE;
		}
		if (!in_array($img->type, array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG))) return FALSE;
		$ext = $img->get_ext();

		if (!is_array($crop_data))
		{
			$crop_data = array();
		}
		foreach (static::_get_whole_dataset() as $name => $def)
		{

			// reload the image is if has been processed
			if (!$img)
			{
				// if we are working on $NORMALIZED, we take $ORIGINAL ($source_path), else all images are processed from $NORMALIZED
				$img = Image::factory(($name == static::$NORMALIZED_NAME) ? $source_path : $destination_base . static::$NORMALIZED_NAME . '.' . $ext);
				// if we processing $ORIGINAL, then normalize orientation
				if ($name == static::$NORMALIZED_NAME)
				{
					$img->normalize_orientation();
				}
			}

			if (array_key_exists($name, $crop_data))
			{
				// apply crop/resize to the $img, which is $NORMALIZED now
				$cr_w = (int) ceil($crop_data[$name]['w']);
				$cr_h = (int) ceil($crop_data[$name]['h']);
				$cr_x = (int) floor($crop_data[$name]['x']);
				$cr_y = (int) floor($crop_data[$name]['y']);
				$img->crop($cr_w, $cr_h, $cr_x, $cr_y);
				$img->is_transformation_needed = TRUE;
			}

			$destination_path = $destination_base . $name . '.' . $ext;
			$quality = isset($def['quality']) ? $def['quality'] : 90;
			$mode = isset($def['mode']) ? $def['mode'] : 'match_outside_crop';

			switch ($mode)
			{
				// resize to match the width
				case 'match_width':
					if (!$img->is_transformation_needed && $img->width == $def['width'])
					{
						if ((isset($def['filter']) && $def['filter']))
						{
							$img->$def['filter']();
							$img->save($destination_path, $quality);
							$img = NULL;
						}
						else
						{
							copy($source_path, $destination_path); // save the original file
						}
					}
					else
					{
						$img->resize($def['width']);
						if (isset($def['filter']) && $def['filter']) $img->$def['filter']();
						$img->save($destination_path, $quality);
						$img = NULL;
					}
					chmod($destination_path, 0664);
				break;

					// resize to match the width or height so the whole image covers the box and crop
				case 'match_outside_crop':
					if (!$img->is_transformation_needed && ($img->width == $def['width'] && $img->height == $def['height']))
					{
						if (isset($def['filter']) && $def['filter'])
						{
							$img->$def['filter']();
							$img->save($destination_path, $quality);
							$img = NULL;
						}
						else
						{
							copy($source_path, $destination_path); // save the original file
						}
					}
					else
					{
						$img->resize($def['width'], $def['height'], Image::INVERSE);
						$img->crop($def['width'], $def['height']);
						if (isset($def['filter']) && $def['filter']) $img->$def['filter']();
						$img->save($destination_path, $quality);
						$img = NULL;
					}
					chmod($destination_path, 0664);
				break;

				// resize to match the width or height so the whole image fits the box
				case 'match_inside':
					if (!$img->is_transformation_needed && ($img->width == $def['width'] && $img->height == $def['height']))
					{
						if (isset($def['filter']) && $def['filter'])
						{
							$img->$def['filter']();
							$img->save($destination_path, $quality);
							$img = NULL;
						}
						else
						{
							copy($source_path, $destination_path); // save the original file
						}
					}
					else
					{
						$img->resize($def['width'], $def['height']);
						if (isset($def['filter']) && $def['filter']) $img->$def['filter']();
						$img->save($destination_path, $quality);
						$img = NULL;
					}
					chmod($destination_path, 0664);
				break;

				// if needed resize to match the width or height so the whole image fits the box
				case 'less_or_match_inside':
					if (!$img->is_transformation_needed AND ($img->width <= $def['width'] AND $img->height <= $def['height']))
					{
						if (isset($def['filter']) AND $def['filter'])
						{
							$img->$def['filter']();
							$img->save($destination_path, $quality);
							$img = NULL;
						}
						else
						{
							copy($source_path, $destination_path); // save the original file
						}
					}
					else
					{
						if ($img->width > $def['width'] OR $img->height > $def['height'])
						{
							$img->resize($def['width'], $def['height']);
						}
						if (isset($def['filter']) AND $def['filter']) $img->$def['filter']();
						$img->save($destination_path, $quality);
						$img = NULL;
					}
					chmod($destination_path, 0664);
				break;
			}
		}

		// save the original path
		$original_file = $destination_base . static::$ORIGINAL_NAME . '.' . $ext;
		if ($source_path != $original_file)
		{
			if (is_uploaded_file($source_path))
			{
				if (!@move_uploaded_file($source_path, $original_file)) copy($source_path, $original_file);
			}
			else
			{
				if (!@rename($source_path, $original_file)) @copy($source_path, $original_file);
			}
			chmod($original_file, 0664);
		}

		return $ext;
	}


	public static function move_images($source_path, $destination_path, $ext)
	{
		foreach (static::_get_whole_dataset() as $name => $size)
		{
			@rename($source_path . $name . '.' . $ext, $destination_path . $name . '.' . $ext);
		}
		rename($source_path . static::$ORIGINAL_NAME . '.' . $ext, $destination_path . static::$ORIGINAL_NAME . '.' . $ext);
	}



}
