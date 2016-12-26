<?php

class Backend_Auth_Remind_Password_Form extends AVO_Data_Form {

	public function __construct()
	{
		parent::__construct();

		$this->title_class = 'ico32 ico32-attachment';

		$this->title = __('Remind my password');
		$this->datasource = new AVO_Data_Source_Array(array(
			'dataset'	=> array(
				array('id' => 1, 'email' => NULL)
			)
		));

		$this->controls = new AVO_Controls_List(array(
			new AVO_Field(array(
				'name'				=> 'id',
				'type'				=> AVO_Field::TYPE_INT,
				'server_side_only'	=> TRUE,
				'fixed_value'		=> 1,
			)),
			new AVO_Field(array(
				'name'			=> 'email',
				'type'			=> AVO_Field::TYPE_STRING,
				'title'			=> __('your email'),
				'default_focus'	=> TRUE,
				'width'			=> 200,
				'max_length'	=> 96,
				'filter'		=> 'utf8::strtolower',
			)),
			new AVO_Label(),
			new AVO_Layout_Control(array('align', 'right')),
			new AVO_Button(array(
				'name'			=> 'btn_send',
				'html_class'	=> 'btn btn-primary',
				'icon'			=> 'envelope icon-white',
				'is_default'	=> TRUE,
				'action'		=> 'send',
				'value'			=> __('send')
			)),
			new AVO_Layout_Control(array('colspan', '2')),
			new AVO_Label(array(
				'encoded'	=> true,
				'value'		=> HTML::anchor('admin/auth', __('back to sign-in form')),
			)),
		));
	}


	public function action_send(AVO_Data_Form_Action_Result $result)
	{
		$result->processed = TRUE;

		$email = $this->controls->email->value();
		if ($email == '')
		{
			$result->message = array(array('email', __('please fill in')));
			$result->status = 1;
			return;
		}

		$admin = Model_Administrator::factory()->where('email', '=', $this->controls->email->value())->find();
		if ( ! $admin->loaded())
		{
			$result->message = __('account is not found');
			$result->status = 1;
			return;
		}

		// generate a new password
		$password = Text::random();
		$admin->password = password_hash($password, PASSWORD_DEFAULT);
		$admin->save();

		// send email
		$template = Model_Message_Template::find_by_id('REMIND_ADMIN_PASSWORD');

		$to = $admin->email;
		$from = array($template->from_address => $template->from_name);
		$subject = $template->subject;
		$message = str_replace(
			array('<%password%>', '<%login%>'),
			array($password, $admin->login),
			$template->body
		);
		try
		{
			if ( ! email::send($to, $from, $subject, $message)) throw new Exception('MTA problem');
			$result->message = __('Email with the password is sent');
		}
		catch (Exception $e)
		{
			$result->message = __('failed to send an email [:problem]', array(':problem' => $e->getMessage()));
			$result->status = 1;
		}
	}

}
