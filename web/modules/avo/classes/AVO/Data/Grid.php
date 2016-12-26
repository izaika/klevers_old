<?php defined('SYSPATH') OR die('No direct script access.');

class AVO_Data_Grid extends AVO_Data_Abstract_Component {

	/**
	 * clear the cache after oparations that change the dataset
	 * @var string
	 */
	public $clear_cache = FALSE;

	/**
	 * event handler for custom actions
	 * @var mixed
	 */
	public $on_action;

	public $on_check_parameters;

	/**
	 * Allows record deleting
	 * @var bool
	 */
	public $allow_delete = TRUE;
	/**
	 * Allows adding a new record
	 * @var bool
	 */
	public $allow_insert = TRUE;
	/**
	 * Allows modifying an existing record
	 * @var bool
	 */
	public $allow_update = TRUE;
	/**
	 * Allows the dataset reordering
	 * @var bool
	 */
	public $allow_move = TRUE;

	/**
	 * grid fields
	 * @var AVO_Controls_List
	 */
	public $fields;

	public $page_size = 25;

	public $title;
	public $use_pager = TRUE;
	public $width = 'auto';
	public $height = 200;
	public $init_collapsed = FALSE;
	public $nowrap = FALSE;


	/**
	 * data source pager
	 * @var AVO_Data_Source_Pager
	 */
	protected $_pager;

	/**
	 * data source sorter
	 * @var AVO_Data_Source_Sorter
	 */
	protected $_sorter;


	/**
	 * Handles a requested action for the grid
	 *
	 * @param $action string - action name
	 * @param $init_data bool - return an initial data for the object
	 * @return string JSON result structure
	 */
	public function handle_action($action = null, $init_data = false)
	{
		if ($this->use_pager) $this->_pager = new AVO_Data_Source_Pager($this);
		$this->_sorter = new AVO_Data_Source_Sorter($this);

		$status = 0;
		$message = NULL;
		$rows = '';
		$total = 0;
		$get_data = FALSE;
		$get_parameters = FALSE;
		$params_present = FALSE;
		$params = '';
		$filter_field = $filter_value = NULL;

		// set the flag so the common event handlers can know who initiates an event
		$this->_control_owner = TRUE;

		$request = Request::current();

		// get state parameters
		$process_action = TRUE;
		if ($this->parameters AND $this->parameters->count() > 0)
		{
			if ($init_data)
			{
				$get_parameters = TRUE;
			}
			else
			{
				$params_present = TRUE;
				$cnt = $this->parameters->count();
				/* @var $param AVO_Field */
				foreach ($this->parameters as $param)
				{
					if (!$param->server_side_only)
					{
						$value = $request->post($param->name);
						if ($value !== NULL) $param->value($value);
					}
				}
				if (is_callable($this->on_check_parameters))
				{
					$result = call_user_func($this->on_check_parameters);
					$process_action = $result->processed;
					$status = $result->status;
					$message = $result->message;
					$get_data = $result->get_data;
				}
			}
		}

		// process the action
		if ($process_action)
		{
			if ($init_data)
			{
				$get_data = TRUE;
			}
			elseif ($action === NULL OR $action == 'get_data')
			{
				$this->_sorter->set_field_name($request->post('__avo_sortname'));
				$this->_sorter->set_direction($request->post('__avo_sortorder'));
				if ($this->use_pager)
				{
					$page = $request->post('__avo_page');
					if ($page !== NULL) $this->_pager->go2page((int) $page);
					$page_size = $request->post('__avo_rp');
					if ($page_size !== NULL) $this->_pager->set_size((int) $page_size);
					unset($page, $page_size);
				}

				$query_type = $request->post('__avo_qtype');
				$query = $request->post('__avo_query');
				if ($query_type !== NULL AND $query !== NULL)
				{
					// quick filtering
					$filter_by = Text::limit_chars($query, 512, '');	// sanitize the value
					if ($filter_by != '')
					{
						// check if the field is searchable
						$search_on = trim($query_type);
						$search_field = $this->fields->{$search_on};
						if ($search_field && $search_field instanceof AVO_Field && $search_field->searchable)
						{
							$filter_field = $search_field->name;
							$filter_value = $filter_by;
						}
					}
				}
				unset($query_type, $query);

				$get_data = TRUE;
				$get_parameters = $params_present;
			}
			elseif ($action == 'move')
			{
				if ($this->allow_move)
				{
					$src_id = $request->post('__avo_src_id');
					$position = $request->post('__avo_postion');
					$ref_id = $request->post('__avo_ref_id');
					$processed = true;
					$get_data = TRUE;
					$get_parameters = $params_present;
					if ($src_id !== NULL AND $position !== NULL AND $ref_id !== NULL)
					{
						$this->fields->get_key_field()->value($src_id);
						
						$result = $this->on_move(
							$this->fields,
							$this->parameters,
							$position,
							$ref_id
						);
						if ($result) {
							$processed = $result->processed;
							$status = $result->status;
							$message = $result->message;
							$get_data = $result->get_data;
						}
						if ($processed && $this->clear_cache) File::clear_cache();
					}
				}
				else
				{
					$message = __('moving is not allowed');
					$status = 1;
				}
			}
			elseif ($action == 'delete')
			{
				if ($this->allow_delete)
				{
					$id_str = $request->post('id');
					if ($id_str !== NULL)
					{
						$ids = array_unique(array_map('intval', explode(',', $id_str)));
						$result = $this->on_delete($ids);
						if ($result)
						{
							$processed = $result->processed;
							$status = $result->status;
							$message = $result->message;
							$get_data = $result->get_data;
						}
						else
						{
							$processed = FALSE;
						}
						if (!$processed)
						{
							$deleted_count = 0;
							foreach ($ids as $id)
							{
								$this->fields->get_key_field()->value($id);
								$result = $this->datasource->delete($this->fields, $this->parameters);
								if ($result->status != 0)
								{
									$status = 1;
									if ( ! $message)
									{
										$message = array();
									}
									elseif ( ! is_array($message))
									{
										$message = array($message);
									}
									$message[] = $result->message;
								}
								elseif ($result->affected_rows)
								{
									$deleted_count += $result->affected_rows;
									$this->after_delete($id);
								}
							}
							if ($status == 1)
							{
								$message = implode("\n", $message);
							}
							else
							{
								$status = 2;
								$get_data = TRUE;
								if ($deleted_count == 1)
								{
									$message = __('one item has been deleted');
								}
								else
								{
									$message = __(':n items have been deleted', array(':n' => $deleted_count));
								}
							}
						}
					}
					unset($id_str);
				}
				else
				{
					$message = __('deleting is not allowed');
					$status = 1;
				}
			}
			elseif (method_exists($this, 'action_'.$action))
			{
				$action_state = new AVO_Data_Grid_Action_Result();
				$action_state->action = $action;
				$this->{'action_'.$action}($action_state);
				if ($action_state->processed)
				{
					$message = $action_state->message;
					$status = $action_state->status;
					$get_parameters = $action_state->get_parameters;
					$get_data = $action_state->get_data;
				}
			}
			else
			{
				$message = __('unknown action :action', array(':action' => $action));
				$status = 1;
			}
		}

		if ($get_data)
		{
			$this->datasource->init(array(
				'sort_field'		=> $this->_sorter->field_name(),
				'sort_direction'	=> $this->_sorter->direction(),
				'starting_from'		=> $this->use_pager ? $this->_pager->offset() : NULL,
				'limit_count'		=> $this->use_pager ? $this->_pager->size() : NULL,
				'filter_field'		=> $filter_field,
				'filter_value'		=> $filter_value,
			));
			$total = $this->datasource->ds_total(NULL, $this->parameters);
			if ($this->use_pager AND $this->_pager->fix($total))
			{
				// reinit
				$this->datasource->init(array(
					'sort_field'		=> $this->_sorter->field_name(),
					'sort_direction'	=> $this->_sorter->direction(),
					'starting_from'		=> $this->_pager->offset(),
					'limit_count'		=> $this->_pager->size(),
					'filter_field'		=> $filter_field,
					'filter_value'		=> $filter_value,
				));
			}
			$i = 0;
			while ($record = $this->datasource->fetch($this->parameters))
			{

				if (property_exists($this->datasource, 'model_class_name') AND $this->datasource->model_class_name) $this->fields->model($record);

				// fill fieldset with data from the datasource
				foreach ($this->fields as $field)
				{
					if ($field instanceof AVO_Field AND !$field->calculated)
					{
						$field->value($record->{$field->name});
					}
				}

				// apply functions to field values
				// this is a post fetching process because some data can
				// rely on previously calculated values
				foreach ($this->fields as $field)
				{
					if ($field instanceof AVO_Field AND is_callable($field->function, TRUE))
					{
						if (is_callable($field->function))
						{
							$field->value(call_user_func_array($field->function, array($field->value())));
						}
						elseif (is_string($field->function) AND method_exists($this->datasource, $field->function))
						{
							// the function is a datasource method
							$field->value($this->datasource->{$field->function}($field->value(), $this->parameters));
						}
					}
				}
				// preform the field additional value calculation
				foreach ($this->fields as $field)
				{
					if ($field instanceof AVO_Field)
					{
						$field->value($field->on_calc());
					}
				}
				// final calculation in the grid class
				$this->on_calc();

				// generate the JS array with values
				if ($i++) $rows .= ',';
				$rows .= '[';
				$j = 0;
				foreach ($this->fields as $field)
				{
					$is_a_field = ($field instanceof AVO_Field);
					if ($is_a_field && $field->server_side_only) continue;
					if ($j++) $rows .= ',';
					$rows .= $is_a_field ? $field->jsvalue() : NULL;
				}
				$rows .= ']';
			}
		}

		// generate the parameters js array
		if ($get_parameters)
		{
			$i = 0;
			foreach ($this->parameters as $param)
			{
				if ( ! $param->server_side_only)
				{
					if ($i++) $params .= ',';
					$params .= $param->jsvalue();
				}
			}
		}

		$result = '{';
		if (is_array($message))
		{
			$result .= '"message":[';
			$i = 0;
			foreach ($message as $msg_item)
			{
				if ($i++) $result .= ',';
				if (is_array($msg_item))
				{
					$result .= '["'.$msg_item[0].'",'.json_encode($msg_item[1]).']';
				}
				else
				{
					$result .= json_encode($msg_item);
				}
			}
			$result .= '],';
		}
		elseif ($message !== NULL)
		{
			$result .= '"message":'.json_encode($message).',';
		}
		if ($get_data)
		{
			$result .= '"sort_field":'.json_encode($this->_sorter->field_name()).',';
			$result .= '"sort_direction":'.json_encode($this->_sorter->direction()).',';
			$result .= '"total":'.$total.',';
			$result .= '"page_size":'.($this->use_pager ? $this->_pager->size() : 0).',';
			$result .= '"page":'.($this->use_pager ? $this->_pager->number() : 1).',';
			$result .= '"_rows":['.$rows.'],';
		}
		if ($get_parameters) $result .= '"parameters":['.$params.'],';
		$result .= '"executed_action":'.json_encode($action).',';
		$result .= '"status":'.$status;
		$result .= '}';

		if ($this->use_pager) $this->_pager->save();
		$this->_sorter->save();

		$this->_control_owner = FALSE;
		return $result;
	}


	/**
	 * Called on items deletion
	 *
	 * @var array $ids - ids of items to delete
	 */
	public function on_delete($ids)
	{
	}


	/**
	 * Called on items move
	 * @return true if processed
	 */
	public function on_move(AVO_Controls_List $controls, AVO_Controls_List $parameters = NULL, $position, $ref_id)
	{
		$this->datasource->move($controls, $parameters, $position, $ref_id);
	}


	/**
	 * Called after an item from the dataset is deleted
	 *
	 * @var int $id - deleted record id
	 */
	public function after_delete($id)
	{
		if ($this->clear_cache) File::clear_cache();
	}


	/**
	 * Renders an object for further reference
	 *
	 * @return string
	 */
	public function render()
	{
		$result =
			'{'
			. 'name:'.json_encode($this->name)
			. ',fields:'.$this->fields->render()
			. ',controller_url:'.json_encode($this->_get_controller_url())
			. ',msg_clear_btn:'.json_encode(__('clear search'))
			. ',msg_displaying:'.json_encode(__('view {from} to {to} of {total} items'))
			. ',msg_processing:'.json_encode(__('processing...'))
			. ',msg_no_items:'.json_encode(__('no items'))
			. ',msg_conn_error:'.json_encode(__('connection failure'))
			. ',msg_delete:'.json_encode(__('delete'))
			. ',msg_edit:'.json_encode(__('edit'))
			. ',msg_add_new:'.json_encode(__('add new'))
			. ',msg_delete_sel:'.json_encode(__('delete selected'))
			. ',msg_confirm_delete:'.json_encode(__('Are you sure you want to delete this item?'))
			. ',msg_confirm_delete_many:'.json_encode(__('Are you sure you want to delete these items?'))
			. ',msg_no_items_sel:'.json_encode(__('no items are selected'))
			. ',msg_quicksearch:'.json_encode(__('quick search'))
			. (($this->title === NULL) ? '' : (',title:'.json_encode($this->title)))
			. ($this->init_collapsed ? ',init_collapsed:true' : '')
			. ($this->allow_insert ? '' : ',allow_insert:false')
			. ($this->allow_update ? '' : ',allow_update:false')
			. ($this->allow_delete ? '' : ',allow_delete:false')
			. (($this->width == 'auto') ? '' : (',width:' . json_encode($this->width)))
			. (($this->height == 200) ? '' : (',height:' . json_encode($this->height)))
			. ($this->use_pager ? '' : ',use_pager:false')
			. ($this->nowrap ? ',nowrap:true' : '')
			. (($this->parameters !== NULL AND $this->parameters->count() > 0) ? (',parameters:'.$this->parameters->render()) : '')
			;
		if ($this->forms !== null)
		{
			$result .= ',forms:{';
			$i = 0;
			foreach ($this->forms as $name => $form)
			{
				if ($i++) $result .= ',';
				$result .= $name.':'.$form->render();
			}
			$result .= '}';
		}
		$result .= '}';
		if ($this->class_extension !== NULL) $result = '$.extend('.$result.','.$this->class_extension.')';

		return 'new AVO.Data_Grid('.$result.')';
	}


	/**
	 * Renders an object with initiation
	 *
	 * @param $initiate string no/yes/ajax/direct
	 * @return string
	 */
	public function render_object($initiate = 'no')
	{
		$var_name = $this->js_name();
		$result =
			'<script type="text/javascript">'
			.$var_name.'='.$this->render().';'
			;
		if ($initiate != 'no') $result .= $var_name.'.render('.(($initiate == 'ajax') ? '' : (($initiate == 'yes') ? 'null' : $this->handle_action(null, true))).');';
		return $result . '</script>';
	}

}
