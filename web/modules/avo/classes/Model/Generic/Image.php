<?php

class Model_Generic_Image extends ORM
{

	protected $_sorting = array('ord' => 'ASC');

	protected $_reload_on_wakeup = FALSE;

	/**
	 * The base path to the file storage
	 */
	public static $STORAGE_PATH = '';

	public static $SIZES = array();

	public static $ORIGINAL_NAME = 'original';

	/* types for the media_type field */
	const MEDIA_TYPE_IMAGE		= 0;
	const MEDIA_TYPE_VIMEO		= 1;
	const MEDIA_TYPE_YOUTUBE	= 2;

	public static $alt_field_name = 'alt';
	public static $title_field_name = 'title';
	public static $ext_field_name = 'ext';
	public static $uid_field_name = 'uid';
	public static $data_hash_field_name = 'data_hash';
	public static $width_field_name = 'width';
	public static $height_field_name = 'height';
	public static $video_url_field_name = 'video_url';
	public static $media_type_field_name = 'media_type';

	const RESIZE_MODE_MATCH_WIDTH = 'match_width';
	const RESIZE_MODE_MATCH_HEIGHT = 'match_height';
	const RESIZE_MODE_MATCH_OUTSIDE_CROP = 'match_outside_crop';
	const RESIZE_MODE_MATCH_INSIDE = 'match_inside';
	const RESIZE_MODE_LESS_OR_MATCH_INSIDE = 'less_or_match_inside';

	/**
	 * Generates all types of images for $this, saved to the database
	 *
	 */
	public function regenerate_this()
	{
		if ($this->loaded() && $this->{static::$uid_field_name}) {
			static::create_resized_images($this->storage().static::$ORIGINAL_NAME.'.'.$this->{static::$ext_field_name}, $this->storage());
		}
	}


	/**
	 * Generates all types of images for all items saved to the database
	 *
	 */
	public static function regenerate_all()
	{
		$images = new static();
		foreach ($images->find_all() as $i) {
			$i->regenerate_this();
		}
	}


	public static function create_resized_images($source_path, $destination_base, $preserve_original = false)
	{
		try {
			$img = Image::factory($source_path);
			$img->normalize_orientation();
		} catch (Kohana_Exception $e) {
			return false;
		}
		if (!in_array($img->type, array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG))) return FALSE;
		$ext = $img->get_ext();

		foreach (static::$SIZES as $name => $def) {
			// reload the image is if has been processed
			if (!$img) {
				$img = Image::factory($source_path);
				$img->normalize_orientation();
			}

			$destination_path = $destination_base . $name . '.' . $ext;
			$quality = isset($def['quality']) ? $def['quality'] : 90;
			$mode = isset($def['mode']) ? $def['mode'] : self::RESIZE_MODE_MATCH_OUTSIDE_CROP;
			$keep_original_gif = isset($def['keep_original_gif']) && $def['keep_original_gif'];

			if ($img->type == IMAGETYPE_GIF && $keep_original_gif) {
				copy($source_path, $destination_path); // save the original file
			} else {
				switch ($mode) {
					// resize to match the width
					case self::RESIZE_MODE_MATCH_WIDTH:
						if ( ! $img->is_transformation_needed AND $img->width == $def['width']) {
							if (isset($def['preprocess'])) {
								if (method_exists($img, $def['preprocess'])) {
									$img->$def['preprocess']();
								} elseif (is_callable($def['preprocess'])) {
									call_user_func($def['preprocess'], $img);
								}
							}

							if (isset($def['filter'])) {
								if (method_exists($img, $def['filter'])) {
									$img->$def['filter']();
								} elseif (is_callable($def['filter'])) {
									call_user_func($def['filter'], $img);
								}
							}

							if (isset($def['preprocess']) || isset($def['filter'])) {
								$img->save($destination_path, $quality);
							} else {
								copy($source_path, $destination_path); // save the original file
							}
						} else {
							if (isset($def['preprocess'])) {
								if (method_exists($img, $def['preprocess'])) {
									$img->$def['preprocess']();
								} elseif (is_callable($def['preprocess'])) {
									call_user_func($def['preprocess'], $img);
								}
							}
							$img->resize($def['width'], null, Image::WIDTH);
							if (isset($def['filter'])) {
								if (method_exists($img, $def['filter'])) {
									$img->$def['filter']();
								} elseif (is_callable($def['filter'])) {
									call_user_func($def['filter'], $img);
								}
							}
							$img->save($destination_path, $quality);
							$img = NULL;
						}
						chmod($destination_path, 0664);
					break;

					// resize to match the height
					case self::RESIZE_MODE_MATCH_HEIGHT:
						if (!$img->is_transformation_needed && $img->height == $def['height']) {
							if (isset($def['preprocess'])) {
								if (method_exists($img, $def['preprocess'])) {
									$img->$def['preprocess']();
								} elseif (is_callable($def['preprocess'])) {
									call_user_func($def['preprocess'], $img);
								}
							}

							if (isset($def['filter'])) {
								if (method_exists($img, $def['filter'])) {
									$img->$def['filter']();
								} elseif (is_callable($def['filter'])) {
									call_user_func($def['filter'], $img);
								}
							}

							if (isset($def['preprocess']) || isset($def['filter'])) {
								$img->save($destination_path, $quality);
							} else {
								copy($source_path, $destination_path); // save the original file
							}
						} else {
							if (isset($def['preprocess'])) {
								if (method_exists($img, $def['preprocess'])) {
									$img->$def['preprocess']();
								} elseif (is_callable($def['preprocess'])) {
									call_user_func($def['preprocess'], $img);
								}
							}
							$img->resize(null, $def['height'], Image::HEIGHT);
							if (isset($def['filter'])) {
								if (method_exists($img, $def['filter'])) {
									$img->$def['filter']();
								} elseif (is_callable($def['filter'])) {
									call_user_func($def['filter'], $img);
								}
							}
							$img->save($destination_path, $quality);
							$img = NULL;
						}
						chmod($destination_path, 0664);
					break;

					// resize to match the width or height so the whole image covers the box and crop
					case self::RESIZE_MODE_MATCH_OUTSIDE_CROP:
						if (!$img->is_transformation_needed AND ($img->width == $def['width'] AND $img->height == $def['height'])) {
							if (isset($def['preprocess'])) {
								if (method_exists($img, $def['preprocess'])) {
									$img->$def['preprocess']();
								} elseif (is_callable($def['preprocess'])) {
									call_user_func($def['preprocess'], $img);
								}
							}

							if (isset($def['filter'])) {
								if (method_exists($img, $def['filter'])) {
									$img->$def['filter']();
								} elseif (is_callable($def['filter'])) {
									call_user_func($def['filter'], $img);
								}
							}

							if (isset($def['preprocess']) || isset($def['filter'])) {
								$img->save($destination_path, $quality);
							} else {
								copy($source_path, $destination_path); // save the original file
							}
						} else {
							if (isset($def['preprocess'])) {
								if (method_exists($img, $def['preprocess'])) {
									$img->$def['preprocess']();
								} elseif (is_callable($def['preprocess'])) {
									call_user_func($def['preprocess'], $img);
								}
							}
							$img->resize($def['width'], $def['height'], Image::INVERSE);
							$img->crop($def['width'], $def['height']);
							if (isset($def['filter'])) {
								if (method_exists($img, $def['filter'])) {
									$img->$def['filter']();
								} elseif (is_callable($def['filter'])) {
									call_user_func($def['filter'], $img);
								}
							}
							$img->save($destination_path, $quality);
							$img = null;
						}
						chmod($destination_path, 0664);
					break;

					// resize to match the width or height so the whole image fits the box
					case self::RESIZE_MODE_MATCH_INSIDE:
						if ( ! $img->is_transformation_needed AND $img->width == $def['width'] AND $img->height == $def['height'])
						{
							if (isset($def['preprocess'])) {
								if (method_exists($img, $def['preprocess'])) {
									$img->$def['preprocess']();
								} elseif (is_callable($def['preprocess'])) {
									call_user_func($def['preprocess'], $img);
								}
							}

							if (isset($def['filter'])) {
								if (method_exists($img, $def['filter'])) {
									$img->$def['filter']();
								} elseif (is_callable($def['filter'])) {
									call_user_func($def['filter'], $img);
								}
							}

							if (isset($def['preprocess']) || isset($def['filter'])) {
								$img->save($destination_path, $quality);
							} else {
								copy($source_path, $destination_path); // save the original file
							}
						} else {
							if (isset($def['preprocess'])) {
								if (method_exists($img, $def['preprocess'])) {
									$img->$def['preprocess']();
								} elseif (is_callable($def['preprocess'])) {
									call_user_func($def['preprocess'], $img);
								}
							}
							$img->resize($def['width'], $def['height']);
							if (isset($def['filter'])) {
								if (method_exists($img, $def['filter'])) {
									$img->$def['filter']();
								} elseif (is_callable($def['filter'])) {
									call_user_func($def['filter'], $img);
								}
							}
							$img->save($destination_path, $quality);
							$img = NULL;
						}
						chmod($destination_path, 0664);
					break;

					// if needed resize to match the width or height so the whole image fits the box
					case self::RESIZE_MODE_LESS_OR_MATCH_INSIDE:
						if ( ! $img->is_transformation_needed AND ($img->width <= $def['width'] AND $img->height <= $def['height']))
						{
							if (isset($def['preprocess'])) {
								if (method_exists($img, $def['preprocess'])) {
									$img->$def['preprocess']();
								} elseif (is_callable($def['preprocess'])) {
									call_user_func($def['preprocess'], $img);
								}
							}

							if (isset($def['filter'])) {
								if (method_exists($img, $def['filter'])) {
									$img->$def['filter']();
								} elseif (is_callable($def['filter'])) {
									call_user_func($def['filter'], $img);
								}
							}

							if (isset($def['preprocess']) || isset($def['filter'])) {
								$img->save($destination_path, $quality);
							} else {
								copy($source_path, $destination_path); // save the original file
							}
						}
						else
						{
							if (isset($def['preprocess'])) {
								if (method_exists($img, $def['preprocess'])) {
									$img->$def['preprocess']();
								} elseif (is_callable($def['preprocess'])) {
									call_user_func($def['preprocess'], $img);
								}
							}
							if ($img->width > $def['width'] OR $img->height > $def['height']) {
								$img->resize($def['width'], $def['height']);
							}
							if (isset($def['filter'])) {
								if (method_exists($img, $def['filter'])) {
									$img->$def['filter']();
								} elseif (is_callable($def['filter'])) {
									call_user_func($def['filter'], $img);
								}
							}
							$img->save($destination_path, $quality);
							$img = null;
						}
						chmod($destination_path, 0664);
					break;
				}
			}
		}

		// save the original path
		$original_file = $destination_base . static::$ORIGINAL_NAME . '.' . $ext;
		if ($source_path != $original_file) {
			if ($preserve_original) {
				@copy($source_path, $original_file);
			} else {
				if (is_uploaded_file($source_path)) {
					if (!@move_uploaded_file($source_path, $original_file)) copy($source_path, $original_file);
				} else {
					if (!@rename($source_path, $original_file)) @copy($source_path, $original_file);
				}
			}
			@chmod($original_file, 0664);
		}

		return $ext;
	}


	public static function move_images($source_path, $destination_path, $ext)
	{
		foreach (static::$SIZES as $name => $size) {
			@rename($source_path . $name . '.' . $ext, $destination_path . $name . '.' . $ext);
		}
		rename($source_path . static::$ORIGINAL_NAME . '.' . $ext, $destination_path . static::$ORIGINAL_NAME . '.' . $ext);
	}


	/**
	 * Returns a url for the file
	 *
	 * @return mixed
	 */
	public function url($kind = NULL)
	{
		$uid = $this->{static::$uid_field_name};
		if (!$uid) return null;
		if (!$kind) $kind = static::$ORIGINAL_NAME;
        return static::$STORAGE_PATH . $this->id . '-' . $uid . '-' . $kind . '/' .
	        rawurlencode(URL::title($this->{static::$title_field_name})) . '.' . $this->{static::$ext_field_name};
	}


	/**
	 * Returns a file path for specific kind
	 *
	 * @return mixed
	 */
	public function file_path($kind = NULL)
	{
		$uid = $this->{static::$uid_field_name};
		if (!$uid) return null;
		if (!$kind) $kind = static::$ORIGINAL_NAME;
        return $this->storage() . $kind . '.' . $this->{static::$ext_field_name};
	}


	/**
	 * Returns a file name of the image
	 *
	 * @return mixed
	 */
	public function file_name()
	{
		if (!$this->{static::$uid_field_name}) return null;
		return $this->{static::$title_field_name} . '.' . $this->{static::$ext_field_name};
	}


	public function remove_image_files()
	{
		if ($this->loaded()) {
			File::rm_dir(DOCROOT.static::$STORAGE_PATH.$this->id);
		}
	}


	/**
	 * Returns a storage path of the images
	 *
	 * @return string
	 */
	public function storage($with_uid = true)
	{
		return static::get_storage_base() . $this->id . '/' . ($with_uid ? ($this->{static::$uid_field_name} . '/') : '');
	}


	public static function get_temp_storage_base($file_id)
	{
		return DOCROOT.static::get_temp_storage_base_url($file_id);
	}


	public static function get_temp_storage_base_url($file_id)
	{
		return App::TEMP_UPLOAD_STORAGE.Session::instance()->id().'_'.$file_id;
	}


	public static function get_storage_base()
	{
		return DOCROOT.static::$STORAGE_PATH;
	}


	public static function get_arbitrate_video($url, $width)
	{
		$static_url = 'http://vimeo.com/api/oembed.json?url=';
		$curl = curl_init($static_url.rawurlencode($url).'&portrait=false&title=false&byline=false&color=9e8f5e&wmode=transparent&api=1&width='.$width);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_TIMEOUT, 15);
		$data_json = json_decode(curl_exec($curl));
		curl_close($curl);
		if ($data_json) {
			return $data_json->html;
		} else {
			return 'Incorrect video URL!';
		}
	}


	public function get_video($width)
	{
		return self::get_arbitrate_video($this->{static::$video_url_field_name}, $width);
	}


	/**
	 * Return full path to the image file on the server filesystem
	 * @param string $kind
	 * @return NULL|string
	 */
	public function image_file($kind = NULL)
	{
		$uid = $this->{static::$uid_field_name};
		if (!$uid) return NULL;
		$kind = empty($kind) ? static::$ORIGINAL_NAME : $kind;
		return $this->storage().$kind.'.'.$this->{static::$ext_field_name};
	}


	/**
	 * Return dimensions of image of specified $kind
	 * @param string $kind
	 * @return array|NULL
	 */
	public function image_dims($kind = NULL)
	{
		try {
			$image = Image::factory($this->image_file($kind));
			return array('w' => $image->width, 'h' => $image->height, 'r' => $image->width / $image->height);
		} catch (Kohana_Exception $e) {
			return NULL;
		}
	}


	public function grid_preview_link()
	{
		return $this->preview_link(static::GRID_PREVIEW_NAME);
	}


	public function form_preview_link()
	{
		return $this->preview_link(static::FORM_PREVIEW_NAME);
	}


	public function preview_link($name)
	{
		if ($this->loaded() && $this->{static::$uid_field_name}) {
			return HTML::anchor(
				$this->url(static::$ORIGINAL_NAME),
				HTML::image($this->url($name)),
				array('class' => 'zoomed_preview')
			);
		} else {
			return HTML::__('not uploaded');
		}
	}


	public function assign_dummy_image()
	{
		$source = static::get_storage_base() . 'dummy.png';
		$this->{$this::$title_field_name} = $this->{static::$uid_field_name} = 'dummy';
		$this->{$this::$ext_field_name} = 'png';

		/* @var $i Image */
		$i = Image::factory($source);
		$this->{$this::$width_field_name} = $i->width;
		$this->{$this::$height_field_name} = $i->height;

		// create the storage location
		File::rm_dir($this->storage(false));
		$save_dir = $this->storage();
		$saved_mask = umask(0002);
		mkdir($save_dir, 0775, true);
		umask($saved_mask);

		$this->create_resized_images($source, $save_dir, true);

		$this->save();
	}

	public function is_video()
	{
		try {
			return $this->{$this::$media_type_field_name};
		} catch (Exception $e) {
			return false;
		}
	}

}
