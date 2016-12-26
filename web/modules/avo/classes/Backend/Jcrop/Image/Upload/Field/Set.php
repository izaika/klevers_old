<?php defined('SYSPATH') OR die('No direct access allowed.');

class Backend_Jcrop_Image_Upload_Field_Set extends AVO_Controls_List {


	public $options;
	public $upload_id;
	public $is_validation_disabled = FALSE;


	/**
	 * Return new Backend_Jcrop_Image_Upload_Field
	 * @param array $array
	 * @return Backend_Jcrop_Image_Upload_Field
	 */
	protected static function _new_Backend_Image_Upload_Field(array $array = array())
	{
		return new Backend_Jcrop_Image_Upload_Field($array);
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
			'is_upload_mandatory'			=> TRUE,
			'image'							=> TRUE,
		), $settings);

		$this->upload_id = Request::current()->reqister_upload_variable($options['upload_variable_name']);

		$model = $options['model'];

		$this->append(
			new AVO_Field(array(
				'name'			=> $options['field_name'] . '__true_size',
				'type'			=> AVO_Field::TYPE_STRING,
				'hidden'		=> TRUE,
				'calculated'	=> TRUE,
// 				'title'			=> 'true size ',
// 				'width'			=> 460,
				'value'			=> NULL,
				'class_extension'	=> '{
					trueSize: null,
					onChange: function(is_manual) {
						try {
							this.trueSize = $.parseJSON( this.value );
							if (!this.trueSize) {
								this.trueSize = {
									"w": null,
									"h": null,
									"r": null
								};
							}
						} catch (e) {
							this.trueSize = {
								"w": null,
								"h": null,
								"r": null
							};
						}
					}
				}',
			))
		);

		// Usual controls
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

		// Append jcrop data set
		$this->append(
			new AVO_Layout_Control(array(
				'layout',	'new AVO.Horizontal_Layout({"padding":4})'
			))
		);

		$this->append(
			new AVO_Field(array(
				'name'			=> $model::$crop_data_field_name,
				'type'			=> AVO_Field::TYPE_STRING,
	 			'hidden'		=> TRUE,
				'class_extension' => '{
					cropData: {},
					initCropData: function() {
						try {
							this.cropData = $.parseJSON(this.value);
						} catch (e) {
							this.cropData = {};
						}
						if (!this.cropData) {
							this.cropData = {};
						}
					},
					updateCropData: function(sizeSetName, sizeSetData) {
						this.cropData[sizeSetName] = sizeSetData;

						// this will cause onChange call
						this.updatePageControlValue(JSON.stringify(this.cropData));

					},
					getCropData: function(sizeSetName) {
						if (this.cropData) {
							var sizeSet = this.cropData[sizeSetName];
							if (sizeSet) {
								return [
									sizeSet.x,
									sizeSet.y,
									sizeSet.x2,
									sizeSet.y2,
									sizeSet.w,
									sizeSet.h
								];
							}
						}
						return [10,10,110,110,100,100];	// reasonable defaults
					},
					onChange: function(is_manual) {
						this.initCropData();
					}
				}'
			))
		);

		// append image selection buttons
		foreach ($model::$SIZES as $size_set_name => $size_set_data)
		{
			if ($size_set_name == $model::FORM_PREVIEW_NAME || $size_set_name == $model::GRID_PREVIEW_NAME || $size_set_name == $model::$NORMALIZED_NAME) {
				continue;
			}
			$this->append(
				new AVO_Button(array(
					'name'		=> $options['field_name'] . '__jcrop_activate_' . $size_set_name,
					'value'		=> __(':kind :wpx × :hpx', array(':kind' => $size_set_name, ':w' => $size_set_data['width'], ':h' => $size_set_data['height'])),
					'icon'		=> 'icon-edit',
					'html_class'	=> 'jcrop_button',
					'class_extension'	=> '{
						jcropData: '. json_encode(array(
							'n' => $size_set_name,
							'w' => $size_set_data['width'],
							'h' => $size_set_data['height'],
							'r' => $size_set_data['width'] / $size_set_data['height']
						)) .',
						jcropUpdateCropDataField: function(c) {
							this.parent().control("'.$model::$crop_data_field_name.'").updateCropData(this.jcropData.n, c);
						},
						onClick: function (event) {

							var form = this.parent();
							var image = $(">img", form.control("' . $options['field_name'] . '").pageControl());

							var trueSize = form.control("'.$options['field_name'].'__true_size").trueSize;

							var JcropAPI = form.control("'.$options['field_name'].'").JcropAPI;

							if (JcropAPI) {
								$("button.jcrop_button", form.placeholder()).removeClass("active");
								this.pageControl().addClass("active");
								JcropAPI.setOptions({
									onSelect: null
								});
								JcropAPI.disable();
								var updateCoords = $.proxy(this.jcropUpdateCropDataField, this);

								var jcropStatus = this.parent().control("'.$model::$crop_data_field_name.'").getCropData(this.jcropData.n);

								JcropAPI.setOptions({
									aspectRatio: this.jcropData.r,
									trueSize: [trueSize.w, trueSize.h],
									setSelect: jcropStatus,
									onSelect: updateCoords
								});
								JcropAPI.enable();

							}

							event.preventDefault();
						}
					}',
				))
			);
		}

		$this->append(
			AVO_Layout_Control::end_layout()
		);

		$this->append(
			new AVO_Layout_Control(array(
				'style',	'{"text-align": "center", "width": "' . ($model::FORM_PREVIEW_W + 4) . 'px", "height": "' . ($model::FORM_PREVIEW_H + 4) . 'px"}',
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
				'upload_id'					=> $this->upload_id,
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
					'name'		=> 'button__delete_' . $options['field_name'],
					'value'		=> __('delete…'),
					'icon'		=> 'cancel',
					'class_extension'	=> '{
						onClick: function (event) {
							if (confirm(' . json_encode(__('Are you sure you want to delete the image?')) . ')) {
								var form = this.parent();
								form.control("' . $options['field_name'] . '__is_deleted").updatePageControlValue(1);
								form.control("' . $options['field_name'] . '").updatePageControlValue(' . json_encode(HTML::__('image has been deleted')) . ');
								form.control("' . $options['field_name'] . '__uploaded_ext").updatePageControlValue("");
								form.control("' . $model::$title_field_name . '").updatePageControlValue("");
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
						form.control("'.$options['field_name'].'__true_size").updatePageControlValue(JSON.stringify(data.data.normalized_dims));
						form.control("'.$options['field_name'].'__uploaded_ext").updatePageControlValue(AVO.HTML.decode(data.data.ext));
						'.($options['is_upload_mandatory'] ? ' ' : ('form.control("'.$options['field_name'].'__is_deleted").updatePageControlValue(0);')).'
						'.($options['is_upload_mandatory'] ? ' ' : ('form.control("button__delete_'.$options['field_name'].'").pageControl().show();')).'
						form.control("'.$model::$title_field_name.'").updatePageControlValue(AVO.HTML.decode(data.data.title));
					}
				}',
			)),
			new AVO_Layout_Control(array(
				'style',	'{"padding-left": "50px"}'
			)),
			new AVO_Field(array(
				'name'			=> $model::$title_field_name,
				'type'			=> AVO_Field::TYPE_STRING,
				'calculated'	=> TRUE,
				'title'			=> new AVO_Label(array(
					'value'	=> $options['title'].' '.__('title'),
					'hint' 	=> __('used as a file name and title attribute of the image'),
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
				if ($controls->{$this->options['field_name'].'__is_deleted'}->value()) return true;

				$model = $upload_field->model;
				$image = new $model($controls->id->value());
				if ($image->loaded())
				{
					$url = $image->url($image::$ORIGINAL_NAME);
					if (!$url) return TRUE;
					return AVO_Validator_Not_Null::is_valid($field->value());
				}
				else
				{
					return TRUE;
				}
			}
		}
	}


}
