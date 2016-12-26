<?php defined('SYSPATH') OR die('No direct script access.');

abstract class AVO_Data_Form extends AVO_Data_Abstract_Component {

	const HTML_CLASS_PLAIN_SHEET = 'plain_sheet';
	const HTML_CLASS_FRAMED_BOX = 'framed_box';

	/**
	 * allow to perform an insert action on the dataset
	 * @var bool
	 */
	public $allow_insert = TRUE;

	/**
	 * allow to perform an update action on the dataset
	 * @var bool
	 */
	public $allow_update = TRUE;

	/**
	 * clear the cache after save
	 * @var bool
	 */
	public $clear_cache = FALSE;

	/**
	 * close button title
	 * @var string
	 */
	public $close_button_title;

	/**
	 * form controls
	 * @var AVO_Controls_List
	 */
	public $controls;

	/**
	 * form HTML class
	 * @var string
	 */
	public $html_class = self::HTML_CLASS_PLAIN_SHEET;

	/**
	 * form title
	 * @var string
	 */
	public $title;

	/**
	 * form title class
	 * @var string
	 */
	public $title_class;

	/**
	 * send data back to the client on save
	 * @var bool
	 */
	public $send_data_back_on_save	= false;

	/**
	 * States whether to escalate the control to the parent after the data is saved
	 * @var bool
	 */
	public $escalate_control_on_save = true;

	/**
	 * field name that is used to check whether the new record is added
	 * if null no temporary record is created
	 * usually 'is_new' is used
	 *
	 * @var string
	 */
	public $new_record_flag;

	/**
	 * Form height in pixels
	 * @var integer
	 */
	public $height = 200;

	/**
	 * Form width in pixels
	 * @var integer
	 */
	public $width;

	/**
	 * additional action(s) initiating the save action
	 * @var mixed
	 */
	public $save_action;


	protected $action_handlers = array();

	public function register_action_handler($action_name, $handler)
	{
		$this->action_handlers[$action_name] = $handler;
	}


	/**
	 * Handles a requested action for the form
	 *
	 * @param $action string - action name
	 * @param $init_data bool - return an initial data for the object
	 * @return string JSON result structure
	 */
	public function handle_action($action = NULL, $init_data = FALSE)
	{
		$action_state = new AVO_Data_Form_Action_Result();
		$action_state->action = $action;
		$request = Request::current();

		// set the flag so the common event handlers can know who initiates an event
		$this->_control_owner = true;

		// initialize the controls
		$this->controls->init_with($this);


		if (!$init_data && $this->parameters !== NULL && $this->parameters->count() > 0)
		{
			$action_state->params_present = true;
			foreach ($this->parameters as $param)
			{
				if (!$param->server_side_only)
				{
					$val = $request->is_avo_ajax_upload() ? $request->query($param->name) : $request->post($param->name);
					if ($val !== null) $param->value($val);
				}
			}
		}

		// prefill fields with data
		if ( ! $init_data AND ! $request->is_avo_ajax_upload())
		{
			foreach ($this->controls as $field)
			{
				if ($field instanceof AVO_Field)
				{
					if ( ! $field->server_side_only)
					{
						$val = $request->post($field->name);
						if ($val !== NULL)
						{
							// apply filter to the received data
							if (is_array($field->filter) AND ! is_callable($field->filter))
							{
								foreach ($field->filter as $filter)
								{
									if (is_callable($filter)) $val = call_user_func_array($filter, array($val));
								}
							}
							elseif ($field->filter !== NULL)
							{
								if (is_callable($field->filter)) $val = call_user_func_array($field->filter, array($val));
							}
							if ($field->max_length !== NULL) $val = UTF8::substr($val, 0, $field->max_length);
							$field->value($val);
						}
					}
				}
			}
		}

		if ($action == 'save' || is_string($this->save_action) && ($action == $this->save_action) ||  is_array($this->save_action) && in_array($action, $this->save_action, true)) {
			$validation_failed = $this->on_validate($action_state);
			if ($validation_failed)
			{
				$action_state->message = $validation_failed;
				$action_state->status = 1;
			}
			else
			{
				$perform_save = TRUE;
				// on save envent handler
				$this->on_save($action_state);
				if ( ! $action_state->processed)
				{
					$save_result = $this->datasource->save($this->controls, $this->parameters);
					if ($save_result->status)
					{
						$action_state->status = $save_result->status;
						$action_state->message = $save_result->message;
						$action_state->escalate_control = FALSE;
					}
					else
					{
						$action_state->message = __('data is saved successfully');
						$action_state->escalate_control = $this->escalate_control_on_save;
						$action_state->escalate_action = 'get_data';
						$action_state->id = $save_result->id;
						if ($this->send_data_back_on_save)
						{
							$action_state->get_data = TRUE;
						}

						// after_save event handler
						if ($save_result->affected_rows) $this->after_save($action_state);
					}
				}
			}
		}
		elseif ($action === null || $action == 'get_data')
		{
			$action_state->id = $this->controls->get_key_field()->value();
			$action_state->get_data = true;
			$action_state->get_parameters = $action_state->params_present;
			$this->on_get_data($action_state);
		}
		elseif ($action == 'update')
		{
			$controls_value = $request->post('controls');
			if ($controls_value !== null)
			{
				$action_state->fields2update = explode('|', $controls_value);
			}
			else
			{
				$action_state->fields2update = array();
			}

			// extract properties to update
			$_properties = $request->post('properties');
			if ($_properties)
			{
				$action_state->props2update = explode('|', $_properties);
			}
			else {
				$action_state->props2update = array();
			}
			unset($_properties);

			$action_state->get_data = true;
			$action_state->update_data = true;
		} elseif (method_exists($this, 'action_' . $action)) {
			$this->{'action_' . $action}($action_state);
		} elseif (isset($this->action_handlers[$action])) {
			$this->action_handlers[$action]($action_state);
		} else {
			$action_state->message = __('unknown action');
			$action_state->status = 1;
		}

		if ($action_state->get_data)
		{
			if ($action_state->id === NULL AND $this->new_record_flag !== null && !$action_state->update_data)
			{
				$save_result = $this->datasource->save($this->controls, $this->parameters);
				$action_state->id = $save_result->id;
				if ($save_result->status) {
					$action_state->status = $save_result->status;
					$action_state->message = $save_result->message;
				}
			}
			if ($action_state->id === null) {
				if (!$action_state->update_data) {
					if (!$this->allow_insert) {
						$action_state->message = __('adding is not allowed');
						$action_state->escalate_control = true;
						$action_state->status = 1;
					}
				}
			} else {
				if ($this->allow_update) {
					$this->controls->get_key_field()->value($action_state->id);
					$record = $this->datasource->find($this->controls, $this->parameters);
					if ($record === false) {
						$action_state->message = __('editing is not allowed');
						$action_state->escalate_control = true;
						$action_state->status = 1;
					}
				} else {
					$action_state->message = __('editing is not allowed');
					$action_state->escalate_control = true;
					$action_state->status = 1;
				}
			}
			if ($action_state->status == 0) {
				if ($action_state->id !== null) {
					// create a model
					if (property_exists($this->datasource, 'model_class_name') && $this->datasource->model_class_name && !is_array($record)) $this->controls->model($record);

					// fill fieldset with data from the datasource
					foreach ($this->controls as $field) {
						if ($field instanceof AVO_Field && !$field->calculated) {
							if (is_array($record)) {
								$field->value($record[$field->name]);
							} else {
								$field->value($record->{$field->name});
							}
						}
					}
					// apply functions to field values
					// this is a post fetching process because some data can
					// rely on previously calculated values
					foreach ($this->controls as $field)
					{
						if ($field instanceof AVO_Field AND ! $field->calculated)
						{
							if (is_callable($field->function, TRUE))
							{
								if (is_callable($field->function))
								{
									$field->value(call_user_func_array($field->function, array($field->value())));
								}
								elseif (is_string($field->function) && method_exists($this->datasource, $field->function))
								{
									// the function is a datasource method
									$field->value($this->datasource->{$field->function}($field->value(), $this->parameters));
								}
							}
						}
					}
				}
				// preform the field additional value calculation
				foreach ($this->controls as $field)
				{
					if ($field instanceof AVO_Field)
					{
						$field->value($field->on_calc());
					}
				}

				// final calculation in the form class
				$this->on_calc();

				// generate the JS array with values
				$i = 0;
				foreach ($this->controls as $field)
				{
					if ($field instanceof AVO_Field && (!is_array($action_state->fields2update) || in_array($field->name, $action_state->fields2update)) && !$field->server_side_only) {
						if ($i++) $action_state->data .= ',';
						$action_state->data .= json_encode($field->name) . ':';
						if ($field->type == AVO_Field::TYPE_LOOKUP) {
							$action_state->data .= '[' . $field->jsvalue() . ',[';
							// check if the null value should be in a list
							if ($field->lookup_offer_null) {
								$action_state->data .= '["",' . json_encode($field->lookup_null_result) . ']';
								$got_first = true;
							} else {
								$got_first = false;
							}
							$field->setup_lookup_datasource();
							$field->lookup_datasource->init();
							while ($record = $field->lookup_datasource->fetch($this->parameters))
							{
								if ($got_first) {
									$action_state->data .= ',';
								} else {
									$got_first = true;
								}
								if (is_array($record)) {
									$record_id = $record[$field->lookup_key_field_name];
									if ($field->lookup_type == AVO_Field::TYPE_INT) settype($record_id, 'int');
									$action_state->data .= '[' . json_encode($record_id) . ',' . json_encode($record[$field->lookup_result_field_name]) . ']';
								} else {
									$record_id = $record->{$field->lookup_key_field_name};
									if ($field->lookup_type == AVO_Field::TYPE_INT) settype($record_id, 'int');
									$action_state->data .= '[' . json_encode($record_id) . ',' . json_encode($record->{$field->lookup_result_field_name}) . ']';
								}
							}
							$action_state->data .= ']]';
						} else {
							$action_state->data .= $field->jsvalue();
						}
					}
				}

				// generate the JS array with properties
				$i = 0;
				foreach ($this->controls as $field) {
					if (($field instanceof AVO_Field|| $field instanceof AVO_Label || $field instanceof AVO_Button || $field instanceof AVO_Link)
							&& is_array($field->properties_to_update) && (!is_array($action_state->props2update) || in_array($field->name, $action_state->props2update))) {
						if (count($field->properties_to_update)) {
							if ($i++) $action_state->properties .= ',';
							$action_state->properties .= json_encode($field->name) . ':{';
							$j = 0;
							foreach ($field->properties_to_update as $prop_name) {
								if ($j++) $action_state->properties .= ',';
								$action_state->properties .= json_encode($prop_name) . ':';
								if (Text::starts_with($field->$prop_name, '{') && Text::ends_with($field->$prop_name, '}')) {
									// json hash
									$action_state->properties .= $field->$prop_name;
								} else {
									$action_state->properties .= json_encode($field->$prop_name);
								}
							}
							$action_state->properties .= '}';
						}
					}
				}

				if ($this->title !== false) $action_state->title = $this->on_calc_title();
			}
		}
		// generate the parameters js array
		if ($action_state->get_parameters) {
			$i = 0;
			foreach ($this->parameters as $param) {
				if (!$param->server_side_only)
				{
					if ($i++)
					{
						$action_state->params .= ',';
					}
					$action_state->params .= $param->jsvalue();
				}
			}
		}

		$result = '{';
		if ($action_state->update_data) $result .= '"update":true,';
		if ($action_state->data !== null) $result .= '"data":{' . $action_state->data . '},';
		if ($action_state->title != '') $result .= '"title":' . json_encode($action_state->title) . ',';
		if ($action_state->properties != '') $result .= '"properties":{' . $action_state->properties . '},';
		if ($action_state->perform_action !== null) $result .= '"perform_action":' . json_encode($action_state->perform_action) . ',';
		if ($action_state->escalate_control) $result .= '"escalate_control":true,';
		if ($action_state->delay_escalate_control) $result .= '"delay_escalate_control":true,';
		if ($action_state->escalate_action !== null) $result .= '"escalate_action":"' . $action_state->escalate_action . '",';

		if (is_array($action_state->message)) {
			$result .= '"message":[';
			$i = 0;
			foreach ($action_state->message as $msg_item) {
				if ($i++) {
					$result .= ',';
				}
				if (is_array($msg_item)) {
					$result .= '[' . json_encode($msg_item[0]) . ',' . json_encode($msg_item[1]) . ',' . json_encode(isset($msg_item[2]) ? $msg_item[2] : false) . ']';
				} else {
					$result .= json_encode($msg_item);
				}
			}
			$result .= '],';
		}
		elseif ($action_state->message !== NULL)
		{
			$result .= '"message":'.json_encode($action_state->message).',';
		}
		if ($action_state->get_parameters) $result .= '"parameters":['.$action_state->params.'],';
		$result .= '"executed_action":'.json_encode($action).',';
		$result .= '"status":'.$action_state->status;
		$result .= '}';

		$this->_control_owner = false;
		return $result;
	}


	/**
	 * When a form requests to get the data
	 * Enter description here ...
	 * @param AVO_Data_Form_Action_Result $result
	 */
	public function on_get_data(AVO_Data_Form_Action_Result $result) {}


	/**
	 * Calculates the form title
	 *
	 * @return string
	 */
	public function on_calc_title()
	{
		if ($this->new_record_flag !== NULL)
		{
			$is_new_record = $this->controls->{$this->new_record_flag}->value();
		}
		else
		{
			$key_field = $this->controls->get_key_field();
			if ($key_field !== NULL)
			{
				$is_new_record = ! $key_field->value();
			}
			else
			{
				$is_new_record = NULL;
			}
		}
		if ($this->title === NULL)
		{
			if ($is_new_record !== NULL) return $is_new_record ? __('add new record') : __('edit record');
		}
		else
		{
			if (is_array($this->title))
			{
				if ($is_new_record !== NULL) return $is_new_record ? $this->title[0] : $this->title[1];
			}
			else
			{
				return $this->title;
			}
		}
	}


	/**
	 * Perform a validation of data before saving
	 * @return string error message
	 * @return array(field_name, text_message, is_text_message_html_encoded). Field name can be null, message can be html encoded
	 * @return array of mixed options described above
	 */
	public function on_validate(AVO_Data_Form_Action_Result $result)
	{
		return $this->controls->validate($this->parameters);
	}


	/**
	 * Executes when the data is about to be saved to the data source
	 * @param AVO_Data_Form_Action_Result $result
	 */
	public function on_save(AVO_Data_Form_Action_Result $result) {}


	/**
	 * Executes after the data is saved to the data source
	 * @param AVO_Data_Form_Action_Result $result
	 */
	public function after_save(AVO_Data_Form_Action_Result $result)
	{
		foreach ($this->controls as $field)
		{
			if ($field instanceof AVO_Field)
			{
				$field->after_save($result);
			}
		}
		if ($this->clear_cache) File::clear_cache();
	}


	/**
	 * Renders an object for further reference
	 *
	 * @return string
	 */
	public function render()
	{
		$result = '{'
			. 'name:' . json_encode($this->name)
			. ',controls:' . $this->controls->render()
			. ',controller_url:' . json_encode($this->_get_controller_url())
			. (($this->close_button_title === null) ? '' : (',close_button_title:' . json_encode($this->close_button_title)))
			. (($this->title === null || is_array($this->title)) ? '' : (',title:' . json_encode($this->title)))
			. (($this->html_class === null) ? '' : (',html_class:' . json_encode($this->html_class)))
			. (($this->title_class === null) ? '' : (',title_class:' . json_encode($this->title_class)))
			. (($this->width === null) ? '' : (',width:' . json_encode($this->width)))
			. (($this->height == 200) ? '' : (',height:' . json_encode($this->height)))
			. (($this->parameters !== null && $this->parameters->count() > 0) ? (',parameters:' . $this->parameters->render()) : '')
			;
		if ($this->forms !== null)
		{
			$result .= ',forms:{';
			$i = 0;
			foreach ($this->forms as $name => $form)
			{
				if ($i++) $result .= ',';
				$result .= '"'.$name.'":'.$form->render();
			}
			$result .= '}';
		}
		$result .= '}';
		if ($this->class_extension !== null) $result = '$.extend('.$result.','.$this->class_extension.')';
		return 'new AVO.Data_Form(' . $result . ')';
	}


	/**
	 * Renders an object with initiation
	 *
	 * @param $initiate string yes/no/ajax/direct
	 * @return string
	 */
	public function render_object($initiate = 'no')
	{
		$var_name = $this->js_name();
		$result =
			'<script type="text/javascript">'
			.$var_name.'='.$this->render().';';
		if ($initiate != 'no') {
			if ($initiate == 'ajax')
			{
				$result .= $var_name.'.render();';
			}
			else
			{ // usually 'yes'
				$result .= $var_name.'.render('.$this->handle_action(null, true).');';
			}
		}
		return $result.'</script>';
	}

}
