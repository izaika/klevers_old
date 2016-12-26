<?php defined('SYSPATH') OR die('No direct script access.');

class Backend_Settings_Admins_Form extends AVO_Data_Form {

	public function __construct()
	{
		parent::__construct();

		$this->title_class = 'ico32 ico32-man_operator';
		$this->title = array(__('add new administrator'), __('modify administrator'));
		$this->close_button_title = __('back');

		$this->controls = new AVO_Controls_List(array(
			new AVO_Field(array(
				'name'			=> 'id',
				'type'			=> AVO_Field::TYPE_INT,
				'key'			=> TRUE,
				'title'			=> __('id'),
				'width'			=> 32,
				'hidden'		=> TRUE,
			)),
			new AVO_Field(array(
				'name'			=> 'full_name',
				'type'			=> AVO_Field::TYPE_STRING,
				'title'			=> __('name'),
				'width'			=> 300,
				'default_focus'	=> TRUE,
				'max_length'	=> 128,
				'validator'		=> new AVO_Validator_Not_Null(),
			)),
			new AVO_Field(array(
				'name'			=> 'login',
				'type'			=> AVO_Field::TYPE_STRING,
				'title'			=> __('login'),
				'width'			=> 200,
				'max_length'	=> 64,
				'filter'		=> 'utf8::strtolower',
				'validator'		=> new AVO_Validator_Not_Null(),
			)),
			new AVO_Field(array(
				'name'			=> 'password',
				'password'		=> TRUE,
				'type'			=> AVO_Field::TYPE_STRING,
				'title'			=> __('password'),
				'width'			=> 200,
				'max_length'	=> 64,
				'calculated'	=> TRUE,
				'validator'		=> array(
					new AVO_Validator_Password_Match(array(
						'match_field'	=> 'conf_pwd'
					))
				),
			)),
			new AVO_Field(array(
				'name'			=> 'conf_pwd',
				'password'		=> TRUE,
				'calculated'	=> TRUE,
				'type'			=> AVO_Field::TYPE_STRING,
				'title'			=> __('confirm'),
				'width'			=> 200,
				'max_length'	=> 64
			)),
			new AVO_Field(array(
				'name'			=> 'email',
				'type'			=> AVO_Field::TYPE_STRING,
				'title'			=> __('email'),
				'width'			=> 300,
				'max_length'	=> 128,
				'validator'		=> array(
					new AVO_Validator_Not_Null(),
					new AVO_Validator_Email()
				)
			)),
			new AVO_Layout_Control(array(
				'colspan',	2,
				'align',	'right',
				'layout',	'new AVO.Horizontal_Layout({padding:4})'
			)),
				AVO_Button::standard(AVO_Button::STD_SAVE),
				new AVO_Layout_Control(array(
					'style', 'padding-left:30px',
				)),
				AVO_Button::standard(AVO_Button::STD_CANCEL),
			AVO_Layout_Control::end_layout()
		));
	}


	/**
	 * Calculates confirmed password by default for the admin user editor form
	 *
	 */
	public function on_validate(AVO_Data_Form_Action_Result $result)
	{
		if ( ! $this->controls->id->value())
		{
			$v = $this->controls->password->validator;
			array_unshift($v, new AVO_Validator_Not_Null);
			$this->controls->password->validator = $v;
		}

		return parent::on_validate($result);
	}


	/**
	 * Save the encoded password
	 *
	 * @see AVO_Data_Form::after_save()
	 */
	public function after_save(AVO_Data_Form_Action_Result $result)
	{
		parent::after_save($result);

		if ($this->controls->password->value() != '')
		{
			$admin = new Model_Administrator($result->id);
			$admin->password = password_hash($this->controls->password->value(), PASSWORD_DEFAULT);
			$admin->save();
			Kohana::$log->add(Log::INFO, 'Password is changed for admin :user', array(':user' => $admin->login));
		}
	}

}
