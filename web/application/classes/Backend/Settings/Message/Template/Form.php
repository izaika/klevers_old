<?php defined('SYSPATH') or die('No direct access allowed.');

class Backend_Settings_Message_Template_Form extends AVO_Data_Form {

	public function __construct()
	{
		parent::__construct();

		$this->datasource = new AVO_Data_Source_DB(array(
			'find_query'		=>
				'SELECT *
				FROM message_templates
				WHERE id = :id',

			'update_query'		=>
				'UPDATE message_templates
				SET
					from_name = IF(is_from_required = 1, :from_name, from_name),
					from_address = IF(is_from_required = 1, :from_address, from_address),
					to_name = IF(is_to_required = 1, :to_name, to_name),
					to_address = IF(is_to_required = 1, :to_address, to_address),
					subject = :subject,
					body = :body,
					modified = CURRENT_TIMESTAMP,
					modify_count = modify_count + 1
				WHERE id = :id',
		));

		//$this->width = '100%';
		$this->title_class = 'ico32 ico32-letter2';

		$this->controls = new AVO_Controls_List(array(
			new AVO_Field(array(
				'name'				=> 'id',
				'type'				=> AVO_Field::TYPE_INT,
				'key'				=> TRUE,
				'hidden'			=> TRUE,
			)),
			new AVO_Field(array(
				'name'				=> 'is_from_required',
				'type'				=> AVO_Field::TYPE_INT,
				'hidden'			=> TRUE,
			)),
			new AVO_Field(array(
				'name'				=> 'is_to_required',
				'type'				=> AVO_Field::TYPE_INT,
				'hidden'			=> TRUE,
			)),
			new AVO_Field(array(
				'name'				=> 'title',
				'type'				=> AVO_Field::TYPE_STRING,
				'server_side_only'	=> TRUE,
			)),
			new AVO_Label(),
			new AVO_Field(array(
				'name'			=> 'note',
				'type'			=> AVO_Field::TYPE_STRING,
				'encoded'		=> true,
				'width'			=> 400,
				'max_length'	=> 128,
				'function'		=> array('HTML', 'entities'),
				'html_class'	=> 'note',
			)),
			new AVO_Field(array(
				'name'			=> 'from_name',
				'type'			=> AVO_Field::TYPE_STRING,
				'title'			=> __('sender name'),
				'width'			=> 300,
				'default_focus'	=> TRUE,
				'max_length'	=> 64,
				'validator'		=> new AVO_Validator_Not_Null(),
			)),
			new AVO_Field(array(
				'name'			=> 'from_address',
				'type'			=> AVO_Field::TYPE_STRING,
				'title'			=> __('sender email'),
				'width'			=> 300,
				'max_length'	=> 64,
				'filter'		=> 'utf8::strtolower',
				'validator'		=> array(
					new AVO_Validator_Not_Null(),
					new AVO_Validator_Email(),
				),
			)),
			new AVO_Field(array(
				'name'			=> 'to_name',
				'type'			=> AVO_Field::TYPE_STRING,
				'title'			=> __('receipient name'),
				'width'			=> 300,
				'default_focus'	=> TRUE,
				'max_length'	=> 64,
				'validator'		=> new AVO_Validator_Not_Null(),
			)),
			new AVO_Field(array(
				'name'			=> 'to_address',
				'type'			=> AVO_Field::TYPE_STRING,
				'title'			=> __('receipient email'),
				'width'			=> 300,
				'max_length'	=> 64,
				'filter'		=> 'utf8::strtolower',
				'validator'		=> array(
					new AVO_Validator_Not_Null(),
					new AVO_Validator_Email(),
				),
			)),
			new AVO_Field(array(
				'name'			=> 'subject',
				'type'			=> AVO_Field::TYPE_STRING,
				'title'			=> __('subject'),
				'width'			=> 400,
				'max_length'	=> 128,
				'validator'		=> new AVO_Validator_Not_Null(),
			)),
			new AVO_Label(),
			new AVO_Field(array(
				'name'			=> 'macro_description',
				'type'			=> AVO_Field::TYPE_STRING,
				'encoded'		=> true,
				'width'			=> 400,
				'max_length'	=> 128,
				'function'		=> array($this, 'format_note'),
				'html_class'	=> 'note',
			)),
			new AVO_Field(array(
				'name'			=> 'body',
				'type'			=> AVO_Field::TYPE_TEXT,
				'title'			=> __('Body'),
				'width'			=> 400,
				'height'		=> 200,
				'max_length'	=> 65535,
				'validator'		=> new AVO_Validator_Not_Null(),
			)),
			new AVO_Label(),
			new AVO_Layout_Control(array('align',	'right')),
			AVO_Button::standard(AVO_Button::STD_SAVE),
		));

		$this->class_extension = '{
			afterUpdate: function(data) {
				// hide/show form fields
				var trs = this.control("from_name").pageControl().closest("TR");
				trs = trs.add(trs.next());
				if (this.control("is_from_required").value) {
					trs.show();
				} else {
					trs.hide();
				}

				// hide/show to fields
				trs = this.control("to_name").pageControl().closest("TR");
				trs = trs.add(trs.next());
				if (this.control("is_to_required").value) {
					trs.show();
				} else {
					trs.hide();
				}
			}
		}';
	}


	/**
	 * formats a note for output
	 * @param string $val
	 */
	public function format_note($val)
	{
		return nl2br(HTML::entities($val));
	}


	public function on_calc_title()
	{
		return $this->controls->title->value();
	}


	/**
	 * Perform a validation of data before saving
	 * @return string error message
	 * @return array(field_name, text_message, is_text_message_html_encoded). Field name can be null, message can be html encoded
	 * @return array of mixed options described above
	 */
	public function on_validate(AVO_Data_Form_Action_Result $result)
	{
		$ds = DB::query(Database::SELECT,
			'SELECT is_from_required, is_to_required
			FROM message_templates
			WHERE id = :id'
		)->param(':id', $this->controls->id->value())->execute();
		if ( ! $ds->get('is_from_required')) $this->controls->from_name->validator = $this->controls->from_address->validator = NULL;
		if ( ! $ds->get('is_to_required')) $this->controls->to_name->validator = $this->controls->to_address->validator = NULL;

		return parent::on_validate($result);
	}

}
