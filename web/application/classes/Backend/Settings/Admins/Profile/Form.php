<?php defined('SYSPATH') OR die('No direct script access.');

class Backend_Settings_Admins_Profile_Form extends Backend_Settings_Admins_Form {

	public function __construct($admin_id)
	{
		parent::__construct();

		$this->title = __('My profile');
		$this->close_button_title = NULL;

		$this->datasource = new Backend_Settings_Admins_Datasource();
		$this->controls->id->fixed_value = $admin_id;

		// remove the last button
		$this->controls[count($this->controls) - 2] = new AVO_Layout_Control(array());
		$this->controls[count($this->controls) - 3] = new AVO_Layout_Control(array());

	}

}
