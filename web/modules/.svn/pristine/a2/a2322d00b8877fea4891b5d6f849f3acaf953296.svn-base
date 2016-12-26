<?php defined('SYSPATH') OR die('No direct access allowed.');

class Backend_Image_Upload_Field_Set extends AVO_Controls_List {

	public $options;
	public $upload_id;
	public $is_validation_disabled = FALSE;

	/**
	 * Return new Backend_Image_Upload_Field
	 * @param array $array
	 * @return Backend_Image_Upload_Field
	 */
	protected static function _new_Backend_Image_Upload_Field(array $array = array())
	{
		return new Backend_Image_Upload_Field($array);
	}


	public function __construct($settings)
	{
		parent::__construct(array());

		// set the properties
		$this->options = $options = Arr::merge(array(
			'title'							=> __('image'),
			'note'							=> '',
			'model'							=> '',
			'field_name'					=> 'image',
			'upload_variable_name'			=> 'upload_id',
			'video_action_url'				=> URL::site('admin/helper/add_video'),
			'video_preview_width'			=> 320,
			'is_upload_mandatory'			=> true,
			'vimeo'							=> false,
			'youtube'						=> false,
			'image'							=> true,
			'is_zoomed_preview_enabled'		=> true,
			'form_preview_w_name'			=> 'FORM_PREVIEW_W',
			'form_preview_h_name'			=> 'FORM_PREVIEW_H',
			'form_preview_name_name'		=> 'FORM_PREVIEW_NAME',
		), $settings);

		$this->upload_id = Request::current()->reqister_upload_variable($options['upload_variable_name']);

		$model = $options['model'];

		$media_selector_present = ($options['vimeo'] || $options['youtube']);

		if ($media_selector_present)
		{
			$this->append(
					new AVO_Layout_Control(array(
						'layout',	'new AVO.Horizontal_Layout({"id":"media_type_'.$options['field_name'].'"})'
					)),
					new AVO_Field(array(
						'name'				=> $model::$media_type_field_name,
						'type'				=> AVO_Field::TYPE_LOOKUP,
						'lookup_datasource'	=> $this->get_media_type(),
						'lookup_offer_null' => FALSE,
						'value'				=> (
							$options['image']
								? Model_Generic_Image::MEDIA_TYPE_IMAGE
								: ($options['vimeo']
									? Model_Generic_Image::MEDIA_TYPE_VIMEO
									: Model_Generic_Image::MEDIA_TYPE_YOUTUBE)
						),
						'title'				=> __('select media type'),
						'class_extension'	=> '{
							onChange: function() {
								var media_type = this.pageControl().val();
								var upl_button = $("button[name=\"upload_'.$options['field_name'].'\"]");
								if (media_type != 0) {
									upl_button.css("visibility", "hidden");
									$("#video_wrapper_'.$options['field_name'].'").show();
								} else {
									upl_button.css("visibility", "visible");
									$("#video_wrapper_'.$options['field_name'].'").hide();
// 									$(".note").text('.json_encode($options['note']).');
								}
							}
						}',
					)),
					new AVO_Field(array(
						'name'			=> 'video_id',
						'type'			=> AVO_Field::TYPE_STRING,
						'hidden'		=> true,
						'calculated'	=> true,
					)),
					AVO_Layout_Control::end_layout()
			);
		}
		$this->append(
			new AVO_Layout_Control(array(
				'layout',	'new AVO.Grid_Layout({"columns": 1, "fieldset": '.json_encode($options['title']).'})'
			))
		);
		if ($options['note'])
		{
			$this->append(new AVO_Label(array(
				'value'	=> $options['note'],
				'html_class' => 'note'
			)));
		}

		$ww = constant($model.'::'.$options['form_preview_w_name']);
		$hh = constant($model.'::'.$options['form_preview_h_name']);
		$this->append(
				new AVO_Layout_Control(array(
					'style',	'{"text-align": "center", "width": "' . ($ww + 4) . 'px", "height": "' . ($hh + 4) . 'px"}',
				)),
				new AVO_Field(array(
					'name'			=> $options['field_name'].'__uploaded_ext',
					'type'			=> AVO_Field::TYPE_STRING,
					'hidden'		=> true,
					'calculated'	=> true,
				)),

				static::_new_Backend_Image_Upload_Field(array(
					'name'						=> $options['field_name'],
					'err_title'					=> $options['title'],
					'model'						=> $model,
					'upload_variable_name'		=> $options['upload_variable_name'],
					'is_upload_mandatory'		=> $options['is_upload_mandatory'],
					'media_selector_present'	=> $media_selector_present,
					'upload_id'					=> $this->upload_id,
					'is_zoomed_preview_enabled'	=> $options['is_zoomed_preview_enabled'],
					'form_preview_w_name'		=> $options['form_preview_w_name'],
					'form_preview_h_name'		=> $options['form_preview_h_name'],
					'form_preview_name_name'	=> $options['form_preview_name_name'],
				)),

				new AVO_Layout_Control(array(
					'layout',	'new AVO.Horizontal_Layout()'
				))
		);
		if (!$options['is_upload_mandatory'])
		{
			$this->append(
				new AVO_Field(array(
					'name'			=> $options['field_name'] . '__is_deleted',
					'type'			=> AVO_Field::TYPE_STRING,
					'hidden'		=> true,
					'calculated'	=> true,
				)),
				new AVO_Field(array(
					'name'				=> $options['field_name'] . '__display_delete_button',
					'type'				=> AVO_Field::TYPE_STRING,
					'hidden'			=> true,
					'calculated'		=> true,
					'class_extension'	=> '{
						onChange: function () {
							var button = this.parent().control("button__delete_' . $options['field_name'] . '").pageControl();
							if (parseInt(this.value)) {
								button.show();
							} else {
								button.hide();
							}
						}
					}'
				)),
				new AVO_Layout_Control(array(
					'style',	'{"padding-right": "8px"}'
				)),
				new AVO_Button(array(
					'name'		=> 'button__delete_'.$options['field_name'],
					'value'		=> __('delete…'),
					'icon'		=> 'cancel',
					'class_extension'	=> '{
						onClick: function (event) {
							if (confirm(' . json_encode(__('Are you sure you want to delete the image?')) . ')) {
								var form = this.parent();
								form.control("' . $options['field_name'] . '__is_deleted").updatePageControlValue(1);
								form.control("' . $options['field_name'] . '").updatePageControlValue(' . json_encode(HTML::__('image has been deleted')) . ');
								form.control("' . $options['field_name'] . '__uploaded_ext").updatePageControlValue("");
								form.control("' . $options['field_name'] . '__' . $model::$title_field_name . '").updatePageControlValue("");
								this.pageControl().hide();
							}
							event.preventDefault();
						}
					}',
				))
			);
		}
		$this->append(
					new AVO_Button(array(
						'name'		=> 'upload_' . $options['field_name'],
						'type'		=> AVO_Button::TYPE_UPLOAD,
						'value'		=> __('upload…'),
						'icon'		=> 'picture',
						'class_extension'	=> '{
							allowed_extensions: ["jpg", "jpeg", "gif", "png"],
							onUploadComplete: function(file_name, data) {
								if (data.status) return;
								var form = this.parent();
								form.control("'.$options['field_name'].'").updatePageControlValue(AVO.HTML.decode(data.data.image));
								form.control("'.$options['field_name'].'__uploaded_ext").updatePageControlValue(AVO.HTML.decode(data.data.ext));
								'.($options['is_upload_mandatory'] ? ' ' : ('form.control("'.$options['field_name'].'__is_deleted").updatePageControlValue(0);')).'
								'.($options['is_upload_mandatory'] ? ' ' : ('form.control("button__delete_'.$options['field_name'].'").pageControl().show();')).'
								var title_control = form.control("'.$options['field_name'] . '__' . $model::$title_field_name.'");
								if (title_control.formValue() == "")	{
									title_control.updatePageControlValue(AVO.HTML.decode(data.data.title));
								}
							}
						}',
					)),
					new AVO_Layout_Control(array(
						'style',	'{"padding-left": "50px"}'
					)),
					new AVO_Field(array(
						'name'			=> $options['field_name'] . '__' . $model::$title_field_name,
						'type'			=> AVO_Field::TYPE_STRING,
						'calculated'	=> TRUE,
						'title'			=> new AVO_Label(array(
							'value'	=> $options['title'].' '.__('title'),
							'hint' 	=> __('used as a file name, title attribute and a caption of the image'),
						)),
						'width'			=> 200,
						'max_length'	=> 128,
						'default_focus'	=> TRUE,
						'validator'		=> new AVO_Validator_Custom(array(
							'message'		=> __('value cannot be empty'),
							'on_validate'	=> array($this, 'on_validate_title')
						)),
					)),
				AVO_Layout_Control::end_layout(),
			AVO_Layout_Control::end_layout()
		);
		if ($options['vimeo'] || $options['youtube'])
		{
			$this->append(
				new AVO_Layout_Control(array(
					'layout',	'new AVO.Grid_Layout({"id":"video_wrapper_'.$options['field_name'].'","columns": 3, "fieldset": ' . json_encode(__('video')) . '})'
				)),
				new AVO_Field(array(
					'name'			=> $model::$video_url_field_name,
					'type'			=> AVO_Field::TYPE_STRING,
					'title'			=> new AVO_Label(array(
						'value' => __('video URL'),
						'hint' => __('provide an URL in "http://vimeo.com/NNNNNNN" vimeo format or NNNNNNNN youtube format'),
					)),
					'width'			=> 300,
					'max_length'	=> 256,
					'filter'		=> array('URL', 'add_proto'),
					'validator'		=> array(
						new AVO_Validator_Not_Null(),
					),
				)),
				new AVO_Button(array(
					'name'		=> 'add_video',
					'type'		=> AVO_Button::TYPE_BUTTON,
					'value'		=> __('fetch snapshot'),
					'icon'		=> 'icon-film',
					'class_extension'	=> '{
						onClick: function() {
							var form = this.parent();
							var video_url = form.control("'.$model::$video_url_field_name.'").pageControl().val();
							var media_type = form.control("'.$model::$media_type_field_name.'").pageControl().val();
								$.ajax({url: "' . $options['video_action_url'] . '",
										dataType: "json",
										type: "POST",
										data: {media_type: media_type, url: video_url, upload_id: ' . $this->upload_id . ', width: ' . $options['video_preview_width'] . '},
										success: function(data){
											if (data.status == 0) {
												form.control("' . $options['field_name'] . '").updatePageControlValue(data.html);
												form.control("' . $options['field_name'] . '__' . $model::$title_field_name . '").updatePageControlValue(data.title);
												form.control("video_id").updatePageControlValue(video_url);
												form.control("' . $options['field_name'] . '__uploaded_ext").updatePageControlValue(data.ext);
											} else {
												form.control("' . $options['field_name'] . '").updatePageControlValue(data.message);
											}
										}
								});
							return false;
						}
					}',
				)),
				AVO_Layout_Control::end_layout()
			);
		}
	}


	public function enable_validation()
	{
		$this->is_validation_disabled = FALSE;
		$this->{$this->options['field_name']}->enable_validation();
	}


	public function disable_validation()
	{
		$this->is_validation_disabled = TRUE;
		$this->{$this->options['field_name']}->disable_validation();
	}


	public function on_validate_title(AVO_Field $field, AVO_Controls_List $controls = NULL)
	{
		if ($this->is_validation_disabled) return TRUE; // no validation

		if ($this->options['is_upload_mandatory'])
		{
			return AVO_Validator_Not_Null::is_valid($field->value());
		}
		else
		{
			$upload_field = $controls->{$this->options['field_name']};
			if ($upload_field->is_uploaded)
			{
				return AVO_Validator_Not_Null::is_valid($field->value());
			}
			else
			{
				if ($controls->{$this->options['field_name'].'__is_deleted'}->value()) return TRUE;

				$model = $upload_field->model;
				$image = new $model($controls->id->value());
				if ($image->loaded())
				{
					$url = $image->url($image::$ORIGINAL_NAME);
					if ( ! $url) return TRUE;
					return AVO_Validator_Not_Null::is_valid($field->value());
				}
				else
				{
					return TRUE;
				}
			}
		}
	}


	public function get_media_type()
	{
		$dataset = array();
		if ($this->options['image']) $dataset[] = array('id' => Model_Generic_Image::MEDIA_TYPE_IMAGE, 'name' => __('Image'));
		if ($this->options['vimeo']) $dataset[] = array('id' => Model_Generic_Image::MEDIA_TYPE_VIMEO, 'name' => __('Vimeo video'));
		if ($this->options['youtube']) $dataset[] = array('id' => Model_Generic_Image::MEDIA_TYPE_YOUTUBE, 'name' => __('Youtube video'));
		return new AVO_Data_Source_Array(array(
			'dataset' => $dataset
		));
	}

}
