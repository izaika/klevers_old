<?php

class Backend_Categories_Form extends AVO_Data_Form
{

	public function __construct()
	{
		parent::__construct();

		$this->title_class = 'ico32 ico32-picture_dawn';
		$this->title = ['Add new category', 'Edit category'];
		$this->close_button_title = __('Back');
		$this->clear_cache = true;
		$this->icon_upload_id = Request::current()->reqister_upload_variable('_fu_icon_file');
		$this->pdf_upload_id = Request::current()->reqister_upload_variable('_fu_pdf_file');

		$this->controls = new AVO_Controls_List([
			new AVO_Field([
				'name'			=> 'id',
				'type'			=> AVO_Field::TYPE_INT,
				'key'			=> true,
				'hidden'		=> true,
			]),
			new AVO_Layout_Control([
				'layout',	'new AVO.Tabbed_Layout()',
			]),
				new AVO_Layout_Control([
					'page',	'Texts',
					'valign', 'top',
					'layout', 'new AVO.Grid_Layout({})',
				]),
					new AVO_Field([
						'name'			=> 'heading',
						'title'			=> 'Heading',
						'type'			=> AVO_Field::TYPE_STRING,
						'width'			=> 400,
						'max_length'	=> 256,
						'validator'		=> new AVO_Validator_Not_Null,
					]),
					new AVO_Field([
						'name'			=> 'description',
						'title'			=> 'Short description',
						'type'			=> AVO_Field::TYPE_TEXT,
						'width'			=> 400,
						'height'		=> 150,
						'max_length'	=> 256,
						'validator'		=> new AVO_Validator_Not_Null,
					]),
				AVO_Layout_Control::end_layout(),
				new AVO_Layout_Control([
					'page',	'PDF',
					'valign', 'top',
					'layout', 'new AVO.Grid_Layout({})',
				]),
					new AVO_Field([
						'name'			=> 'pdf_title',
						'title'			=> 'PDF title',
						'type'			=> AVO_Field::TYPE_STRING,
						'width'			=> 400,
						'max_length'	=> 256,
						'hidden'		=> true,
						'value'			=> 'pdf'
						// 'validator'		=> new AVO_Validator_Not_Null,
					]),
					new AVO_Field(array(
						'name'				=> 'pdf_uid',
						'type'				=> AVO_Field::TYPE_STRING,
						'server_side_only'	=> true,
					)),
					new AVO_Field(array(
						'name'				=> 'pdf_filename',
						'type'				=> AVO_Field::TYPE_STRING,
						'server_side_only'	=> true,
					)),
					new AVO_Field(array(
						'name'				=> 'pdf_filesize',
						'type'				=> AVO_Field::TYPE_INT,
						'server_side_only'	=> true,
					)),
					new AVO_Field(array(
						'name'			=> 'uploaded_pdf_filename',
						'type'			=> AVO_Field::TYPE_STRING,
						'hidden'		=> true,
						'calculated'	=> true,
					)),
					new AVO_Field(array(
						'name'			=> 'pdf_file_link',
						'type'			=> AVO_Field::TYPE_STRING,
						'title'			=> 'PDF file',
						'width'			=> 400,
						'calculated'	=> true,
						'encoded'		=> true,
						// 'validator'		=> new AVO_Validator_Not_Null
					)),
					new AVO_Field(array(
						'name'				=> 'is_pdf_file_attached',
						'type'				=> AVO_Field::TYPE_BOOL,
						'hidden'			=> true,
						'calculated'		=> true,
						'class_extension'	=> '{
							onChange: function (isManual) {
								var del_button = this.parent().control("delete_pdf_file").pageControl();
								if (this.formValue()) {
									del_button.show();
								} else {
									del_button.hide();
								}
							}
						}',
					)),
					new AVO_Label(),
					new AVO_Layout_Control(array(
						'layout', 'new AVO.Horizontal_Layout()',
					)),
						new AVO_Button(array(
							'name'		=> 'upload_pdf_file',
							'type'		=> AVO_Button::TYPE_UPLOAD,
							'value'		=> __('upload…'),
							'icon'		=> 'icon-file',
							'class_extension'	=> '{
								onUploadComplete: function(file_name, data) {
									if (data.status) return;
									var form = this.parent();
									form.control("pdf_file_link").updatePageControlValue(AVO.HTML.decode(data.data.pdf_file_link));
									form.control("uploaded_pdf_filename").updatePageControlValue(AVO.HTML.decode(data.data.file_name));
									form.control("is_pdf_file_attached").updatePageControlValue(1);
								}
							}',
						)),
						new AVO_Button(array(
							'name'				=> 'delete_pdf_file',
							'type'				=> AVO_Button::TYPE_BUTTON,
							'value'				=> __('delete…'),
							'icon'				=> 'icon-remove',
							'class_extension'	=> '{
								onClick: function () {
									var form = this.parent();
									form.control("pdf_file_link").updatePageControlValue('.json_encode(HTML::__('file is not uploaded yet')).');
									form.control("uploaded_pdf_filename").updatePageControlValue("");
									form.control("is_pdf_file_attached").updatePageControlValue(0);
									return false;
								}
							}',
						)),
					AVO_Layout_Control::end_layout(),
				AVO_Layout_Control::end_layout(), // end of pdf tab
				new AVO_Layout_Control([
					'page',	'SVG Icon',
					'valign', 'top',
					'layout', 'new AVO.Grid_Layout({})',
				]),
					new AVO_Field(array(
						'name'				=> 'icon_uid',
						'type'				=> AVO_Field::TYPE_STRING,
						'server_side_only'	=> true,
					)),
					new AVO_Field(array(
						'name'				=> 'icon_filename',
						'type'				=> AVO_Field::TYPE_STRING,
						'server_side_only'	=> true,
					)),
					new AVO_Field(array(
						'name'				=> 'icon_filesize',
						'type'				=> AVO_Field::TYPE_INT,
						'server_side_only'	=> true,
					)),
					new AVO_Field(array(
						'name'			=> 'uploaded_icon_filename',
						'type'			=> AVO_Field::TYPE_STRING,
						'hidden'		=> true,
						'calculated'	=> true,
					)),
					new AVO_Field(array(
						'name'			=> 'icon_file_link',
						'type'			=> AVO_Field::TYPE_STRING,
						'title'			=> new AVO_Label([
							'value'	=> 'SVG Icon',
							'hint'	=> 'Should be compound path and without <style> tags inside of the file'
						]),
						'width'			=> 400,
						'calculated'	=> true,
						'encoded'		=> true,
						'validator'		=> new AVO_Validator_Not_Null
					)),
					new AVO_Field(array(
						'name'				=> 'is_icon_file_attached',
						'type'				=> AVO_Field::TYPE_BOOL,
						'hidden'			=> true,
						'calculated'		=> true,
						'class_extension'	=> '{
							onChange: function (isManual) {
								var del_button = this.parent().control("delete_icon_file").pageControl();
								if (this.formValue()) {
									del_button.show();
								} else {
									del_button.hide();
								}
							}
						}',
					)),
					new AVO_Label(),
					new AVO_Layout_Control(array(
						'layout', 'new AVO.Horizontal_Layout()',
					)),
						new AVO_Button(array(
							'name'		=> 'upload_icon_file',
							'type'		=> AVO_Button::TYPE_UPLOAD,
							'value'		=> __('upload…'),
							'icon'		=> 'icon-file',
							'class_extension'	=> '{
								onUploadComplete: function(file_name, data) {
									if (data.status) return;
									var form = this.parent();
									form.control("icon_file_link").updatePageControlValue(AVO.HTML.decode(data.data.icon_file_link));
									form.control("uploaded_icon_filename").updatePageControlValue(AVO.HTML.decode(data.data.file_name));
									form.control("is_icon_file_attached").updatePageControlValue(1);
									form.control("svg_preview").updatePageControlValue(AVO.HTML.decode(data.data.svg_preview));
									if (form.control("animation_property").formValue() == "'.Model_Category::ANIMATE_STROKE.'") {
										$(".cat_icon").removeClass("animate_fill").addClass("animate_stroke");
									} else {
										$(".cat_icon").removeClass("animate_stroke").addClass("animate_fill");
									}
								}
							}',
						)),
						new AVO_Button(array(
							'name'				=> 'delete_icon_file',
							'type'				=> AVO_Button::TYPE_BUTTON,
							'value'				=> __('delete…'),
							'icon'				=> 'icon-remove',
							'class_extension'	=> '{
								onClick: function () {
									var form = this.parent();
									form.control("icon_file_link").updatePageControlValue('.json_encode(HTML::__('file is not uploaded yet')).');
									form.control("uploaded_icon_filename").updatePageControlValue("");
									form.control("is_icon_file_attached").updatePageControlValue(0);
									form.control("svg_preview").updatePageControlValue("");
									return false;
								}
							}',
						)),
					AVO_Layout_Control::end_layout(),
					new AVO_Field(array(
						'name'				=> 'animation_property',
						'type'				=> AVO_Field::TYPE_LOOKUP,
						'lookup_datasource'	=> new AVO_Data_Source_Array([
							'dataset'	=> [
								['id' => Model_Category::ANIMATE_FILL, 'name' => 'Fill'],
								['id' => Model_Category::ANIMATE_STROKE, 'name' => 'Stroke']
							],
						]),
						'lookup_offer_null' => false,
						'width'				=> 400,
						'validator'			=> new AVO_Validator_Not_Null,
						'title'				=> 'SVG color animation property',
						'class_extension'	=> '{
							onChange: function (e) {
								var form = this.parent();
								var value = form.control("animation_property").formValue();
								switch (value) {
									case "'.Model_Category::ANIMATE_STROKE.'":
										$(".cat_icon").removeClass("animate_fill").addClass("animate_stroke");
										break;
									default: // Model_Category::ANIMATE_FILL
										$(".cat_icon").removeClass("animate_stroke").addClass("animate_fill");
										break;
								}
							}
						}'
					)),
					new AVO_Field(array(
						'name'				=> 'svg_preview',
						'type'				=> AVO_Field::TYPE_STRING,
						'width'				=> 400,
						'title'				=> 'SVG icon preview',
						'encoded'			=> true,
						'calculated'		=> true,
					)),
				AVO_Layout_Control::end_layout(), // end of svg icon tab
				new AVO_Layout_Control([
					'page',	'Projects',
					'valign', 'top',
					'layout', 'new AVO.Grid_Layout({})',
				]),
					new AVO_Link([
						'name'		=> 'link_projects',
						'child'		=> new Backend_Categories_Projects_Grid,
						'params'	=> ['id' => 'category_id'],
					]),
				AVO_Layout_Control::end_layout(), // end of blocks tab
			AVO_Layout_Control::end_layout(), // end of all tabs
			new AVO_Layout_Control([
				'align',	'right',
				'layout',	'new AVO.Horizontal_Layout({padding:4})'
			]),
				AVO_Button::standard(AVO_Button::STD_SAVE),
				new AVO_Layout_Control([
					'style', 'padding-left:30px',
				]),
				AVO_Button::standard(AVO_Button::STD_CANCEL),
			AVO_Layout_Control::end_layout(),
		]);

		$this->class_extension = '{
			layout: new AVO.Grid_Layout({columns: 1}),
		}';
	}


	public function on_validate(AVO_Data_Form_Action_Result $result)
	{
		if ($this->controls->is_icon_file_attached->value()) {
			$this->controls->icon_file_link->validator = null;
		}
		if ($this->controls->is_pdf_file_attached->value()) {
			$this->controls->pdf_file_link->validator = null;
		}
		$validation = parent::on_validate($result);
		return $validation;
	}

	/**
	 * calculates the file link for dowloading
	 *
	 */
	public function on_calc()
	{
		parent::on_calc();

		$id = $this->controls->id->value();
		$category = Model_Category::factory(null, $id);
		if ($category->loaded()) {
			if ($this->controls->icon_uid->value()) {
				$this->controls->icon_file_link->value(HTML::anchor(
					$category->download_url(),
					HTML::entities($this->controls->icon_filename->value())
				));
				$this->controls->is_icon_file_attached->value(1);

				$animate_stroke = $category->animation_property == $category::ANIMATE_STROKE;
				$animation_class = $animate_stroke ? ' animate_stroke' : ' animate_fill';
				$this->controls->svg_preview->value($category->icon_uid ? '<div class="cat_icon'.$animation_class.'">'.file_get_contents($category->file_storage()).'</div>' : "");
			}
			if ($this->controls->pdf_uid->value()) {
				$category_pdf = Model_Category_Pdf::factory(null, $id);
				$this->controls->pdf_file_link->value(HTML::anchor(
					$category_pdf->download_url(),
					HTML::entities($this->controls->pdf_filename->value())
				));
				$this->controls->is_pdf_file_attached->value(1);
			}
		} else {
			$this->controls->is_icon_file_attached->value(0);
			$this->controls->icon_file_link->value(HTML::__('file is not uploaded yet'));
			$this->controls->is_pdf_file_attached->value(0);
			$this->controls->pdf_file_link->value(HTML::__('file is not uploaded yet'));
		}
	}

	/**
	 * processes the file uploading
	 *
	 * @param AVO_Data_Form_Action_Result $result
	 */
	public function action_upload_icon_file(AVO_Data_Form_Action_Result $result)
	{
		$result->processed = true;

		$upload = qqFileUploader::get();
		if ($upload) {
			// save file to a temporary location
			$tmp_file_path = Model_Category::get_temp_storage($this->icon_upload_id);
			$upload->save($tmp_file_path);
			chmod($tmp_file_path, 0664);

			// prepare the response to the client
			$file_name = $upload->getName();
			$icon_file_link = HTML::anchor(Model_Category::download_temp_url($this->icon_upload_id, $file_name), HTML::entities($file_name));

			$svg_preview = '<div class="cat_icon">'.file_get_contents(Model_Category::get_temp_storage($this->icon_upload_id)).'</div>';
			$result->data =
				'"icon_file_link":' . json_encode(HTML::entities($icon_file_link)) .
				',"file_name":' . json_encode(HTML::entities($file_name)) .
				',"svg_preview":' . json_encode(HTML::entities($svg_preview))
			;
			$result->message = __('file uploaded successfully');
		} else {
			$result->status = 1;
			$result->message = __('failed to upload file');
		}
	}


	/**
	 * processes the file uploading
	 *
	 * @param AVO_Data_Form_Action_Result $result
	 */
	public function action_upload_pdf_file(AVO_Data_Form_Action_Result $result)
	{
		$result->processed = true;

		$upload = qqFileUploader::get();
		if ($upload) {
			// save file to a temporary location
			$tmp_file_path = Model_Category_Pdf::get_temp_storage($this->pdf_upload_id);
			$upload->save($tmp_file_path);
			chmod($tmp_file_path, 0664);

			// prepare the response to the client
			$file_name = $upload->getName();
			$pdf_file_link = HTML::anchor(Model_Category_Pdf::download_temp_url($this->pdf_upload_id, $file_name), HTML::entities($file_name));

			$result->data =
				'"pdf_file_link":' . json_encode(HTML::entities($pdf_file_link)) .
				',"file_name":' . json_encode(HTML::entities($file_name))
			;
			$result->message = __('file uploaded successfully');
		} else {
			$result->status = 1;
			$result->message = __('failed to upload file');
		}
	}


	/**
	 * saves the uploaded file
	 *
	 * @param AVO_Data_Form_Action_Result $result
	 */
	public function after_save(AVO_Data_Form_Action_Result $result)
	{
		parent::after_save($result);

		$is_icon_file_uploaded = ($this->controls->is_icon_file_attached->value() && $this->controls->uploaded_icon_filename->value() !== null) && is_file(Model_Category::get_temp_storage($this->icon_upload_id));
		$is_pdf_file_uploaded = ($this->controls->is_pdf_file_attached->value() && $this->controls->uploaded_pdf_filename->value() !== null) && is_file(Model_Category_Pdf::get_temp_storage($this->pdf_upload_id));

		$id = (int) $result->id;
		if (!$this->controls->is_icon_file_attached->value()) {
			// remove the file
			$icon_file = new Model_Category($id);
			$icon_file->icon_uid = $icon_file->icon_filesize = $icon_file->icon_filename = null;
			$icon_file->save();
			return;
		}
		if (!$this->controls->is_pdf_file_attached->value()) {
			// remove the file
			$pdf_file = new Model_Category_Pdf($id);
			$pdf_file->pdf_uid = $pdf_file->pdf_filesize = $pdf_file->pdf_filename = null;
			$pdf_file->save();
			return;
		}

		if ($is_icon_file_uploaded) {
			// save the file
			$icon_tmp_file_name = Model_Category::get_temp_storage($this->icon_upload_id);
			$id = (int) $result->id;
			$uid = md5(uniqid(rand(), true));
			$save_dir = DOCROOT.Model_Category::$FILE_STORAGE_PATH.$id.'/';
			File::rm_dir($save_dir);
			$saved_mask = umask(0002);
			@mkdir($save_dir, 0775, true);
			umask($saved_mask);
			$save_file_name = $save_dir.$uid;

			// move the file
			@rename($icon_tmp_file_name, $save_file_name);
			@chmod($save_file_name, 0664);

			// update the database
			// save
			$icon_file = new Model_Category($id);
			$icon_file->icon_uid = $uid;
			$icon_file->icon_filesize = filesize($save_file_name);
			$icon_file->icon_filename = $this->controls->uploaded_icon_filename->value();
			$icon_file->save();
		}
		if ($is_pdf_file_uploaded) {
			// save the file
			$pdf_tmp_file_name = Model_Category_Pdf::get_temp_storage($this->pdf_upload_id);
			$id = (int) $result->id;
			$uid = md5(uniqid(rand(), true));
			$save_dir = DOCROOT.Model_Category_Pdf::$FILE_STORAGE_PATH.$id.'/';
			File::rm_dir($save_dir);
			$saved_mask = umask(0002);
			@mkdir($save_dir, 0775, true);
			umask($saved_mask);
			$save_file_name = $save_dir.$uid;

			// move the file
			@rename($pdf_tmp_file_name, $save_file_name);
			@chmod($save_file_name, 0664);

			// update the database
			// save
			$pdf_file = new Model_Category_Pdf($id);
			$pdf_file->pdf_uid = $uid;
			$pdf_file->pdf_filesize = filesize($save_file_name);
			$pdf_file->pdf_filename = $this->controls->uploaded_pdf_filename->value();
			$pdf_file->save();
		}
	}
}
