<?php defined('SYSPATH') OR die('No direct access allowed.');

class Backend_Jcrop_Image_Upload_Field extends AVO_Field {

	public $model;
	public $is_uploaded;
	public $upload_id;
	public $upload_variable_name;
	public $is_upload_mandatory = TRUE;
	public $is_validation_disabled = FALSE;


	public function __construct(array $array = array())
	{
		parent::__construct($array);

		$this->type = self::TYPE_STRING;
		$this->encoded = TRUE;
		$this->calculated = TRUE;
		$this->validator = static::_new_Backend_Image_Upload_Field_Validator(array(
			'is_upload_mandatory' => $this->is_upload_mandatory
		));


		$this->class_extension = '{
			JcropAPI: null,
			JcropInit: function(element) {
				if (this.JcropAPI) {
					this.JcropAPI.destroy();
				}
				if (element.length) {
					var t = this;
					element.Jcrop({},function(){
	  					t.JcropAPI = this;
						this.disable();

					});
				}
			},
			onChange: function(is_manual) {
				var pageControl = this.pageControl();
				this.JcropInit($(">img", pageControl));

				// TODO: implement updating of corresponding controls on image change
				var form = this.parent();
				$("button.jcrop_button", form.placeholder()).removeClass("active");

			}
		}';

	}


	/**
	 * Return new Backend_Jcrop_Image_Upload_Field_Validator
	 * @param array $array
	 * @return Backend_Jcrop_Image_Upload_Field_Validator
	 */
	protected static function _new_Backend_Image_Upload_Field_Validator(array $array = array())
	{
		return new Backend_Jcrop_Image_Upload_Field_Validator($array);
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
		if ($upload)
		{
			$model = $this->model;
			$tmp_file_path_base = $model::get_temp_storage_base($this->upload_id);
			$ext = $model::create_resized_images($upload->getTmpFileName(), $tmp_file_path_base);

			if ($ext !== FALSE)
			{
				// prepare the response to the client
				$title =  pathinfo($upload->getName(), PATHINFO_FILENAME);
				$storage_url_base = $model::get_temp_storage_base_url($this->upload_id);
				$no_cache_suffix = '?nocache=' . mt_rand();

				$image = HTML::image($storage_url_base.$model::FORM_PREVIEW_NAME.'.'.$ext.$no_cache_suffix);

				// Get NORMALIZED dimensions
				/* @var $image Image */
				$normalized_image = Image::factory($tmp_file_path_base.$model::$NORMALIZED_NAME.'.'.$ext);
				$normalized_dims = array(
					'w'	=> $normalized_image->width,
					'h'	=> $normalized_image->height,
					'r'	=> $normalized_image->width / $normalized_image->height,
				);

				$result->data = '"image":'.json_encode(HTML::entities($image)).',"title":' . json_encode(HTML::entities($title)) . ',"ext":' . json_encode(HTML::entities($ext)) . ',"normalized_dims":' . json_encode($normalized_dims);
				$result->message = __('image is uploaded successfully');
			}
			else
			{
				$result->status = 1;
				$result->message = __('invalid image format. jpeg, png and gif are supported');
			}
		}
		else
		{
			$result->status = 1;
			$result->message = __('failed to upload file');
		}
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
			/* @var $image Model_Generic_Cropable_Image */
			$image = new $model($id);
			$this->parent->{$model::$title_field_name}->value($image->{$model::$title_field_name});
			if ($image->loaded())
			{
				$url = $image->url($model::FORM_PREVIEW_NAME);
				if ($url)
				{
					$dims = $image->image_dims($model::$NORMALIZED_NAME);
					if ($dims === NULL)
					{
						// XXX: DIRTY
						$image->regenerate_this();
						$dims = $image->image_dims($model::$NORMALIZED_NAME);
					}
					$this->parent->{$this->name.'__true_size'}->value(json_encode($dims));
					if ($del_button_display_flag) $del_button_display_flag->value(1);
					return HTML::image($image->url($model::FORM_PREVIEW_NAME));
				}
			}
		}
		else
		{
			$this->parent->{$model::$title_field_name}->value('');
		}
		if ($del_button_display_flag) $del_button_display_flag->value(0);

		return HTML::__('not uploaded yet');
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
		/* @var $img Model_Generic_Cropable_Image */
		$img = new $model($id);

		// reset the uid and ext fields if the image is marked as deleted
		if (!$this->is_upload_mandatory)
		{
			if ($this->parent->{$this->name.'__is_deleted'}->value()) {
				$img->{$img::$uid_field_name} = NULL;
				$img->{$img::$ext_field_name} = NULL;
			}
		}

		// save image title
		$img->{$img::$title_field_name} = $this->parent->{$img::$title_field_name}->value();

		// save the crop data
		$img->{$img::$crop_data_field_name} = $this->parent->{$img::$crop_data_field_name}->value();

		// process the uploaded files
		if ($this->is_uploaded)
		{
			// save the files
			$id = (int) $result->id;
			$uid = md5(uniqid(rand(), TRUE));
			$save_dir = DOCROOT.$model::$STORAGE_PATH.$id.'/';
			File::rm_dir($save_dir);
			$save_dir .= $uid.'/';
			$saved_mask = umask(0002);
			mkdir($save_dir, 0775, TRUE);
			umask($saved_mask);

			$ext = $this->parent->{$this->name.'__uploaded_ext'}->value();

			// move the files
			$model::move_images($model::get_temp_storage_base($this->upload_id), $save_dir, $ext);

			// save location and type
			$img->{$img::$uid_field_name} = $uid;
			$img->{$img::$ext_field_name} = $ext;

			// save width and haight
			if ($img->has_column($img::$width_field_name) OR $img->has_column($img::$height_field_name))
			{
				/* @var $image Image */
				$image = Image::factory($save_dir.$img::$ORIGINAL_NAME.'.'.$ext);
				if ($img->has_column($img::$width_field_name)) $img->{$img::$width_field_name} = $image->width;
				if ($img->has_column($img::$height_field_name)) $img->{$img::$height_field_name} = $image->height;
			}
		}

		$img->save();
		// …and ensure that images set is regenerated, since crop_data may be modified
		$crop_data = @json_decode($img->{$img::$crop_data_field_name}, true);
		$img::create_resized_images($img->storage().$img::$ORIGINAL_NAME.'.'.$img->{$img::$ext_field_name}, $img->storage(), $crop_data);
	}


}
