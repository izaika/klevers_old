<?php

class Backend_Auth_Login_Form extends AVO_Data_Form {

	public function __construct()
	{
		parent::__construct();

		$this->title_class = 'ico32 ico32-lock';
		$this->title = __('Sign in');
		$this->datasource = new AVO_Data_Source_Array(array(
			'dataset'	=> array(
				array('id' => 1, 'login' => NULL, 'password' => '')
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
				'name'			=> 'login',
				'type'			=> AVO_Field::TYPE_STRING,
				'default_focus'	=> TRUE,
				'title'			=> __('login'),
				'width'			=> 200,
				'max_length'	=> 64,
				'filter'		=> 'utf8::strtolower',
			)),
			new AVO_Field(array(
				'name'			=> 'password',
				'password'		=> TRUE,
				'type'			=> AVO_Field::TYPE_STRING,
				'title'			=> __('password'),
				'width'			=> 200,
				'max_length'	=> 64,
			)),
			new AVO_Label(),
			new AVO_Layout_Control(array('align', 'right')),
			AVO_Button::standard(AVO_Button::STD_LOGIN),
			new AVO_Layout_Control(array('colspan', '2')),
			new AVO_Label(array(
				'encoded'	=> TRUE,
				'value'		=> HTML::anchor('/admin/auth/remind', __('forgot your password?')),
			)),
		));
	}


	public function action_login(AVO_Data_Form_Action_Result $result)
	{
		// mark the action as processed
		$result->processed = TRUE;

		// check if the credentials are valid
		$login = $this->controls->login->value();
		$admin = Model_Administrator::factory()
			->where('login', '=', $login)
			->or_where('email', '=', $login)
			->find();

		$password = $this->controls->password->value();

		if ($admin->loaded() AND password_verify($password, $admin->password))
		{
			Session::instance()->set('admin:user_id', $admin->id);
			$result->perform_action = 'navigate';
			$result->data = '"url":'.json_encode(URL::site('admin'));
			Kohana::$log->add(Log::INFO, 'Admin :user has been logged in from IP :ip', array(':user' => $login, ':ip' => Request::$client_ip));
		}
		else
		{
			$this->controls->password->value(NULL);
			$result->status = 1;
			$result->message = HTML::__('Invalid login/password');
			$result->data = '"login":'.json_encode($login).',"password":null';
			Kohana::$log->add(Log::INFO, 'Admin :user failed to log in using password :password from IP :ip', array(':user' => $login, ':password' => $password, ':ip' => Request::$client_ip));
		}
	}

}
