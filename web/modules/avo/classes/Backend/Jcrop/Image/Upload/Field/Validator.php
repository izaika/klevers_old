<?php defined('SYSPATH') or die('No direct script access.');

class Backend_Jcrop_Image_Upload_Field_Validator extends AVO_Abstract_Parametrized_Class {

	public $message;
	public $match_field;
	public $is_message_encoded = false;
	public $is_upload_mandatory = true;

	public function __construct(array $properties = array())
	{
		parent::__construct($properties);
		if (!isset($properties['message'])) $this->message = __('not uploaded');
	}


	public function validate(Backend_Jcrop_Image_Upload_Field $field, AVO_Controls_List $controls)
	{
		if ($field->is_validation_disabled)
		{
			return TRUE;
		}
		else
		{
			$model = $field->model;
			$ext = $controls->{$field->name.'__uploaded_ext'}->value();

			$field->is_uploaded = ($ext !== null) && is_file($model::get_temp_storage_base($field->upload_id).$model::$ORIGINAL_NAME.'.'.$ext);

			if (!$this->is_upload_mandatory || $field->is_uploaded) return TRUE;
			/* @var $image Model_Generic_Image */
			$image = new $model($controls->id->value());
			if ($image->loaded())
			{
				return (bool) $image->{$image::$uid_field_name};
			}
			else
			{
				return FALSE;
			}

		}
	}

}
