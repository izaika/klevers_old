<?php defined('SYSPATH') OR die('No direct script access.');

class AVO_Field extends AVO_Control {

	const TYPE_STRING	= 0;
	const TYPE_INT		= 1;
	const TYPE_TEXT		= 2;
	const TYPE_BOOL		= 3;
	const TYPE_LOOKUP	= 4;
	const TYPE_DATE		= 5;
	const TYPE_DATETIME	= 6;
	const TYPE_TIME		= 7;
	const TYPE_VARIANT	= 8;
	const TYPE_MONEYINT	= 9;

	public $align = 'left';
	public $calculated = false;
	public $class_extension;
	/**
	 * orders to render a control before the title
	 * @var bool
	 */
	public $control_before_title = false;
	public $default_focus = false;
	public $dragable = false;
	public $encoded = false;
	public $err_title;
	public $filter;
	public $fixed_value;
	public $function;
	public $height;
	public $hidden = false;
	public $html_class;
	public $html_class_row_hover;
	public $html_editor = false;
	public $key = false;
	public $lookup_datasource;
	public $on_get_lookup_datasource;
	public $lookup_key_field_name = 'id';
	public $lookup_multiline = false;
	public $lookup_null_result = '';
	public $lookup_offer_null = true;
	public $lookup_result_field_name = 'name';
	/**
	 * this value is displayed in lookup list if a lookup value is null
	 * @var string
	 */
	public $lookup_result_type	= self::TYPE_STRING;
	public $lookup_type = self::TYPE_INT;
	public $lookup_use_result = false;
	public $max_length;
	public $password = false;
	/**
	 * properties to update during the form action execution
	 * @var mixed
	 */
	public $properties_to_update;
	public $read_only = false;
	public $server_side_only = false;
	public $searchable = false;
	public $sortable = true;
	public $default_sortable = false;
	public $default_sort_direction = 'ASC';
	public $title;
	public $treat_as_null = '';
	public $trim_spaces = true;
	/**
	 * Field type
	 * @var int
	 */
	public $type = self::TYPE_STRING;
	public $validator;
	public $is_validator_enabled = true;
	public $value;
	public $width;

	/**
	 * parent
	 * @var AVO_Controls_List
	 */
	protected $parent;

	public function __construct(array $array = array())
	{
		parent::__construct($array);

		// calculated fields cannot be sortable if not specified
		if ($this->calculated AND !isset($array['sortable']))
		{
			$this->sortable = FALSE;
		}
		if ($this->key) $this->read_only = TRUE;
	}


	public function init_with($owner)
	{
		$this->parent = $owner;
		$this->on_init();
	}


	/**
	* Calculates the field value
	*
	*/
	public function on_calc()
	{
		return $this->value();
	}


	/**
	 * Initialization event handler.
	 * Here we can put any code that modifies the owner during the form.grid action processing
	 *
	 */
	public function on_init()
	{
	}


	/**
	 * After save event handler
	 *
	 */
	public function after_save(AVO_Data_Form_Action_Result $result)
	{
	}


	public static function std_drag_field()
	{
		return new AVO_Field(array(
			'name'					=> '__avo_drag',
			'type'					=> AVO_Field::TYPE_INT,
			'width'					=> '16px',
			'title'					=> '',
			'calculated'			=> true,
			'dragable'				=> true,
			'html_class'			=> 'drag_handle',
			'fixed_value'			=> null,
		));
	}


	public function disable_validator()
	{
		$this->is_validator_enabled = false;
	}


	public function enable_validator()
	{
		$this->is_validator_enabled = true;
	}


	public function setup_lookup_datasource()
	{
		if (!$this->lookup_datasource AND is_callable($this->on_get_lookup_datasource))
		{
			$this->lookup_datasource = call_user_func($this->on_get_lookup_datasource);
		}
	}

	public function value()
	{
		if (func_num_args() > 0)
		{
			// ignore if fixed value is defined
			if ($this->fixed_value !== NULL) return;
			// set the value
			$val = func_get_arg(0);
			if ($val === NULL)
			{
				$this->value = NULL;
			}
			else
			{
				if ($this->trim_spaces) $val = UTF8::trim($val);
				if (is_array($this->treat_as_null))
				{
					if (in_array($val, $this->treat_as_null))
					{
						$this->value = NULL;
						return;
					}
				}
				elseif ($this->treat_as_null !== NULL)
				{
					if ($val == $this->treat_as_null)
					{
						$this->value = NULL;
						return;
					}
				}
				switch ($this->type)
				{
					case self::TYPE_INT:
						$this->value = (int) $val;
					break;

					case self::TYPE_BOOL:
						switch ((string) $val)
						{
							case 'true':
								$val = 1;
							break;

							case 'false':
								$val = 0;
							break;
						}
						$this->value = (bool) $val;
					break;

					case self::TYPE_LOOKUP:
						if ($this->lookup_type == self::TYPE_INT)
						{
							$this->value = (int) $val;
							break;
						}
					case self::TYPE_STRING:
					case self::TYPE_TEXT:
						$this->value = (string) $val;
					break;

					case self::TYPE_DATE:
					case self::TYPE_DATETIME:
					case self::TYPE_TIME:
					case self::TYPE_MONEYINT:
						$this->value = $val;
					break;
				}
			}
		}
		else
		{
			// ignore the saved value if fixed value is defined
			if ($this->fixed_value !== NULL) return $this->fixed_value;
			return $this->value;
		}
	}

	public function dbvalue()
	{
		switch ($this->type)
		{
			case self::TYPE_DATE:
				if ($this->value === NULL)
				{
					return NULL;
				}
				else
				{
					return Text::str2sqldate($this->value);
				}
			break;

			case self::TYPE_DATETIME:
				if ($this->value === NULL)
				{
					return NULL;
				}
				else
				{
					return Text::str2sqldatetime($this->value);
				}
			break;

			case self::TYPE_MONEYINT:
				if ($this->value === NULL)
				{
					return NULL;
				}
				else
				{
					return Text::moneystr2int($this->value);
				}
			break;

			default:
				return $this->value();
			break;
		}
	}

	public function jsvalue()
	{
		$val = ($this->fixed_value === NULL) ? $this->value : $this->fixed_value;
		if ($val === NULL)
		{
			switch ($this->type)
			{
				case self::TYPE_LOOKUP:
					if ($this->lookup_use_result)
					{
						if ($this->lookup_result_type == self::TYPE_INT)
						{
							return ($this->lookup_null_result === '') ? 'null' : $this->lookup_null_result;
						}
						else
						{
							return json_encode($this->lookup_null_result);
						}
					}

				default:
					return 'null';
			}
		}
		else
		{
			switch ($this->type)
			{
				case self::TYPE_INT:
					return $val;
				break;

				case self::TYPE_BOOL:
					return Text::bool2str($val);
				break;

				case self::TYPE_LOOKUP:
					if ($this->lookup_use_result)
					{
						$this->setup_lookup_datasource();
						$this->lookup_datasource->init();
						$clist = new AVO_Controls_List(array(
							new AVO_Field(array(
								'name'	=> $this->lookup_key_field_name,
								'type'	=> $this->lookup_type,
								'key'	=> TRUE,
							)),
						));
						$clist->{$this->lookup_key_field_name}->value($val);
						$val = $this->lookup_datasource->find($clist);
						if ($this->lookup_result_type == self::TYPE_INT)
						{
							return ($val === FALSE) ? 0 : (is_array($val) ? $val[$this->lookup_result_field_name] : $val->{$this->lookup_result_field_name});
						}
						else
						{
							$val = ($val === FALSE) ? $this->lookup_null_result : (is_array($val) ? $val[$this->lookup_result_field_name] : $val->{$this->lookup_result_field_name});
							return json_encode($val);
						}
					}
					else
					{
						if ($this->lookup_type == self::TYPE_INT) return $val;
					}
				case self::TYPE_STRING:
				case self::TYPE_TEXT:
				case self::TYPE_DATE:
				case self::TYPE_DATETIME:
				case self::TYPE_TIME:
					return json_encode($val);
				break;

				case self::TYPE_MONEYINT:
					return json_encode(Text::int2moneystr($val));
				break;

				case self::TYPE_VARIANT:
					return $this->_dump_variable($val);
				break;
			}
		}
	}

	private function _dump_variable($val)
	{
		if ($val === null)
		{
			return 'null';
		}
		elseif (is_array($val))
		{
			// check if the array is of assoc type
			$i = 0;
			$assoc = FALSE;
			foreach ($val as $k => $v)
			{
				if ($k !== $i++)
				{
					$assoc = TRUE;
					break;
				}
			}
			if ($assoc)
			{
				$result = '{';
				$i = 0;
				foreach ($val as $k => $v)
				{
					if ($i++) $result .= ',';
					$result .= $this->_dump_variable($k).':'.$this->_dump_variable($v);
				}
				$result .= '}';
			}
			else
			{
				$result = '[';
				$i = 0;
				foreach ($val as $v)
				{
					if ($i++) $result .= ',';
					$result .= $this->_dump_variable($v);
				}
				$result .= ']';
			}
			return $result;
		}
		elseif (is_bool($val))
		{
			return Text::bool2str($val);
		}
		elseif (is_float($val) OR is_int($val) OR is_string($val))
		{
			return json_encode($val);
		}
		else
		{
			return "'[".gettype($val)."]'";
		}
	}


	public function render()
	{
		$result = '{'
			.'name:'.json_encode($this->name)
			.',type:'.self::jstype($this->type)
			.($this->searchable ? ',searchable:true' : '')
			.(($this->align == 'left') ? '' : (',align:'.json_encode($this->align)))
			.(($this->control_before_title) ? ',control_before_title:true' : '')
			.($this->default_focus ? ',default_focus:true' : '')
			.(($this->encoded) ? ',encoded:true' : '')
			.(($this->err_title === NULL) ? '' : (',err_title:'.(($this->err_title instanceof AVO_Label) ? $this->err_title->render() : json_encode($this->err_title))))
			.($this->height ? (',height:'.json_encode($this->height)) : '')
			.($this->hidden ? ',hidden:true' : '')
			.($this->dragable ? ',dragable:true' : '')
			.(($this->html_class === NULL) ? '' : (',html_class:'.json_encode($this->html_class)))
			.(($this->html_class_row_hover === NULL) ? '' : (',html_class_row_hover:'.json_encode($this->html_class_row_hover)))
			.($this->html_editor ? ',html_editor:true' : '')
			.($this->key ? ',key:true' : '')
			.(($this->lookup_result_type != self::TYPE_STRING) ? (',lookup_result_type:'.$this->jstype($this->lookup_result_type)): '')
			.($this->lookup_multiline ? ',lookup_multiline:true' : '')
			.(($this->max_length === null) ? '' : (',max_length:' . json_encode($this->max_length)))
			.($this->password ? ',password:true' : '')
			.($this->read_only ? ',read_only:true' : '')
			.(($this->sortable) ? '' : ',sortable:false')
			.(($this->title === NULL) ? '' : (',title:'.(($this->title instanceof AVO_Label) ? $this->title->render() : json_encode($this->title))))
			.(($this->width === NULL) ? '' : (',width:'.json_encode($this->width)))
			.'}';
		if ($this->class_extension !== null) $result = '$.extend('.$result.','.$this->class_extension.')';
		return 'new AVO.Field('.$result.')';
	}


	/**
	 * returns a string name for a type
	 * @param $type int
	 * @return string
	 */
	public static function jstype($type)
	{
		switch ($type)
		{
			case self::TYPE_STRING:
				return 'AVO.Field.TYPE_STRING';
			break;

			case self::TYPE_INT:
				return 'AVO.Field.TYPE_INT';
			break;

			case self::TYPE_TEXT:
				return 'AVO.Field.TYPE_TEXT';
			break;

			case self::TYPE_BOOL:
				return 'AVO.Field.TYPE_BOOL';
			break;

			case self::TYPE_LOOKUP:
				return 'AVO.Field.TYPE_LOOKUP';
			break;

			case self::TYPE_DATE:
				return 'AVO.Field.TYPE_DATE';
			break;

			case self::TYPE_DATETIME:
				return 'AVO.Field.TYPE_DATETIME';
			break;

			case self::TYPE_TIME:
				return 'AVO.Field.TYPE_TIME';
			break;

			case self::TYPE_VARIANT:
				return 'AVO.Field.TYPE_VARIANT';
			break;

			case self::TYPE_MONEYINT:
				return 'AVO.Field.TYPE_MONEYINT';
			break;

			default:
				return NULL;
			break;
		}
	}

}
