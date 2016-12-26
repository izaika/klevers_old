<?php defined('SYSPATH') or die('No direct script access.');

class AVO_Media_Browser extends AVO_Abstract_Parametrized_Class {

	public $after_delete;
	public $allow_delete = true;
	public $allow_insert = true;
	public $allow_update = true;

	/**
	 * browser data source
	 * @var AVO_Data_Source_DB
	 */
	public $datasource;

	/**
	 * fields
	 * @var AVO_Controls_List
	 */
	public $fields;
	public $forms;
	public $name;

	/**
	 * browser parameters
	 * @var AVO_Controls_List
	 */
	public $parameters;
	public $class_extension;
	public $controller_url;
	public $control_owner;
	public $width = 300;
	public $height = 300;

	/**
	 * event handler for custom actions
	 * @var mixed
	 */
	public $on_action;
	public $on_calc;
	public $on_check_parameters;
	public $on_delete;


	private function _get_controller_url() {
		return URL::append_url_params(
			($this->controller_url === null) ? URL::site(Request::detect_uri()) : $this->controller_url,
			array('__avo_ajax_controller' => $this->name)
		);
	}


	/**
	 * Handles a requested action for the browser
	 *
	 * @param $action string - action name
	 * @param $init_data bool - return an initial data for the object
	 * @return string JSON result structure
	 */
	public function action_handler($action = null, $init_data = false) {
		$status = 0;
		$message = null;
		$records = null;
		$total = 0;
		$get_data = false;
		$get_parameters = false;
		$params_present = false;
		$params = '';

		// set the flag so the common event handlers can know who initiates an event
		$this->control_owner = true;

		$request = Request::current();

		// get state parameters
		$process_action = true;
		if (!$init_data && $this->parameters !== null && $this->parameters->count() > 0) {
			$params_present = true;
			$cnt = $this->parameters->count();
			foreach ($this->parameters as $param) {
				$value = $request->post($param->name);
				if ($value !== null) $param->value($value);
			}
			if (is_callable($this->on_check_parameters)) {
				$result = call_user_func($this->on_check_parameters);
				$process_action = $result->processed;
				$status = $result->status;
				$message = $result->message;
				$get_data = $result->get_data;
			}
		}
		// process the action
		if ($process_action) {
			if ($init_data) {
				$get_data = true;
			} elseif ($action === null || $action == 'get_data') {
				$get_data = true;
				$get_parameters = $params_present;
			} elseif ($action == 'move') {
				if (isset($_POST['__avo_src_id']) && isset($_POST['__avo_postion']) && isset($_POST['__avo_ref_id'])) {
					$this->fields->get_key_field()->value($_POST['__avo_src_id']);
					$this->datasource->move(
						$this->fields,
						$_POST['__avo_postion'],
						$_POST['__avo_ref_id']
					);
				}
			} elseif ($action == 'delete') {
				if ($this->allow_delete) {
					$key_field_name = $this->fields->get_key_field()->name;
					if (isset($_POST[$key_field_name])) {
						$ids = array_unique(array_map('intval', explode(',', $_POST[$key_field_name])));
						if (is_callable($this->on_delete)) {
							$result = call_user_func_array($this->on_delete, array($ids));
							$processed = $result->processed;
							$status = $result->status;
							$message = $result->message;
							$get_data = $result->get_data;
						} else {
							$processed = false;
						}
						if (!$processed) {
							$deleted_count = 0;
							foreach ($ids as $id) {
								$this->fields->get_key_field()->value($id);
								$result = $this->datasource->delete($this->fields);
								if ($result->status != 0) {
									$status = 1;
									if ($message == null) $message = array();
									if (!is_array($message)) $message = array($message);
									$message[] = $result->message;
								} elseif ($result->affected_rows) {
									$deleted_count += $result->affected_rows;
									if (is_callable($this->after_delete)) {
										call_user_func_array($this->after_delete, array($this, $id));
									}
								}
							}
							if ($status == 1) {
								$message = implode("\n", $message);
							} else {
								$status = 2;
								if ($deleted_count == 1) {
									$message = __('one item has been deleted');
								} else {
									$message = __(':n items have been deleted', array(':n' => $deleted_count));
								}
							}
						}
					}
				} else {
					$message = __('deleting is not allowed');
					$status = 1;
				}
			} elseif (is_callable($this->on_action)) {
				/* @var $result AVO_Media_Browser_Action_Result */
				$result = new AVO_Media_Browser_Action_Result();
				$result->params_present = $params_present;
				call_user_func_array($this->on_action, array($this, $action, $result));
				if ($result->processed) {
					$status = $result->status;
					$message = $result->message;
					$get_data = $result->get_data;
					$records = $result->records;
				} else {
					$message = __('unknown action :action', array(':action' => $action));
					$status = 1;
				}
			} else {
				$message = __('unknown action :action', array(':action' => $action));
				$status = 1;
			}
		}

		if ($get_data) {
			$records = '';
			$this->datasource->init();
			$total = $this->datasource->ds_total();

			$i = 0;
			while ($record = $this->datasource->fetch()) {

				// fill fieldset with data from the datasource
				foreach ($this->fields as $field) {
					if ($field instanceof AVO_Field && !$field->calculated) {
						$field->value($record->{$field->name});
					}
				}

				// apply functions to field values
				// this is a post fetching process because some data can
				// rely on previously calculated values
				foreach ($this->fields as $field) {
					if ($field instanceof AVO_Field && is_callable($field->function, true)) {
						if (is_callable($field->function)) {
							$field->value(call_user_func_array($field->function, array($field->value())));
						} elseif (is_string($field->function) && is_callable(array($this->datasource, $field->function))) {
							// the function is a datasource method
							$field->value(call_user_func_array(array($this->datasource, $field->function), array($field->value())));
						}
					}
				}
				if ($this->on_calc !== null) call_user_func_array($this->on_calc, array($this));

				// generate the JS array with values
				if ($i++) $records .= ',';
				$records .= '{';
				$j = 0;
				foreach ($this->fields as $field) {
					$is_a_field = ($field instanceof AVO_Field);
					if ($is_a_field && $field->server_side_only) continue;
					if ($j++) $records .= ',';
					$records .= json_encode($field->name) . ':';
					$records .= $is_a_field ? $field->jsvalue() : null;
				}
				$records .= '}';
			}
		}

		// generate the parameters js array
		if ($get_parameters) {
			$i = 0;
			foreach ($this->parameters as $param) {
				if ($i++) $params .= ',';
				$params .= $param->jsvalue();
			}
		}

		$result = '{';
		if (is_array($message)) {
			$result .= '"message":[';
			$i = 0;
			foreach ($message as $msg_item) {
				if ($i++) $result .= ',';
				if (is_array($msg_item)) {
					$result .= '["' . $msg_item[0] . '",' . json_encode($msg_item[1]) . ']';
				} else {
					$result .= json_encode($msg_item);
				}
			}
			$result .= '],';
		} elseif ($message !== null) {
			$result .= '"message":' . json_encode($message) . ',';
		}
		if ($records !== null) $result .= '"records":[' . $records . '],';
		if ($get_parameters) $result .= '"parameters":[' . $params . '],';
		$result .= '"executed_action":' . json_encode($action) . ',';
		$result .= '"status":' . $status;
		$result .= '}';

		$this->control_owner = false;
		return $result;
	}

	/**
	 * Renders an object for further reference
	 *
	 * @return string
	 */
	public function render() {
		$result =
			'new AVO.Media_Browser({' .
				'name:' . json_encode($this->name) .
				',fields:' . $this->fields->render() .
				',controller_url:' . json_encode($this->_get_controller_url()) .
				',msg_confirm_delete:' . json_encode(__('Are you sure you want to delete this item?')) .
				',msg_invalid_file_type:' . json_encode(__('invalid file type')) .
				',msg_delete:' . json_encode(__('delete')) .
				',msg_download:' . json_encode(__('download')) .
				',msg_zoom_in:' . json_encode(__('zoom in')) .
				($this->allow_insert ? '' : ',allow_insert:false') .
				($this->allow_update ? '' : ',allow_update:false') .
				($this->allow_delete ? '' : ',allow_delete:false') .
				(($this->width == 300) ? '' : (',width:' . json_encode($this->width))) .
				(($this->height == 300) ? '' : (',height:' . json_encode($this->height))) .
				(($this->parameters !== null && $this->parameters->count() > 0) ? (',parameters:' . $this->parameters->render()) : '')
			;
		if ($this->forms !== null) {
			$result .= ',forms:{';
			$i = 0;
			foreach ($this->forms as $name => $form) {
				if ($i++) $result .= ',';
				$result .= $name . ':' . $form->render();
			}
			$result .= '}';
		}
		if ($this->class_extension !== null) $result .= ',' . $this->class_extension;
		return $result . '})';
	}

	/**
	 * Renders an object with initiation
	 *
	 * @param $initiate string no/yes/ajax/direct
	 * @return string
	 */
	public function render_object($initiate = 'no') {
		$var_name = 'AVO_Registry[' . json_encode($this->name) . ']';
		$result =
			'<script type="text/javascript">'
			. $var_name . '=' . $this->render() . ';'
			;
		if ($initiate != 'no') $result .= $var_name . '.render(' . (($initiate == 'ajax') ? '' : (($initiate == 'yes') ? 'null' : $this->action_handler(null, true))). ');';
		return $result . '</script>';
	}
}
