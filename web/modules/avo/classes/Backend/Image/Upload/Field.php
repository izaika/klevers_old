<?php

class Backend_Image_Upload_Field extends AVO_Field
{

	/**
	 * @var string
	 */
	public $model;
	public $is_uploaded;
	public $upload_id;
	public $upload_variable_name;
	public $is_upload_mandatory = TRUE;
	public $media_selector_present = FALSE;
	public $is_validation_disabled = FALSE;
	public $is_zoomed_preview_enabled = TRUE;
	public $form_preview_w_name = 'FORM_PREVIEW_W';
	public $form_preview_h_name = 'FORM_PREVIEW_H';
	public $form_preview_name_name = 'FORM_PREVIEW_NAME';


	/**
	 * Return new Backend_Image_Upload_Field_Validator
	 * @param array $array
	 * @return Backend_Image_Upload_Field_Validator
	 */
	protected static function _new_Backend_Image_Upload_Field_Validator(array $array = array())
	{
		return new Backend_Image_Upload_Field_Validator($array);
	}


	public function __construct(array $array = array())
	{
		parent::__construct($array);

		$this->type = self::TYPE_STRING;
		$this->encoded = TRUE;
		$this->calculated = TRUE;
		$this->validator = static::_new_Backend_Image_Upload_Field_Validator(array(
			'is_upload_mandatory' => $this->is_upload_mandatory
		));
	}


	public function on_init()
	{
		parent::on_init();
		/* @var $form AVO_Data_Form */
		$form = $this->parent->parent;
		$me = $this;
		$form->register_action_handler('upload_'.$this->name,
			function ($action_state) use ($me)
			{
				$me->action_handler($action_state);
			}
		);
	}



	public function enable_validation()
	{
		$this->is_validation_disabled = FALSE;
	}


	public function disable_validation()
	{
		$this->is_validation_disabled = TRUE;
	}

	/**
	 * calculates the image preview
	 *
	 */
	public function on_calc()
	{
		$id = $this->parent->id->value();
		$model = $this->model;
		$del_button_display_flag = $this->is_upload_mandatory ? NULL : $this->parent->{$this->name.'__display_delete_button'};
		if ($id)
		{
			/* @var $image Model_Generic_Image */
			$image = new $model($id);
			$this->parent->{$this->name . '__' . $model::$title_field_name}->value($image->{$model::$title_field_name});
			if ($image->loaded())
			{
				$url = $image->url($model::$ORIGINAL_NAME);
				if ($url)
				{
					if ($del_button_display_flag) $del_button_display_flag->value(1);
					if ($this->is_zoomed_preview_enabled)
					{
						return HTML::anchor(
							$url,
							HTML::image($image->url(constant($model.'::'.$this->form_preview_name_name))),
							array('class' => 'zoomed_preview')
						);
					}
					else
					{
						return HTML::image($image->url(constant($model.'::'.$this->form_preview_name_name)));
					}
				}
				else
				{
					if ($model::$video_url_field_name && $model::$media_type_field_name && isset($image->{$model::$video_url_field_name}) && $image->{$model::$video_url_field_name} && isset($image->{$model::$media_type_field_name}) AND $image->{$model::$media_type_field_name} != 0)
					{
						return $image->get_video(constant($model.'::'.$this->form_preview_w_name));
					}
				}
			}
		}
		else
		{
			$this->parent->{$this->name . '__' . $model::$title_field_name}->value('');
		}
		if ($del_button_display_flag) $del_button_display_flag->value(0);

		return HTML::__('not uploaded yet');
	}


	/**
	 * processes the file uploading
	 *
	 * @param AVO_Data_Form_Action_Result $result
	 */
	public function action_handler(AVO_Data_Form_Action_Result $result)
	{
		$result->processed = TRUE;

		$upload = qqFileUploader::get();
		if ($upload) {
			$model = $this->model;
			$tmp_file_path_base = $model::get_temp_storage_base($this->upload_id);
			$ext = $model::create_resized_images($upload->getTmpFileName(), $tmp_file_path_base);
			if ($ext !== FALSE)
			{
				// prepare the response to the client
				$title = pathinfo($upload->getName(), PATHINFO_FILENAME);
				$storage_url_base = $model::get_temp_storage_base_url($this->upload_id);
				$no_cache_suffix = '?nocache=' . mt_rand();
				if ($this->is_zoomed_preview_enabled)
				{
					$image = HTML::anchor(
						$storage_url_base.$model::$ORIGINAL_NAME.'.'.$ext.$no_cache_suffix,
						HTML::image($storage_url_base.constant($model.'::'.$this->form_preview_name_name).'.'.$ext.$no_cache_suffix),
						array('class' => 'zoomed_preview')
					);
				} else {
					$image = HTML::image($storage_url_base.constant($model.'::'.$this->form_preview_name_name).'.'.$ext.$no_cache_suffix);
				}
				$result->data = '"image":'.json_encode(HTML::entities($image)).',"title":' . json_encode(HTML::entities($title)) . ',"ext":' . json_encode(HTML::entities($ext));
				$result->message = __('image is uploaded successfully');
			} else {
				$result->status = 1;
				$result->message = __('invalid image format. jpeg, png and gif are supported');
			}
		} else {
			$result->status = 1;
			$result->message = __('failed to upload file');
		}
	}



	/**
	 * saves the uploaded file(s)
	 *
	 * @param AVO_Data_Form_Action_Result $result
	 */
	public function after_save(AVO_Data_Form_Action_Result $result)
	{
		parent::after_save($result);

		$id = (int) $result->id;
		$model = $this->model;
		/* @var $img Model_Generic_Image */
		$img = new $model($id);

		// reset the uid and ext fields if the image is marked as deleted
		if (!$this->is_upload_mandatory) {
			if ($this->parent->{$this->name.'__is_deleted'}->value()) {
				$img->{$img::$uid_field_name} = null;
				$img->{$img::$ext_field_name} = null;
			}
		}

		// save image title
		$img->{$img::$title_field_name} = $this->parent->{$this->name . '__' . $img::$title_field_name}->value();

		// save media type and video url
		if ($this->media_selector_present) {
			$img->{$img::$media_type_field_name} = $this->parent->{$img::$media_type_field_name}->value();
			if ($img->{$img::$media_type_field_name} == 0) {
				$img->{$img::$video_url_field_name} = null;
			} else {
				$img->{$img::$video_url_field_name} = $this->parent->{$img::$video_url_field_name}->value();
			}
		}

		// process the uploaded files
		if ($this->is_uploaded) {
			// save the files
			$id = (int) $result->id;
			$ext = $this->parent->{$this->name . '__uploaded_ext'}->value();
			$temp_storage_dir = $model::get_temp_storage_base($this->upload_id);
			$uid = md5_file($temp_storage_dir . $img::$ORIGINAL_NAME . '.' . $ext);
			$save_dir = DOCROOT . $model::$STORAGE_PATH . $id . '/';
			File::rm_dir($save_dir);
			$save_dir .= $uid . '/';
			$saved_mask = umask(0002);
			mkdir($save_dir, 0775, true);
			umask($saved_mask);


			// move the files
			$model::move_images($temp_storage_dir, $save_dir, $ext);

			// save location and type
			$img->{$img::$uid_field_name} = $uid;
			$img->{$img::$ext_field_name} = $ext;

			// save width and haight
			if ($img->has_column($img::$width_field_name) || $img->has_column($img::$height_field_name)) {
				/* @var $image Image */
				$image = Image::factory($save_dir . $img::$ORIGINAL_NAME . '.' . $ext);
				if ($img->has_column($img::$width_field_name)) $img->{$img::$width_field_name} = $image->width;
				if ($img->has_column($img::$height_field_name)) $img->{$img::$height_field_name} = $image->height;
			}
		}
		$img->save();
	}

}
