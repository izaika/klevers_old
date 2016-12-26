<?php defined('SYSPATH') OR die('No direct script access.');

abstract class AVO_Data_Abstract_Component {

	/**
	 * object unique name. By default - a name of the class where the object is defined
	 * @var string
	 */
	public $name;

	/**
	* parameters
	* @var AVO_Controls_List
	*/
	public $parameters;

	/**
	 * data source
	 * @var AVO_Data_Source_DB
	 */
	public $datasource;

	/**
	 * child forms
	 * @var array
	 */
	public $forms;

	/**
	 * JavaScript reflection class extention
	 * Should be described as a javascript object
	 * Example:
	 * 	'{"some_method": function() {return 123;} }'
	 *
	 * @var string
	 */
	public $class_extension;

	/**
	 * flag showing whether the object is handling a requested action
	 * @var bool
	 */
	protected $_control_owner = false;

	private static $AUTO_NAMES = array();

	public function __construct()
	{
		$cname = get_class($this);
		if (!isset(self::$AUTO_NAMES[$cname])) self::$AUTO_NAMES[$cname] = '';
		$this->name = $cname.self::$AUTO_NAMES[$cname]++;
	}


	public static function factory()
	{
		return new self();
	}


	public function get_session_prefix()
	{
		return $this->name.'.';
	}


	public function is_control_owner()
	{
		return $this->_control_owner;
	}


	/**
	 * Recursively looks up the control owner for the data source queries
	 *
	 */
	public function control_owner()
	{
		if ($this->is_control_owner()) return $this;
		if (!is_array($this->forms)) return false;
		foreach ($this->forms as $form)
		{
			$is_owner = $form->control_owner();
			if ($is_owner) return $is_owner;
		}
		return false;
	}


	protected function _get_controller_url()
	{
		return URL::append_url_params(Request::current()->get_avo_url(), array('__avo_ajax_controller' => $this->name));
	}


	/**
	 * Handles a requested action for the object
	 *
	 * @param $action string - action name
	 * @param $init_data bool - return an initial data for the object
	 * @return string JSON result structure
	 */
	abstract public function handle_action($action = null, $init_data = false);

	/**
	* Calculates the fields mareked as calculated or alters the information in fields mapped to the data source
	*
	*/
	public function on_calc() {}


	/**
	 * Renders an object for further reference
	 *
	 * @return string
	 */
	abstract public function render();


	/**
	 * Renders an object with initiation
	 *
	 * @param $initiate string yes/no/ajax/direct
	 * @return string
	 */
	abstract public function render_object($initiate = 'no');


	/**
	* Default parameter calculation event handler for the datasource queries
	*
	* @param AVO_Data_Source_DB $ds
	* @param string $name parameter name
	*/
	public function on_calc_data_source_parameter(AVO_Data_Source_DB $ds, $name)
	{
		$handler = $this->control_owner();
		$parameter = $handler->parameters->$name;
		return $parameter ? $parameter->value() : NULL;
	}

	/**
	 * Returns JavaScript object name
	 *
	 * @return string
	 */
	public function js_name()
	{
		return 'AVO['.json_encode($this->name).']';
	}
}
