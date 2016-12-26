<?php defined('SYSPATH') OR die('No direct script access.');

class AVO_DB_Query {

	/**
	 * query type
	 * @var integer
	 */
	public $type;
	/**
	 * query
	 * @var Database_Query
	 */
	public $query;
	/**
	 * query parameters
	 * @var array
	 */
	public $parameters;


	function __construct($type, $sql, $parameters = array())
	{
		$this->type = $type;
		$this->sql = $sql;
		$this->parameters = $parameters;
	}

	public static function factory($type, $sql, $parameters = array())
	{
		return new self($type, $sql, $parameters);
	}

	public static function build($type, $query)
	{
		if ($query instanceof self) return $query;
		return new self($type, $query);
	}


	public function append_sql($suffix)
	{
		$this->sql .= $suffix;
		return $this;
	}


	/**
	 * Binds a query object to the data source and optionally controls
	 *
	 * @param AVO_Data_Source_DB $ds
	 * @param AVO_Controls_List $controls
	 * @param AVO_Controls_List $parameters
	 * @throws Kohana_Exception
	 * @return Database_Query
	 */
	public function bind(AVO_Data_Source_DB $ds = NULL, AVO_Controls_List $controls = NULL, AVO_Controls_List $parameters = NULL)
	{
		$result = DB::query($this->type, $this->sql);
		// Kohana::$log->add(Log::DEBUG, 'AVO_DB_Query SQL: '.$this->sql);
		if ($ds)
		{
			/* @var $field AVO_Field */

			// prepare the parameters
			$auto_parameters = array();
			if ($controls)
			{
				foreach ($controls as $field)
				{
					if ($field instanceof AVO_Field AND ! $field->server_side_only)
					{
						$auto_parameters[':'.$field->name] = new AVO_DB_Param(AVO_DB_Param::FIELD, $field->name);
					}
				}
			}
			if ($parameters)
			{
				foreach ($parameters as $field)
				{
					$auto_parameters[':'.$field->name] = new AVO_DB_Param(AVO_DB_Param::PARAMETER, $field->name);
				}
			}
			$query_parameters = array_merge($auto_parameters, $this->parameters);

			foreach ($query_parameters as $param => $value)
			{
				if ($value instanceof AVO_DB_Param)
				{
					$name = $value->value;
					/* @var $value AVO_DB_Param */
					switch ($value->type)
					{
						case AVO_DB_Param::FIELD:
							$control = $controls->$name;
							if ($control instanceof AVO_Field)
							{
								$result->param($param, $control->dbvalue());
							}
							else
							{
								throw new Kohana_Exception('failed to bind query parameter :name', array(':name' => $name));
							}
						break;

						case AVO_DB_Param::PARAMETER:
							$result->param($param, call_user_func_array($ds->on_calc_parameter, array($ds, $name)));
						break;

						case AVO_DB_Param::FILTER_VALUE_LIKE:
							$result->param($param, '%'.Text::escape_sql_glob($ds->filter_value()).'%');
						break;

						case AVO_DB_Param::FILTER_VALUE:
							$result->param($param, $ds->filter_value());
						break;
					}
				}
				else
				{
					$result->param($param, $value);
				}
			}
		}
		return $result;
	}

}
