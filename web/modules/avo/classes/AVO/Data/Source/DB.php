<?php defined('SYSPATH') OR die('No direct script access.');

class AVO_Data_Source_DB extends AVO_Data_Source_Abstract {

	/**
	 * database
	 * @var Database
	 */
	public $db;
	public $filter_queries;
	public $count_query;
	public $select_query;
	public $delete_query;
	public $update_query;
	public $insert_query;
	public $find_query;
	public $custom_errors;
	public $filter_isset = FALSE;
	public $move_parameters = array(
		'table'		=> NULL,
		'where'		=> NULL,
		'order_by'	=> 'ord'
	);
	public $on_calc_parameter;
	public $model_class_name;

	/**
	 * dataset
	 * @var Database_Result
	 */
	private $_dataset;
	private $_filter_field;
	private $_filter_value;
	private $_order_by = '';
	private $_pos = 0;
	private $_total;
	private $_starting_from;
	private $_limit_count;

	public function __construct(array $array = array())
	{
		parent::__construct($array);

		if ( ! $this->db) $this->db = Database::instance();
		if ( ! $this->on_calc_parameter) $this->on_calc_parameter = create_function('', 'return NULL;');
	}


	public function init(array $parameters = array())
	{
		$filter_value = $filter_field = $sort_direction = $sort_field = '';

		foreach ($parameters as $k => $v)
		{
			switch ($k)
			{
				case 'filter_field':
					$this->_filter_field = $v;
				break;

				case 'filter_value':
					$this->_filter_value = $v;
				break;

				case 'sort_field':
					$sort_field = $v;
				break;

				case 'sort_direction':
					$sort_direction = ' '.$v;
				break;

				case 'starting_from':
					$this->_starting_from = $v;
				break;

				case 'limit_count':
					$this->_limit_count = $v;
				break;
			}
		}
		if ($sort_field != '') $this->_order_by = ' ORDER BY '.$sort_field.$sort_direction;
	}


	public function ds_total($argument = NULL, AVO_Controls_List $parameters = NULL)
	{
		if ($this->_total === NULL)
		{
			$query = ($this->_filter_field !== NULL) ? $this->filter_queries[$this->_filter_field]['count_query'] : $this->count_query;
			$this->_total = (int) AVO_DB_Query::build(Database::SELECT, $query)->bind($this, NULL, $parameters)->execute()->get(0);
		}
		return $this->_total;
	}


	public function fetch(AVO_Controls_List $parameters = NULL)
	{
		if ($this->_dataset === NULL) $this->_dataset = $this->_get_dataset($parameters);
		if ($this->_dataset->valid())
		{
			$row = $this->_dataset->current();
			$this->_dataset->next();
			$this->_pos++;
			return $row;
		}
		else
		{
			return NULL;
		}
	}


	private function _get_dataset(AVO_Controls_List $parameters = NULL)
	{
		if ($this->_starting_from !== NULL OR $this->_limit_count !== NULL)
		{
			$limit = " LIMIT {$this->_limit_count} OFFSET {$this->_starting_from} ";
			$this->_pos = $this->_starting_from;
		}
		else
		{
			$limit = '';
			$this->_pos = 0;
		}
		$query = ($this->_filter_field !== NULL) ? $this->filter_queries[$this->_filter_field]['select_query'] : $this->select_query;
		$object_class = $this->model_class_name ? $this->model_class_name : TRUE;
		return AVO_DB_Query::build(Database::SELECT, $query)
			->append_sql($this->_order_by.$limit)
			->bind($this, NULL, $parameters)
			->as_object($object_class)
			->execute();
	}


	/**
	 * deletes a record according to the $controls state
	 *
	 * @param $controls AVO_Controls_List
	 * @param $parameters AVO_Controls_List
	 * @return AVO_DB_Action_Result
	 */
	public function delete(AVO_Controls_List $controls, AVO_Controls_List $parameters = NULL)
	{
		$result = new AVO_DB_Action_Result;
		try
		{
			$result->affected_rows = AVO_DB_Query::build(Database::DELETE, $this->delete_query)
				->bind($this, $controls, $parameters)
				->execute();
		}
		catch (Kohana_Database_Exception $e)
		{
			$result->status = 1;
			$result->message = $this->_parse_db_error($e->getMessage());
		}
		return $result;
	}


	/**
	 * finds a record
	 *
	 * @param $controls AVO_Controls_List
	 * @param $parameters AVO_Controls_List
	 * @return mixed
	 */
	public function find(AVO_Controls_List $controls, AVO_Controls_List $parameters = NULL)
	{
		$object_class = $this->model_class_name ? $this->model_class_name : TRUE;
		$result = AVO_DB_Query::build(Database::SELECT, $this->find_query)
			->bind($this, $controls, $parameters)
			->as_object($object_class)
			->execute()
			->current();
		return $result ? $result : false;
	}


	/**
	 * saves a record
	 *
	 * @param $controls AVO_Controls_List
	 * @param $parameters AVO_Controls_List
	 * @return AVO_DB_Action_Result
	 */
	public function save(AVO_Controls_List $controls, AVO_Controls_List $parameters = NULL)
	{
		$result = new AVO_DB_Action_Result();
		$id = $controls->get_key_field()->dbvalue();
		$query = ($id !== NULL) ? AVO_DB_Query::build(Database::UPDATE, $this->update_query) : AVO_DB_Query::build(Database::INSERT, $this->insert_query);
		try
		{
			$db_result = $query->bind($this, $controls, $parameters)->execute();
			if ($query->type == Database::INSERT)
			{
				if ($db_result)
				{
					list ($result->id, $result->affected_rows) = $db_result;
				}
				else
				{
					$result->id = $id;
					$result->affected_rows = 0;
				}
			}
			else
			{
				$result->affected_rows = $db_result;
				$result->id = $id;
			}
		}
		catch (Kohana_Database_Exception $e)
		{
			$result->status = 1;
			$result->message = $this->_parse_db_error($e->getMessage());
		}
		return $result;
	}


	private function _parse_db_error($message)
	{
		if ($this->custom_errors !== NULL)
		{
			foreach ($this->custom_errors as $patern => $msg)
			{
				if (preg_match($patern, $message)) return array($msg);
			}
		}
		return $message;
	}


	public function filter_value()
	{
		return $this->_filter_value;
	}


	public function move(AVO_Controls_List $controls, AVO_Controls_List $parameters = NULL, $postion, $ref_id)
	{
		// check the source record
		$res = $this->find($controls, $parameters);
		if ($res === FALSE) return;

		$key_field = $controls->get_key_field();
		$key_field_name = $key_field->name;
		$src_id = $key_field->dbvalue();

		// check the reference
		$key_field->value($ref_id);
		$ref_row = $this->find($controls, $parameters);
		if ($ref_row === FALSE) return;

		$ref_id = $ref_row->$key_field_name;

		// no move if the record is the same
		if ($ref_id === $src_id) return;

		$ord_field_name = $this->move_parameters['order_by'];
		$table = $this->move_parameters['table'];
		$filter = isset($this->move_parameters['where']) ? $this->move_parameters['where'] : NULL;
		$params = array();
		if (is_array($filter))
		{
			$where = ' AND '.$filter[0];
			$params = $filter[1];
		}
		elseif ($filter !== NULL)
		{
			$where = ' AND '.$filter;
		}
		else
		{
			$where = '';
		}
		$ref_order = $ref_row->$ord_field_name;
		if ($postion == 'before')
		{
			AVO_DB_Query::factory(Database::UPDATE,
				'UPDATE '.$table.' '.
				'SET '.
					$ord_field_name.' = '.$ord_field_name.' + 1 '.
				'WHERE '.
					$ord_field_name.' >= '.$ref_order.
					$where
				, $params)->bind($this, $controls, $parameters)->execute();
			AVO_DB_Query::factory(Database::UPDATE,
				'UPDATE '.$table.' '.
				'SET '.
					$ord_field_name.' = '.$ref_order.' '.
				'WHERE '.
					$key_field_name.' = '.$src_id
				, $params)->bind($this, $controls, $parameters)->execute();
		}
		else
		{
			AVO_DB_Query::factory(Database::UPDATE,
				'UPDATE '.$table.' '.
				'SET '.
					$ord_field_name.' = '.$ord_field_name.' + 1 '.
				'WHERE '.
					$ord_field_name.' > '.$ref_order.
					$where
				, $params)->bind($this, $controls, $parameters)->execute();
			AVO_DB_Query::factory(Database::UPDATE,
				'UPDATE '.$table.' '.
				'SET '.
					$ord_field_name.' = '.($ref_order + 1).' '.
				'WHERE '.
					$key_field_name.' = '.$src_id
				, $params)->bind($this, $controls, $parameters)->execute();
		}
	}


	public function ds_absrevpos($argument = NULL, AVO_Controls_List $parameters = NULL)
	{
		return $this->ds_total($argument, $parameters) - $this->_pos + 1;
	}


	public function ds_abspos($argument = NULL, AVO_Controls_List $parameters = NULL)
	{
		return $this->_pos;
	}
}
